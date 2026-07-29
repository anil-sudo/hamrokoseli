<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        // If no specific guard is passed, check both known guards.
        $guards = empty($guards) ? ['web', 'vendor'] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::guard($guard)->user();

                // Vendor guard — send to seller dashboard
                if ($guard === 'vendor' || $user->role === 'vendor') {
                    return redirect()->route('dashboard');
                }

                // Admin
                if ($user->role === 'admin') {
                    return redirect('/admin');
                }

                // Regular user hitting a seller guest route — log out of web guard only
                if ($request->is('seller-login') || $request->is('seller/forgot-password') || $request->is('seller/reset-password*') || $request->is('vendor/register')) {
                    Auth::guard('web')->logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();

                    return redirect($request->getRequestUri());
                }

                // Regular authenticated user — send home
                return redirect()->route('home');
            }
        }

        return $next($request);
    }
}
