<?php

use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\UserController;
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
    ->middleware(['auth:sanctum', 'verified', 'role:super-admin|local-admin'])
    ->group(function () {

        // Dashboard
        Route::get('dashboard', [DashboardController::class, 'index'])
            ->name('dashboard.index')
            ->middleware(['can:access_dashboard']);

        // Users
        Route::resource('users', UserController::class)->only([
            'index', 'store', 'update', 'destroy'
        ]);

        // Roles
        Route::resource('roles', RoleController::class)->only([
            'index', 'store', 'edit', 'update', 'destroy'
        ])->middleware(['can:manage_roles']);

        // Permissions
        Route::resource('permissions', PermissionController::class)->only([
            'index', 'store', 'update', 'destroy'
        ])->middleware(['can:manage_permissions']);

        // Issues
        Route::resource('issues', IssueController::class)->only([
            'index', 'update', 'destroy'
        ]);

        // Categories
        Route::resource('categories', CategoryController::class)->only([
            'index', 'store', 'update', 'destroy'
        ]);

        // Cities
        Route::resource('cities', CityController::class)->only([
            'index', 'store', 'edit', 'update', 'destroy'
        ]);

        // Districts
        Route::resource('districts', DistrictController::class)->only([
            'index', 'store', 'edit', 'update', 'destroy'
        ]);
    }
);
