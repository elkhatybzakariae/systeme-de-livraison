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
        if(isset(session('user')['id_Cl'])){

            $user=Client::find(session('user')['id_Cl']);
            // dd($user);
            if ($user && $user->isAccepted) {
                return $next($request);
            }
        }
        
        return redirect(route('auth.client.signIn'));
    }
}
