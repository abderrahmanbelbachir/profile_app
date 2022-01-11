<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ProfileController;
use \App\Http\Controllers\IndexController;
use \App\Http\Controllers\DashboardController;

if (env('APP_ENV') === 'production') {
    \Illuminate\Support\Facades\URL::forceScheme('https');
}

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

Route::get('/', [IndexController::class , 'index'])->name('index');

Route::get('/user', [ProfileController::class , 'index'])->name('user.index')
    ->middleware(['auth']);

Route::get('/dashboard', [DashboardController::class , 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/profile', [ProfileController::class , 'update'])
    ->middleware(['auth', 'verified'])->name('profile.update');

require __DIR__.'/auth.php';
