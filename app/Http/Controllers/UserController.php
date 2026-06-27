<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard()
    {
        return view('user.dashboard');
    }

    public function orders()
    {
        return view('user.orders');
    }

    public function orderDetail()
    {
        return view('user.order-details');
    }

    public function returnProduct()
    {
        return view('user.return');
    }

    public function userProfile()
    {
        return view('user.profile');
    }

    public function userNotification()
    {
        return view('user.notification');
    }
}
