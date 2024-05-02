<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user=Admin::find(session('user')['id_Ad']);

        if ($user) {
            return $next($request);
        }else{

            abort(403); // Replace 'forbidden' with your forbidden route
        }
        
        // Redirect or abort here if the user is not an admin
    }
}
