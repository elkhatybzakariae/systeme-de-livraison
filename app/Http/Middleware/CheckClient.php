<?php

namespace App\Http\Middleware;

use App\Models\Client;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckClient
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user=Client::find(session('user')['id_Ad']);

        if ($user && $user->isAccepted) {
            return $next($request);
        }
        
        // Redirect or abort here if the user is not an accepted client
        abort(403);
         // Replace 'forbidden' with your forbidden route
    }
}
