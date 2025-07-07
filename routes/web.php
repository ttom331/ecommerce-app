<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\GuestBasketController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\SubCategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/category/{name}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/category/{name}/{subcategory}', [SubCategoryController::class, 'show'])->name('subcategory.show');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('product.show');

Route::middleware('guest')->group(function (){ //only for guests 
    Route::get('/register', [RegisteredUserController::class, 'create']);
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store']);

    Route::post('/basket', [GuestBasketController::class, 'store']);
    Route::get('/basket', [GuestBasketController::class, 'show']);
    Route::delete('/basket', [GuestBasketController::class, 'remove']);
    Route::patch('/basket', [GuestBasketController::class, 'update']);

    Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
    Route::get('/success', [CheckoutController::class, 'success'])->name('success');
    Route::post('/webhook', [CheckoutController::class, 'webhook'])->name('webhook');
});

Route::middleware('auth')->group(function (){

});

Route::delete('/logout', [SessionController::class, 'destroy'])->middleware('auth');
