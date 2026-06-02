<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('seller-dashboard', function () {
    return view('seller.dashboard');
})->name('seller.dashboard');
