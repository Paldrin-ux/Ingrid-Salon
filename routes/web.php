<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SummerNoteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\CommissionController;
use App\Http\Controllers\OtpController;
use Illuminate\Http\Request;

Auth::routes();

// =======================
// FRONTEND ROUTES
// =======================

use App\Http\Controllers\SocialLoginController;

// Social Login Routes
Route::get('auth/{provider}', [SocialLoginController::class, 'redirectToProvider'])->name('social.redirect');
Route::get('auth/{provider}/callback', [SocialLoginController::class, 'handleProviderCallback'])->name('social.callback');
Route::get('/', function () {
    return redirect()->route('login');
})->name('home');
Route::get('/website', [FrontendController::class, 'index'])->name('frontend');


// Fetch services from categories
Route::get('/categories/{category}/services', [FrontendController::class, 'getServices'])->name('get.services');

// Fetch employees from services
Route::get('/services/{service}/employees', [FrontendController::class, 'getEmployees'])->name('get.employees');

// Get employee availability
Route::get('/employees/{employee}/availability/{date?}', [FrontendController::class, 'getEmployeeAvailability'])->name('employee.availability');

// Create appointment
Route::post('/bookings', [AppointmentController::class, 'store'])->name('bookings.store');

// =======================
// AUTHENTICATED ROUTES
// =======================
Route::middleware(['auth'])->group(function () {

    // -----------------------
    // DASHBOARD (Admin/Employee only)
    // -----------------------
    Route::middleware(['role:admin|employee'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });


    // -----------------------
    // PROFILE (All users, including subscriber)
    // -----------------------
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::patch('profile-update/{user}', [ProfileController::class, 'profileUpdate'])->name('user.profile.update');
    Route::patch('user/pasword-update/{user}', [UserController::class, 'password_update'])->name('user.password.update');
    Route::put('user/profile-pic/{user}', [UserController::class, 'updateProfileImage'])->name('user.profile.image.update');
    Route::patch('delete-profile-image/{user}', [UserController::class, 'deleteProfileImage'])->name('delete.profile.image');

    // -----------------------
    // USERS (Admin only)
    // -----------------------
    Route::resource('user', UserController::class)->middleware('permission:users.view|users.create|users.edit|users.delete');
    Route::get('user-trash', [UserController::class, 'trashView'])->name('user.trash');
    Route::get('user-restore/{id}', [UserController::class, 'restore'])->name('user.restore');
    Route::delete('user-delete/{id}', [UserController::class, 'force_delete'])->name('user.force.delete');

    // -----------------------
    // SETTINGS
    // -----------------------
    Route::get('settings', [SettingController::class, 'index'])->name('setting')->middleware('permission:setting update');
    Route::post('settings/{setting}', [SettingController::class, 'update'])->name('setting.update');

    // -----------------------
    // CATEGORIES
    // -----------------------
    Route::resource('category', CategoryController::class)->middleware('permission:categories.view|categories.create|categories.edit|categories.delete');

    // -----------------------
    // SERVICES
    // -----------------------
    Route::resource('service', ServiceController::class)->middleware('permission:services.view|services.create|services.edit|services.delete');
    Route::get('service-trash', [ServiceController::class, 'trashView'])->name('service.trash');
    Route::get('service-restore/{id}', [ServiceController::class, 'restore'])->name('service.restore');
    Route::delete('service-delete/{id}', [ServiceController::class, 'force_delete'])->name('service.force.delete');

    // -----------------------
    // SUMMERNOTE
    // -----------------------
    Route::post('summernote', [SummerNoteController::class, 'summerUpload'])->name('summer.upload.image');
    Route::post('summernote/delete', [SummerNoteController::class, 'summerDelete'])->name('summer.delete.image');

    // -----------------------
    // EMPLOYEES
    // -----------------------
    Route::get('employee-booking', [UserController::class, 'EmployeeBookings'])->name('employee.bookings');
    Route::get('my-booking/{id}', [UserController::class, 'show'])->name('employee.booking.detail');
    Route::patch('employe-profile-update/{employee}', [ProfileController::class, 'employeeProfileUpdate'])->name('employee.profile.update');
    Route::put('employee-bio/{employee}', [EmployeeController::class, 'updateBio'])->name('employee.bio.update');

    // -----------------------
    // APPOINTMENTS
    // -----------------------
    Route::middleware('permission:appointments.view|appointments.create|appointments.edit|appointments.delete')->group(function () {
        Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments');
        Route::post('/appointments/update-status', [AppointmentController::class, 'updateStatus'])->name('appointments.update.status');
        
        // Added Bulk Destroy here inside the permission group
        Route::delete('/appointments/bulk-destroy', [AppointmentController::class, 'bulkDestroy'])->name('appointments.bulkDestroy');
        
        Route::delete('/appointments/{id}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');
    });

    // Update status from dashboard
    Route::post('/update-status', [DashboardController::class, 'updateStatus'])->name('dashboard.update.status');

    Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin']], function () {
        Route::get('commissions', [CommissionController::class, 'index'])
            ->name('admin.commissions.index');

        Route::post('commissions/reset', [CommissionController::class, 'reset'])
            ->name('admin.commissions.reset');
    });

    // -----------------------
    // TEST ROUTES
    // -----------------------
    Route::get('test', function (Request $request) {
        return view('test', ['request' => $request]);
    });

    Route::post('test', function (Request $request) {
        dd($request->all())->toArray();
    })->name('test');
});

// ✅ Route to send OTP
Route::post('/send-otp', [OtpController::class, 'sendOtp'])->name('send.otp');

// ✅ Route to register user after OTP verification
Route::post('/register-custom', [OtpController::class, 'register'])->name('register.custom');