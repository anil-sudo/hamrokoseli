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
        // All logins (vendor or buyer) use the default 'web' guard via Auth::attempt().
        // A named guard like 'vendor' shares the same session provider, so checking
        // Auth::guard('vendor') would work only if the user explicitly logged in with
        // that guard. Since we always use the web guard, we fall back to it here.
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->role === 'vendor') {
                return redirect()->route('dashboard');
            }

            if ($user->role === 'admin') {
                return redirect('/admin');
            }

            // Regular authenticated user – send home
            return redirect()->route('home');
        }

        return $next($request);
    }
}

