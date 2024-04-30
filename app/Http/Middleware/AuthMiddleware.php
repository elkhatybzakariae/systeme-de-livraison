<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthMiddleware
{
   
    public function handle($request, Closure $next)
    {
        if (auth()->check()) {
                return $next($request);
        }

        return redirect()->route('auth.client.signIn'); // Redirect to the login page if not authenticated
    }
}
