<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\VendorRegisterController;
use Illuminate\Support\Facades\Route;

// ─── Seller Auth (guest only) ─────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/seller-login', [SellerController::class, 'login'])->name('seller.login');
    Route::post('/seller-login', [SellerController::class, 'loginSubmit'])->name('seller.login.submit');
});

Route::post('/seller-logout', [SellerController::class, 'logout'])->name('seller.logout');
Route::get('/seller-profile', [SellerController::class, 'sellerProfile'])->name('seller.profile');
Route::get('/seller-review', [SellerController::class, 'sellerReview'])->name('seller.review');


// ─── Seller routes (protected) ────────────────────────────────────────────────
Route::middleware(['auth', 'role:vendor'])->group(function () {
    Route::get('/seller-dashboard', [SellerController::class, 'dashboard'])->name('dashboard');
    Route::get('/product-management', [SellerController::class, 'product_management'])->name('product-management');
    Route::get('/create-product', [SellerController::class, 'productCreate'])->name('product-create');
    Route::post('/create-product', [SellerController::class, 'store'])->name('product.store');
    Route::get('/edit-product/{id}', [SellerController::class, 'productEdit'])->name('product-edit');
    Route::delete('/product/{id}', [SellerController::class, 'destroy'])->name('product.destroy');
    Route::get('/orders', [SellerController::class, 'order'])->name('order');
    Route::get('/order-details', [SellerController::class, 'orderDetails'])->name('order-details');
});

// ─── Seller registration (public) ─────────────────────────────────────────────
Route::get('/seller', [SellerController::class, 'seller'])->name('seller');

// ─── Public routes ────────────────────────────────────────────────────────────
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/categories', [PageController::class, 'categories'])->name('categories');
Route::get('/shop', [PageController::class, 'shop'])->name('shop');
Route::get('/new-arrivals', [PageController::class, 'new_arrival'])->name('new-arrivals');
Route::get('/todays-deals', [PageController::class, 'todays_deals'])->name('todays-deals');
Route::get('/featured-products', [PageController::class, 'featured_products'])->name('featured-products');
Route::get('/top-sellers', [PageController::class, 'top_sellers'])->name('top-sellers');
Route::get('/about-us', [PageController::class, 'about_us'])->name('about-us');

// ─── User Auth routes ─────────────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/vendor/register', [VendorRegisterController::class, 'show'])->name('vendor.register');
    Route::post('/vendor/register', [VendorRegisterController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::redirect('/login.php', '/login');
