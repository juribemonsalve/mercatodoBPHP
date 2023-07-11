<?php

use App\Http\Controllers\categoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\productController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\userController;
use App\Http\Livewire\Shop\Cart\paymentComponent;

use App\Http\Livewire\Shop\indexComponent;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Exports\ExportProductController;
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
Route::get('/cart', PaymentComponent::class)->name('cart');
Route::get('/login', function () {
    return view('login');
})->middleware('guest');

Route::post('/login', 'Auth\authenticate@login')->middleware('CheckBanned');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::middleware(['can:user.index'])->group(function () {
        Route::resource('user', UserController::class);
    })->name('user.index');

    Route::middleware(['can:category.index'])->group(function () {
        Route::resource('/category', CategoryController::class);
    })->name('category.index');

    Route::middleware(['can:product.index'])->group(function () {
        Route::resource('product', ProductController::class);
    })->name('product.index');

    Route::get('/products/export', [ExportProductController::class, 'export'])->name('products.export');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');

    Route::resource('orders', OrderController::class)->only(['index']);

    Route::post('payments', [PaymentComponent::class, 'processPayment'])->name('payments.processPayment');
    Route::get('payments/payment/response', [PaymentComponent::class, 'processResponse'])->name('payments.processResponse');
});

require __DIR__ . '/auth.php';
