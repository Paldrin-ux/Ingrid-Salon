<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Setting;
use App\Models\Employee;
use App\Models\Category;
use App\Models\Service;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed Settings if table exists and empty
        if (Schema::hasTable('settings') && Setting::count() === 0) {
            Setting::factory()->create();
        }

        // Seed Users, Roles, Permissions, Employee, Categories, Services
        if (Schema::hasTable('users') && User::count() === 0) {
            $user = $this->createInitialUserWithPermissions();
            $this->createCategoriesAndServices($user);
        }
    }

    protected function createInitialUserWithPermissions()
    {
        // Permissions
        $permissions = [
            'permissions.view', 'permissions.create', 'permissions.edit', 'permissions.delete',
            'users.view', 'users.create', 'users.edit', 'users.delete',
            'appointments.view', 'appointments.create', 'appointments.edit', 'appointments.delete',
            'categories.view', 'categories.create', 'categories.edit', 'categories.delete',
            'services.view', 'services.create', 'services.edit', 'services.delete',
            'settings.edit'
        ];

        foreach ($permissions as $permissionName) {
            Permission::firstOrCreate(['name' => $permissionName]);
        }

        // Roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $moderatorRole = Role::firstOrCreate(['name' => 'moderator']);
        $employeeRole = Role::firstOrCreate(['name' => 'employee']);
        $subscriberRole = Role::firstOrCreate(['name' => 'subscriber']);

        $adminRole->syncPermissions(Permission::all());

        // Initial admin user
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'phone' => '1234567890',
            'status' => 1,
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'),
        ]);

        

        $user->assignRole($adminRole);

        // Create employee profile for admin
        Employee::create([
            'user_id' => $user->id,
            'days' => [
                "monday" => ["06:00-22:00"],
                "tuesday" => ["06:00-15:00", "16:00-22:00"],
                "wednesday" => ["09:00-12:00", "14:00-23:00"],
                "thursday" => ["09:00-20:00"],
                "friday" => ["06:00-17:00"],
                "saturday" => ["05:00-18:00"]
            ],
            'slot_duration' => 30
        ]);

        return $user;
    }

    protected function createCategoriesAndServices(User $user)
    {
        $categories = [
            ['title' => 'Hair', 'slug' => 'hair', 'body' => 'Professional hair services for all styles.'],
            ['title' => 'Nails', 'slug' => 'nails', 'body' => 'Manicure and pedicure services for perfect nails.'],
            ['title' => 'Facial/Skin', 'slug' => 'facial-skin', 'body' => 'Skin treatments and facials for healthy skin.']
        ];

        foreach ($categories as $categoryData) {
            $category = Category::create($categoryData);
            $services = [];

            switch ($category->title) {
                case 'Hair':
                    $services = [
                        ['title' => 'Haircut','slug' => 'haircut','price' => 500,'excerpt' => 'Professional haircut for men and women.'],
                        ['title' => 'Hair Rebonding','slug' => 'hair-rebonding','price' => 2500,'excerpt' => 'Smooth and straight hair treatment.'],
                        ['title' => 'Hair Coloring','slug' => 'hair-coloring','price' => 1500,'excerpt' => 'Full or partial hair coloring services.']
                    ];
                    break;

                case 'Nails':
                    $services = [
                        ['title' => 'Manicure','slug' => 'manicure','price' => 400,'excerpt' => 'Nail care and polish.'],
                        ['title' => 'Pedicure','slug' => 'pedicure','price' => 500,'excerpt' => 'Foot care and nail polish.']
                    ];
                    break;

                case 'Facial/Skin':
                    $services = [
                        ['title' => 'Anti-Aging Facial','slug' => 'anti-aging-facial','price' => 1200,'excerpt' => 'Facial treatment to reduce signs of aging.'],
                        ['title' => 'Acne Treatment','slug' => 'acne-treatment','price' => 1000,'excerpt' => 'Treatment for acne-prone skin.']
                    ];
                    break;
            }

            foreach ($services as $serviceData) {
                Service::create(array_merge($serviceData, ['category_id' => $category->id]));
            }
        }

        // Attach all services to employee
        if ($user->employee) {
            $user->employee->services()->sync(Service::pluck('id'));
        }
    }
}
