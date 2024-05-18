<?php

namespace App\Http\Middleware;

use App\Models\Livreur;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLivreur
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user=Livreur::find(session('user')['id_Liv']);

        if ($user && $user->isAccepted) {
            return $next($request);
        }
        session(['url.intended' => $request->fullUrl()]);
        return redirect(route('auth.livreur.signIn'));
    }
}
