<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;

Route::get('/', [ProductController::class, 'index']);

Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');

Route::get('/login', [AuthController::class, 'login'])->name('Auth.login');

Route::get('/profile', [ProfileController::class, 'profile'])->name('Profile.profile');
Route::get('/profile/update', [ProfileController::class, 'update'])->name('Profile.update');
Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('Profile.updateProfile');

Route::get('/order-history', [OrderController::class, 'orderHistory'])->name('Order.order_history');


