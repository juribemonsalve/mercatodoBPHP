<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\Auth\AuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('auth/login',[AuthController::class,'login']);

Route::middleware(['auth:sanctum'])->group(function (){

    Route::get('products/index', [ProductController::class, 'index']);

    Route::get('product/show/{id}', [ProductController::class, 'show']);

    Route::post('product/store', [ProductController::class, 'store']);

    Route::put('product/update/{id}', [ProductController::class, 'update']);

    Route::get('product/delete/{id}', [ProductController::class, 'destroy']);

    Route::post('logout', [AuthController::class, 'logout']);
});


