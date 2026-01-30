<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;

Route::get('/', [ProductsController::class, 'indexLastFive'])->name('welcome');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/authenticate', [AuthController::class, 'login'])->name('authenticate');
Route::get('/productos', [ProductsController::class, 'indexPublic'])->name('productos');
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::get('/cart/finish', [CartController::class, 'end'])->name('cart.finish');
Route::get('/cart/add/{productId}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/welcome', function () {
        return view('welcome');
    })->name('welcome.auth');
    
    Route::resource('products', ProductsController::class);
    Route::resource('categories', CategoryController::class);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
