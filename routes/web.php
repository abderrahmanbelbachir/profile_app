<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use \App\Http\Controllers\ProfileController;
use \App\Http\Controllers\IndexController;
use \App\Http\Controllers\DashboardController;

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

Route::get('/run/migrations' , function() {
    \Illuminate\Support\Facades\Log::info('going to run migrations !');
    \Illuminate\Support\Facades\Log::debug('going to run migrations !');

    \Artisan::call('migrate',
        array(
            '--path' => 'database/migrations',
            '--force' => true));
    return 'Done!';
});

require __DIR__.'/auth.php';
