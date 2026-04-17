<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/profile';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],

            // 📱 Phone number: must be exactly 11 digits and unique
            'phone' => [
                'required',
                'digits:11',           
                'unique:users',
                'regex:/^[0-9]{11}$/', 
            ],

            'password' => [
                'required',
                'string',
                'min:10',              
                'confirmed',
                'regex:/[A-Z]/',       
                'regex:/[a-z]/',      
                'regex:/[0-9]/',       
                'regex:/[@$!%*#?&]/',  
            ],
        ], [
            
            'phone.digits' => 'Phone number must be exactly 11 digits.',
            'phone.regex' => 'Phone number must contain only numbers.',
            'password.min' => 'Password must be at least 10 characters long.',
            'password.regex' => 'Password must include at least one uppercase letter, one lowercase letter, one number, and one special character.',
        ]);
    }

    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
        ]);

        $user->assignRole('subscriber');
        return $user;
    }
}
