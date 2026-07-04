<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\EsewaPaymentController;
use App\Http\Controllers\KhaltiPaymentController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRegisterController;
use App\Http\Controllers\VendorPasswordResetController;
use App\Http\Controllers\VendorRegisterController;
use Illuminate\Support\Facades\Route;

// ─── Seller Auth (guest on vendor guard only) ─────────────────────────────────
Route::middleware('guest:vendor')->group(function () {
    Route::get('/seller-login', [SellerController::class, 'login'])->name('seller.login');
    Route::post('/seller-login', [SellerController::class, 'loginSubmit'])->name('seller.login.submit');

    // ─── Seller Forgot / Reset Password ──────────────────────────────────────
    Route::get('/seller/forgot-password', [VendorPasswordResetController::class, 'showForgotForm'])->name('seller.password.request');
    Route::post('/seller/forgot-password', [VendorPasswordResetController::class, 'sendResetLink'])->name('seller.password.email');
    Route::get('/seller/reset-password/{token}', [VendorPasswordResetController::class, 'showResetForm'])->name('seller.password.reset');
    Route::post('/seller/reset-password', [VendorPasswordResetController::class, 'resetPassword'])->name('seller.password.update');
});

Route::post('/seller-logout', [SellerController::class, 'logout'])->name('seller.logout');
Route::get('/seller-profile', [SellerController::class, 'sellerProfile'])->name('seller.profile');
Route::post('/seller-profile', [SellerController::class, 'updateProfile'])->name('seller.profile.update');
Route::post('/seller-password', [SellerController::class, 'updatePassword'])->name('seller.profile.password');

// ─── Seller routes (protected by vendor guard) ────────────────────────────────
Route::middleware(['auth', 'role:vendor'])->group(function () {
    Route::get('/seller-dashboard', [SellerController::class, 'dashboard'])->name('dashboard');
    Route::get('/product-management', [SellerController::class, 'product_management'])->name('product-management');
    Route::get('/create-product', [SellerController::class, 'productCreate'])->name('product-create');
    Route::post('/create-product', [SellerController::class, 'store'])->name('product.store');
    Route::get('/edit-product/{id}', [SellerController::class, 'productEdit'])->name('product-edit');
    Route::put('/product/{id}', [SellerController::class, 'update'])->name('product.update');
    Route::delete('/product/{id}', [SellerController::class, 'destroy'])->name('product.destroy');
    Route::get('/orders', [SellerController::class, 'order'])->name('order');
    Route::get('/order-details', [SellerController::class, 'orderDetails'])->name('order-details');
    Route::post('/order-details/{order}/payment-status', [SellerController::class, 'updatePaymentStatus'])->name('order-details.payment-status');
    Route::get('/return', [SellerController::class, 'returnProducts'])->name('seller.returns');
    Route::get('/return-details', [SellerController::class, 'returnDetails'])->name('return-details');
    Route::get('/seller-review', [SellerController::class, 'sellerReview'])->name('seller.review');
    Route::get('/seller-payments', [SellerController::class, 'sellerPayment'])->name('seller.payment');
    Route::get('/seller-payments-details', [SellerController::class, 'paymentDetails'])->name('payment-details');
    Route::get('/seller-support', [SellerController::class, 'sellerSupport'])->name('seller-support');
    Route::get('/create-ticket', [SellerController::class, 'createTicket'])->name('create-ticket');
    Route::post('/create-ticket', [SellerController::class, 'storeTicket'])->name('store-ticket');
    Route::get('/tickets', [SellerController::class, 'sellerTicket'])->name('seller-ticket');
    Route::get('/seller-notification', [SellerController::class, 'sellerNotification'])->name('seller-notification');
    Route::patch('/seller-notification/read-all', [SellerController::class, 'markAllNotificationsRead'])->name('seller.notifications.markAllRead');
    Route::patch('/seller-notification/{id}/read', [SellerController::class, 'markNotificationRead'])->name('seller.notifications.read');
});

// ─── Seller registration (public) ─────────────────────────────────────────────
Route::get('/seller', [SellerController::class, 'seller'])->name('seller');

// ─── Public routes ────────────────────────────────────────────────────────────
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/categories', [PageController::class, 'categories'])->name('categories');
Route::get('/shop', [PageController::class, 'shop'])->name('shop');
Route::get('/new-arrivals', [PageController::class, 'new_arrival'])->name('new-arrivals');
Route::get('/todays-deals', [PageController::class, 'todays_deals'])->name('todays-deals');
Route::get('/top-sellers', [PageController::class, 'top_sellers'])->name('top-sellers');
Route::get('/about-us', [PageController::class, 'about_us'])->name('about-us');
Route::get('/wishlist', [PageController::class, 'wishlist'])->name('wishlist');
Route::get('/privacypolicy', [PageController::class, 'privacy'])->name('privacy');
Route::get('/contact-us', [PageController::class, 'contactus'])->name('contact-us');
Route::get('/viewdetails/{id}', [PageController::class, 'viewProduct'])->name('viewdetails');
Route::get('/terms_&_conditions', [PageController::class, 'terms_conditions'])->name('terms&conditions');
Route::get('/return_&_refund', [PageController::class, 'return_policy'])->name('return&refund');
Route::get('/faq', [PageController::class, 'faq'])->name('faq');
Route::get('/seller_policy', [PageController::class, 'seller_policy'])->name('seller-policy');
Route::get('/FAQ', [PageController::class, 'faq'])->name('faq');
Route::get('/shipping-info', [PageController::class, 'shipping_policy'])->name('shipping-policy');

// ─── Requires login (guests are redirected to /userlogin automatically) ───────
Route::middleware('auth')->group(function () {
    Route::get('/wishlist', [PageController::class, 'wishlist'])->name('wishlist');

    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add', [CartController::class, 'store'])->name('cart.add');
    Route::patch('/cart/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cart}', [CartController::class, 'destroy'])->name('cart.remove');

    // Checkout is per cart line by default — one product = one order.
    Route::get('/checkout/{cart}', [CheckoutController::class, 'show'])->name('checkout.show');
    Route::post('/checkout/{cart}', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::post('/checkout/{cart}/save-user-info', [CheckoutController::class, 'saveUserInfo'])->name('checkout.save-user-info');

    // Bulk checkout — combines every cart line from one vendor into a single order.
    Route::get('/checkout/vendor/{vendor}', [CheckoutController::class, 'showVendor'])->name('checkout.show.vendor');
    Route::post('/checkout/vendor/{vendor}', [CheckoutController::class, 'storeVendor'])->name('checkout.store.vendor');
    Route::post('/checkout/vendor/{vendor}/save-user-info', [CheckoutController::class, 'saveVendorUserInfo'])->name('checkout.save-user-info.vendor');

    Route::get('/order/{order}/confirmation', [CheckoutController::class, 'confirmation'])->name('order.confirmation');

    // Khalti ePayment: initiate sends the customer to Khalti's hosted
    // checkout, callback is where Khalti redirects them back to afterward.
    Route::get('/payment/khalti/{order}/initiate', [KhaltiPaymentController::class, 'initiate'])->name('khalti.initiate');
    Route::get('/payment/khalti/callback', [KhaltiPaymentController::class, 'callback'])->name('khalti.callback');

    // eSewa ePay: initiate shows an auto-submitting form that posts to
    // eSewa's hosted checkout, callback is where eSewa sends the customer
    // back afterward (used as both its success_url and failure_url).
    Route::get('/payment/esewa/{order}/initiate', [EsewaPaymentController::class, 'initiate'])->name('esewa.initiate');
    Route::get('/payment/esewa/callback', [EsewaPaymentController::class, 'callback'])->name('esewa.callback');
});

// ─── User Auth routes (guest on web guard) ────────────────────────────────────
Route::middleware('web')->group(function () {
    Route::get('/google/redirect', [AuthController::class, 'redirect'])->name('google.redirect');
    Route::get('/google/callback', [AuthController::class, 'callback'])->name('google.callback');
    Route::get('/userlogin', [AuthController::class, 'showLogin'])->name('userlogin');
    Route::post('/userlogin', [AuthController::class, 'login']);

    Route::get('/userregister', [PageController::class, 'home'])->name('userregister');
    Route::post('/userregister', [UserRegisterController::class, 'register']);

    // Fallback/compatibility routes
    Route::get('/login', function () {
        return redirect()->route('userlogin');
    })->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [UserRegisterController::class, 'register'])->name('register');

    Route::get('/vendor/register', [VendorRegisterController::class, 'show'])->name('vendor.register');
    Route::post('/vendor/register', [VendorRegisterController::class, 'register'])->name('vendor.register.post');

    // ─── Forgot / Reset Password ──────────────────────────────────────────────
    // GET  /forgot-password        → show the "enter your email" form (standalone page)
    Route::get('/forgot-password', [PasswordResetController::class, 'showForgotForm'])
        ->name('password.request');

    // POST /forgot-password        → send the reset link email
    Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink'])
        ->name('password.email');

    // GET  /reset-password/{token} → show the "choose new password" form
    Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])
        ->name('password.reset');

    // POST /reset-password         → save the new password
    Route::post('/reset-password', [PasswordResetController::class, 'resetPassword'])
        ->name('password.update');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/user-dashboard', [UserController::class, 'dashboard'])->name('Userdashboard');
Route::get('/user-orders', [UserController::class, 'orders'])->name('User-orders');
Route::get('/user-order-details', [UserController::class, 'orderDetail'])->name('order-detail');
Route::patch('/user-orders/{order}/cancel', [UserController::class, 'cancelOrder'])->name('order.cancel');
Route::get('/return-product', [UserController::class, 'returnProduct'])->name('return-product');
Route::get('/user-profile', [UserController::class, 'userProfile'])->name('user-profile');
Route::post('/user-profile', [UserController::class, 'updateProfile'])->name('user.profile.update');
Route::post('/user-password', [UserController::class, 'updatePassword'])->name('user.password.update');
Route::get('/user-notification', [UserController::class, 'userNotification'])->name('user-notification');
Route::post('/user-notification/mark-all-read', [UserController::class, 'markAllNotificationsRead'])->name('user.notifications.markAllRead');
Route::patch('/user-notification/{id}/read', [UserController::class, 'markNotificationRead'])->name('user.notifications.read');
Route::redirect('/login.php', '/userlogin');
