<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\VendorRegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/seller', [SellerController::class, 'seller'])->name('seller');
Route::get('/seller-dashboard', [SellerController::class, 'dashboard'])->name('dashboard');
Route::get('/product-management', [SellerController::class, 'product_management'])->name('product-management');

// Public routes
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/categories', [PageController::class, 'categories'])->name('categories');
Route::get('/shop', [PageController::class, 'shop'])->name('shop');
Route::get('/new-arrivals', [PageController::class, 'new_arrival'])->name('new-arrivals');
Route::get('/todays-deals', [PageController::class, 'todays_deals'])->name('todays-deals');
Route::get('/featured-products', [PageController::class, 'featured_products'])->name('featured-products');
Route::get('/top-sellers', [PageController::class, 'top_sellers'])->name('top-sellers');
Route::get('/about-us', [PageController::class, 'about_us'])->name('about-us');

// Auth routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/vendor/register', [VendorRegisterController::class, 'show'])->name('vendor.register');
    Route::post('/vendor/register', [VendorRegisterController::class, 'register']);
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Vendor routes — must be logged in AND have vendor role
Route::middleware(['auth', 'role:vendor'])->group(function () {
    Route::get('/seller-dashboard', [SellerController::class, 'dashboard'])->name('dashboard');
    Route::get('/product-management', [SellerController::class, 'product_management'])->name('product-management');
});
