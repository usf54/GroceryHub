<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class DriverMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if user is authenticated and has role 'driver'
        if (Auth::check() && Auth::user()->role === 'driver') {
            return $next($request);
        }

        // Redirect non-drivers to home with an error message
        return redirect('/')->with('error', 'Access denied.');
    }
}
