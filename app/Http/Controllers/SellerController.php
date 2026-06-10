<?php

namespace App\Http\Controllers;

class SellerController extends Controller
{
    public function seller()
    {
        return view('seller.register');
    }

    public function dashboard()
    {
        return view('seller.dashboard');
    }

    public function product_management()
    {
        return view('seller.product-management');
    }
}
