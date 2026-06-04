<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\SellerController;
use Illuminate\Support\Facades\Route;

Route::get('seller-dashboard', [SellerController::class, 'dashboard'])->name('dashboard');
Route::get('product-management', [SellerController::class, 'product_management'])->name('product-management');

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/categories', [PageController::class, 'categories'])->name('categories');
Route::get('/shop', [PageController::class, 'shop'])->name('shop');
Route::get('/new-arrivals', [PageController::class, 'new_arrival'])->name('new-arrivals');
Route::get('/todays-deals', [PageController::class, 'todays_deals'])->name('todays-deals');
Route::get('/featured-products', [PageController::class, 'featured_products'])->name('featured-products');
Route::get('/top-sellers', [PageController::class, 'top_sellers'])->name('top-sellers');
Route::get('/about-us', [PageController::class, 'about_us'])->name('about-us');
