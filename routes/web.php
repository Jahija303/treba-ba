<?php

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\DashboardController;
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

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth:sanctum', 'verified', 'role:super-admin'])
    ->group(function () {

        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

        Route::prefix('roles')
            ->name('roles.')
            ->group(function() {

                Route::get('/', [RoleController::class, 'index'])->name('index');
                Route::delete('/destroy/{id}', [RoleController::class, 'destroy'])->name('destroy');
                Route::post('/store', [RoleController::class, 'store'])->name('store');
                ROute::get('/edit/{id}', [RoleController::class, 'edit'])->name('edit');
                Route::put('/update/{id}', [RoleController::class, 'update'])->name('update');
        });
    }
);
