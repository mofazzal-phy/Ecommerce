<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\PasswordCreateController;
use App\Http\Controllers\Auth\LockscreenController;
use App\Http\Controllers\Auth\SuccessMessageController;
use App\Http\Controllers\Auth\TwoStepController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Auth\OtpVerificationController;
use Illuminate\Support\Facades\Mail;



Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware(['auth', 'role:super-admin|admin|writer']);

    Route::get('/test-full', function () {
    return view('test-full');
});

Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])
    ->name('admin.users.edit');

Route::put('/admin/users/{user}', [UserController::class, 'update'])
    ->name('admin.users.update');

Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])
    ->name('admin.users.destroy')
    ->middleware('permission:user.delete');




Route::get('/user-dashboard', function () {
    return view('frontend.user.dashboard');
})->name('user.dashboard')->middleware('auth');

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {

    Route::get('/users', [UserController::class, 'index'])
        ->name('users.index');

    Route::get('/users/{user}', [UserController::class, 'show'])
        ->name('users.show');
});

/* Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {

    Route::get('/roles/create', [RoleController::class, 'create'])
        ->name('roles.create')
        ->middleware('permission:role.create');

    Route::post('/roles', [RoleController::class, 'store'])
        ->name('roles.store')
        ->middleware('permission:role.create');

    Route::get('/permissions/create', [PermissionController::class, 'create'])
        ->name('permissions.create')
        ->middleware('permission:permission.create');

    Route::post('/permissions', [PermissionController::class, 'store'])
        ->name('permissions.store')
        ->middleware('permission:permission.create');
}); */

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {

    // Roles
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index')->middleware('permission:role.view');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create')->middleware('permission:role.create');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store')->middleware('permission:role.create');
    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit')->middleware('permission:role.edit');
    Route::put('/roles/{role}', [RoleController::class, 'update'])->name('roles.update')->middleware('permission:role.edit');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy')->middleware('permission:role.delete');

    // Permissions
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index')->middleware('permission:permission.view');
    Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create')->middleware('permission:permission.create');
    Route::post('/permissions', [PermissionController::class, 'store'])->name('permissions.store')->middleware('permission:permission.create');
    Route::get('/permissions/{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit')->middleware('permission:permission.edit');
    Route::put('/permissions/{permission}', [PermissionController::class, 'update'])->name('permissions.update')->middleware('permission:permission.edit');
    Route::delete('/permissions/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy')->middleware('permission:permission.delete');
});



Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

/*
|--------------------------------------------------------------------------
| Forgot Password Flow
|--------------------------------------------------------------------------
*/

// forgot password page
Route::get('/forgot-password', [PasswordResetController::class, 'showPasswordResetForm'])
    ->name('password.request');

// send reset link mail
Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink'])
    ->name('password.email');

// reset password form with token
Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])
    ->name('password.reset');

// update password
Route::post('/reset-password', [PasswordResetController::class, 'resetPassword'])
    ->name('password.update');

/*
|--------------------------------------------------------------------------
| Create Password (OTP / First time)
|--------------------------------------------------------------------------
*/

Route::get('/create-password', [PasswordCreateController::class, 'showPasswordCreateForm'])
    ->name('password.create');

Route::post('/create-password', [PasswordCreateController::class, 'storePassword'])
    ->name('password.store');

/*
|--------------------------------------------------------------------------
| OTP Verification
|--------------------------------------------------------------------------
*/

Route::get('/verify-otp', [OtpVerificationController::class, 'showForm'])->name('otp.form');
Route::post('/verify-otp', [OtpVerificationController::class, 'verify'])->name('otp.verify');

/*
|--------------------------------------------------------------------------
| Extra Pages
|--------------------------------------------------------------------------
*/

Route::get('/lockscreen', [LockscreenController::class, 'showLockscreenForm'])->name('lockscreen');
Route::get('/success-message', [SuccessMessageController::class, 'showSuccessMessageForm'])->name('success.message');
Route::get('/two-step', [TwoStepController::class, 'showTwoStepForm'])->name('two.step');

/*
|--------------------------------------------------------------------------
| Test Mail
|--------------------------------------------------------------------------
*/

Route::get('/test-mail', function () {
    Mail::raw('Mail system is working', function ($message) {
        $message->to('mofazzal.phy@gmail.com')
                ->subject('Test Mail');
    });

    return 'Mail sent';
});