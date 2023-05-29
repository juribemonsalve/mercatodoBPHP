<?php

use App\Http\Controllers\categoryController;
use App\Http\Controllers\productController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\userController;
use App\Http\Livewire\Shop\Cart\IndexComponent as CartIndexComponent;
use App\Http\Livewire\Shop\CheckoutComponet;
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
Route::get('/cart', CartIndexComponent::class)->name('cart');
Route::get('/checkout', CheckoutComponet::class)->name('checkout');

Route::get('/login', function () {
    return view('login');
})->middleware('guest');

Route::post('/login', 'Auth\authenticate@login')->middleware('CheckBanned');

Route::middleware('auth')->group(function () {
    Route::middleware(['can:user.index'])->group(function () {
        Route::resource('user', userController::class);
    })->name('user.index');

    Route::middleware(['can:category.index'])->group(function () {
        Route::resource('/category', categoryController::class);
    })->name('category.index');

    Route::middleware(['can:product.index'])->group(function () {
        Route::resource('product', productController::class);
    })->name('product.index');

    Route::get('/profile', [profileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [profileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [profileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/user', [userController::class, 'store'])->name('user.store');
    Route::put('/user/{id}', [userController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}', [userController::class, 'destroy'])->name('user.destroy');
});

require __DIR__ . '/auth.php';
