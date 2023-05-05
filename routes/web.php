<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/login', function () {
    return view('login');
})->middleware('guest');

Route::post('/login', 'Auth\authenticate@login')->middleware('CheckBanned');

Route::middleware('auth')->group(function () {
    /*Route::middleware(['can:user.index'])->group(function () {
            Route::resource('user', UserController::class);
        });*/

    Route::middleware(['can:user.index'])->group(function () {
        Route::resource('user', UserController::class);
    })->name('user.index');

    /*Route::resource('user', App\Http\Controllers\UserController::class);*/

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
});

require __DIR__ . '/auth.php';
