<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

// use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated and has the admin role
        if ($request->user() && $request->user()->role === 'admin' || $request->user()->role === 'landlord') {
            return $next($request);
        }

        // Redirect to the home page or show an error message
        return redirect('/')->with('error', 'You do not have permission to access this page.');
    }
}
