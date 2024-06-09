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
        if(isset(session('admin')['id_Ad'])){
            
            $admin=Admin::find(session('admin')['id_Ad']);
            
            if ($admin) {
                return $next($request);
            }
            dd(session('admin')['id_Ad']);
            
        }
        session(['url.intended' => $request->fullUrl()]);
        dd(session('admin'));
    
            return redirect(route('auth.admin.signIn')); 
    }
}
