<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\TestEmailControlelr;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRegisterController;
use App\Http\Controllers\VendorRegisterController;
use Illuminate\Support\Facades\Route;

// ─── Seller Auth (guest on vendor guard only) ─────────────────────────────────
Route::middleware('guest:vendor')->group(function () {
    Route::get('/seller-login', [SellerController::class, 'login'])->name('seller.login');
    Route::post('/seller-login', [SellerController::class, 'loginSubmit'])->name('seller.login.submit');
});

Route::post('/seller-logout', [SellerController::class, 'logout'])->name('seller.logout');
Route::get('/seller-profile', [SellerController::class, 'sellerProfile'])->name('seller.profile');

// ─── Seller routes (protected by vendor guard) ────────────────────────────────
Route::middleware(['auth', 'role:vendor'])->group(function () {
    Route::get('/seller-dashboard', [SellerController::class, 'dashboard'])->name('dashboard');
    Route::get('/product-management', [SellerController::class, 'product_management'])->name('product-management');
    Route::get('/create-product', [SellerController::class, 'productCreate'])->name('product-create');
    Route::post('/create-product', [SellerController::class, 'store'])->name('product.store');
    Route::get('/edit-product/{id}', [SellerController::class, 'productEdit'])->name('product-edit');
    Route::delete('/product/{id}', [SellerController::class, 'destroy'])->name('product.destroy');
    Route::get('/orders', [SellerController::class, 'order'])->name('order');
    Route::get('/order-details', [SellerController::class, 'orderDetails'])->name('order-details');
    Route::get('/return', [SellerController::class, 'returnProducts'])->name('seller.returns');
    Route::get('/return-details', [SellerController::class, 'returnDetails'])->name('return-details');
    Route::get('/seller-review', [SellerController::class, 'sellerReview'])->name('seller.review');
    Route::get('/seller-payments', [SellerController::class, 'sellerPayment'])->name('seller.payment');
    Route::get('/seller-payments-details', [SellerController::class, 'paymentDetails'])->name('payment-details');
    Route::get('/seller-support', [SellerController::class, 'sellerSupport'])->name('seller-support');
    Route::get('/create-ticket', [SellerController::class, 'createTicket'])->name('create-ticket');
    Route::get('/tickets', [SellerController::class, 'sellerTicket'])->name('seller-ticket');
    Route::get('/seller-notification', [SellerController::class, 'sellerNotification'])->name('seller-notification');
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
Route::get('/wishlist', [PageController::class, 'wishlist'])->name('wishlist');

// ─── User Auth routes (guest on web guard) ────────────────────────────────────
Route::middleware('web')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [UserRegisterController::class, 'register'])->name('register');
    Route::get('/vendor/register', [VendorRegisterController::class, 'show'])->name('vendor.register');
    Route::post('/vendor/register', [VendorRegisterController::class, 'register'])->name('vendor.register.post');
});

Route::get('test-email', [TestEmailControlelr::class, 'index'])->name('test.email');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::redirect('/login.php', '/login');


Route::get('/user-dashboard', [UserController::class, 'dashboard'])->name('Userdashboard');
Route::get('/user-orders', [UserController::class, 'orders'])->name('User-orders');
Route::get('/user-order-details', [UserController::class, 'orderDetail'])->name('order-detail');
Route::get('/return-product', [UserController::class, 'returnProduct'])->name('return-product');
Route::get('/user-profile', [UserController::class, 'userProfile'])->name('user-profile');
Route::get('/user-notification', [UserController::class, 'userNotification'])->name('user-notification');
