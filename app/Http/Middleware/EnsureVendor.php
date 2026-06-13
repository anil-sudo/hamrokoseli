<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureVendor
{
    public function handle(Request $request, Closure $next)
    {
        // Not logged in at all → go to seller login
        if (! Auth::check()) {
            return redirect()->route('seller.login')
                ->withErrors(['email' => 'Please login to access the seller dashboard.']);
        }

        // Logged in but not a vendor → go to seller login
        if (Auth::user()->role !== 'vendor') {
            return redirect()->route('seller.login')
                ->withErrors(['email' => 'You do not have vendor access.']);
        }

        return $next($request);
    }
}
