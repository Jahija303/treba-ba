<?php

use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

// Admin routes
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth:sanctum', 'verified', 'role:super-admin'])
    ->group(function () {

        // Dashboard
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

        // Roles
        Route::prefix('roles')
            ->name('roles.')
            ->group(function() {
                Route::get('/', [RoleController::class, 'index'])->name('index');
                Route::post('/store', [RoleController::class, 'store'])->name('store');
                Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('edit');
                Route::put('/update/{id}', [RoleController::class, 'update'])->name('update');
                Route::delete('/destroy/{id}', [RoleController::class, 'destroy'])->name('destroy');
        });

        // Permissions
        Route::prefix('permissions')
            ->name('permissions.')
            ->group(function() {
                Route::get('/', [PermissionController::class, 'index'])->name('index');
                Route::post('/store', [PermissionController::class, 'store'])->name('store');
                Route::put('/update/{id}', [PermissionController::class, 'update'])->name('update');
                Route::delete('/destroy/{id}', [PermissionController::class, 'destroy'])->name('destroy');
            });

        // Cities
        Route::prefix('cities')
            ->name('cities.')
            ->group(function() {
                Route::get('/', [CityController::class, 'index'])->name('index');
                Route::post('/store', [CityController::class, 'store'])->name('store');
                Route::get('/edit/{id}', [CityController::class, 'edit'])->name('edit');
                Route::put('/update/{id}', [CityController::class, 'update'])->name('update');
                Route::delete('/destroy/{id}', [CityController::class, 'destroy'])->name('destroy');
            });

        // Districts
        Route::prefix('districts')
            ->name('districts.')
            ->group(function() {
                Route::get('/', [DistrictController::class, 'index'])->name('index');
                Route::post('/store', [DistrictController::class, 'store'])->name('store');
                Route::get('/edit/{id}', [DistrictController::class, 'edit'])->name('edit');
                Route::put('/update/{id}', [DistrictController::class, 'update'])->name('update');
                Route::delete('/destroy/{id}', [DistrictController::class, 'destroy'])->name('destroy');
            });
    }
);
