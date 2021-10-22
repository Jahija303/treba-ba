<?php

use App\Http\Controllers\CityController;
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

Route::get('/', [HomeController::class, 'index']);

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/home', [HomeController::class, 'home'])->name('home');

Route::middleware(['auth:sanctum', 'verified', 'role:super-admin'])
    ->get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

Route::resource('cities', CityController::class);
