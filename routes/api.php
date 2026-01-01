<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Auth\PasswordResetController;
use Illuminate\Support\Facades\Route;

// -------------------
// AUTH ROUTES
// -------------------
Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class,'register']);
    Route::post('login', [AuthController::class,'login']);

    // JWT protected routes
    Route::middleware('auth:api')->group(function () {
        Route::post('logout', [AuthController::class,'logout']);
        Route::post('refresh', [AuthController::class,'refresh']);
        Route::get('me', [AuthController::class,'me']);
    });

    // Password reset
    Route::prefix('password')->group(function () {
        Route::post('email', [PasswordResetController::class,'sendResetLink']);
        Route::post('reset', [PasswordResetController::class,'resetPassword']);
    });
});

// -------------------
// ADMIN ROUTES
// -------------------
Route::prefix('admin')->middleware(['auth:api','role:admin'])->group(function() {
    Route::get('/data', function(){
        return ['data'=>'secret admin data'];
    });

    // future admin routes
    // Route::get('/users', [AdminUserController::class, 'index']);
});


