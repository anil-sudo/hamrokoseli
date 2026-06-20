<?php

namespace App\Http\Controllers;

use App\Mail\NewVendorRegistered;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class TestEmailControlelr extends Controller
{
    public function index()
    {

        $adminUser = User::find(8);
        $user = User::find(12);

        $vendor = $user->vendor;

        Mail::to($adminUser)->send(new NewVendorRegistered($vendor));
    }
}
