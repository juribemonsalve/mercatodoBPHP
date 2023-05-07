<?php

use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\Shop\IndexComponent;
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
Route::get('/', IndexComponent::class)->name('inicio');

Route::get('/login', function () {
    return view('login');
})->middleware('guest');

Route::post('/login', 'Auth\authenticate@login')->middleware('CheckBanned');

Route::middleware('auth')->group(function () {
    Route::middleware(['can:user.index'])->group(function () {
        Route::resource('user', UserController::class);
    })->name('user.index');

    Route::middleware(['can:category.index'])->group(function () {
        Route::resource('category', CategoryController::class);
    })->name('category.index');

    Route::middleware(['can:adminproduct.index'])->group(function () {
        Route::resource('adminproduct', AdminProductController::class);
    })->name('adminproduct.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');

    Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
    Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

    Route::post('/product', [AdminProductController::class, 'store'])->name('product.store');
    Route::put('/product/{id}', [AdminProductController::class, 'update'])->name('product.update');
    Route::delete('/product/{id}', [AdminProductController::class, 'destroy'])->name('product.destroy');
});

require __DIR__ . '/auth.php';
