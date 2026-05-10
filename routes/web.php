<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\PageController;

Route::middleware(['web'])->group(function () {
    Route::get('/', [PageController::class, 'index'])->name('home');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
