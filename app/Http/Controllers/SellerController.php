<?php

namespace App\Http\Controllers;

class SellerController extends Controller
{
    public function dashboard()
    {
        return view('seller.dashboard');
    }
}
