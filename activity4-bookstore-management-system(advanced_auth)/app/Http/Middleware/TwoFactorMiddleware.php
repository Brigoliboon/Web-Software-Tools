<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TwoFactorMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Skip 2FA check for auth routes and 2FA verification routes
        if ($request->is('login') || $request->is('logout') || $request->is('register') ||
            $request->is('password/*') || $request->is('two-factor/*') ||
            $request->is('email/*')) {
            return $next($request);
        }

        // Check if user is authenticated
        if (Auth::check()) {
            $user = Auth::user();

            // If user has 2FA enabled but hasn't verified yet, redirect to verification
            if ($user->two_factor_enabled && !session('two_factor_verified', false)) {
                // But don't redirect if they're already on the verification page
                if (!$request->is('two-factor/verify')) {
                    return redirect()->route('two-factor.verify');
                }
            }
        }

        return $next($request);
    }
}