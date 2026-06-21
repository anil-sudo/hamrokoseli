<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureVendor
{
    public function handle(Request $request, Closure $next)
    {
        if (! Auth::guard('vendor')->check()) {
            return redirect()->route('seller.login')
                ->withErrors(['email' => 'Please login to access the seller dashboard.']);
        }

        if (Auth::guard('vendor')->user()->role !== 'vendor') {
            return redirect()->route('seller.login')
                ->withErrors(['email' => 'You do not have vendor access.']);
        }

        return $next($request);
    }
}
