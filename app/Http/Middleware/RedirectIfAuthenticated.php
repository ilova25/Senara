<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if (Auth::check()) {
            $role = Auth::user()->role;

            if ($role === 'tamu') {
                return redirect()->route('home');
            }

            if ($role === 'resepsionis' || $role === 'owner') {
                return redirect()->route('dashboard');
            }
        }

        return $next($request);
    }
}
