<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    
    public function handle(Request $request, Closure $next)
    {
        if(isset(session('user')['id_Ad'])){

        $user=Admin::find(session('user')['id_Ad']);

        if ($user) {
            return $next($request);
        }

    }
    session(['url.intended' => $request->fullUrl()]);
    
            return redirect(route('auth.admin.signIn')); 
    }
}
