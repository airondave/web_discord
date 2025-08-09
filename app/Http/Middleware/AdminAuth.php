<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->guard('admin')->check()) {
            return redirect('/admin/login')->with('error', 'Please login to access admin panel.');
        }

        // Check if admin is active
        if (!auth()->guard('admin')->user()->is_active) {
            auth()->guard('admin')->logout();
            return redirect('/admin/login')->with('error', 'Your admin account has been deactivated.');
        }

        return $next($request);
    }
}
