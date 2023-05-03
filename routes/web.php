<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\UserController;

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

Route::get('/get-permissions', function () {
    return auth()->check()?auth()->user()->jsPermissions():0;
});


Route::middleware('auth')->group(function () {


    Route::middleware(['can:admin.index'])->group(function () {Route::resource('admin', UserController::class);});



    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/user', [UserController::class,'store'])->name('user.store');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/user/{id}',[UserController::class, 'destroy'])->name('user.destroy');

});

require __DIR__.'/auth.php';
