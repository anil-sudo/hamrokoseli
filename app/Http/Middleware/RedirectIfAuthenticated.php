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
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::guard($guard)->user();

                // Admin → Filament panel
                if ($user->role === 'admin') {
                    return redirect('/admin');
                }

                // Vendor → seller dashboard
                if ($user->role === 'vendor') {
                    return redirect()->route('dashboard');
                }

                // Regular user → home
                return redirect()->route('home');
            }
        }

        return $next($request);
    }
}
