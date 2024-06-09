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
        
        if(isset(session('client')['id_Cl'])){
            
            $client=Client::find(session('client')['id_Cl']);
            if ($client && $client->isAccepted) {
                return $next($request);
            }
        }

        session(['url.intended' => $request->fullUrl()]);
        // dd(session('url.intended'));
        return redirect(route('auth.client.signIn'));
    }
}
