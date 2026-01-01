<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Controllers
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\DashboardController;


use App\Http\Controllers\DashboardApps\Ecommerce\ProductController;
use App\Http\Controllers\DashboardApps\Ecommerce\ProductDetailsController;
use App\Http\Controllers\DashboardApps\Ecommerce\AddProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;

/*
|--------------------------------------------------------------------------
| Public Route
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('dashboard');
});



/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Main Dashboard
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])
        ->name('dashboard');




    // Ecommerce Product CRUD
    Route::controller(ProductController::class)->group(function () {
        Route::get('/dashboard-apps-ecommerce-products', 'index')->name('dashboard-apps-ecommerce-products');
        Route::get('/dashboard-apps-ecommerce-add-product', 'create')->name('dashboard-apps-ecommerce-add-product')->middleware('permission:product.create');
        Route::post('/dashboard-apps-ecommerce-add-product', 'store')->name('dashboard-apps-ecommerce-add-product.store');
        Route::get('/dashboard-apps-ecommerce-products/{id}/edit', 'edit')->name('products.edit');
        Route::put('/dashboard-apps-ecommerce-products/{id}', 'update')->name('products.update');
        Route::delete('/dashboard-apps-ecommerce-products/{product}', 'destroy')->name('products.destroy')->middleware('permission:product.delete');
    });

});

/*
|--------------------------------------------------------------------------
| Admin Routes (Role Based)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','role:super-admin'])->get('/admin', fn () => 'Super Admin Panel');

Route::middleware(['auth','role:admin'])->get('/admin/dashboard', fn () => 'Admin Panel');

Route::middleware(['auth','role:super-admin|admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::resource('users', UserController::class)->only(['index','create','store']);
        Route::resource('roles', RoleController::class)->only(['index','create','store']);

    });

    Route::middleware(['auth', 'permission:user.create'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('users', UserController::class);
    });


    

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
