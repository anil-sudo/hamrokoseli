<?php

use App\Http\Controllers\SellerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('seller-dashboard', [SellerController::class, 'dashboard'])->name('dashboard');
