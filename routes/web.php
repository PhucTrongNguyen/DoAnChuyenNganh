<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;

Route::get('/', [ProductController::class, 'index']);

Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');

Route::get('/login', [AuthController::class, 'login'])->name('Auth.login');

Route::get('/profile', [ProfileController::class, 'profile'])->name('Profile.profile');
Route::post('/profile/update', [ProfileController::class, 'updateProfileAndAddress'])->name('profile.update');



