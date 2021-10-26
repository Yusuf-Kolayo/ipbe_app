<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class is_super
{
     
    public function handle(Request $request, Closure $next)
    {
        if((auth()->user()->usr_type == 'usr_admin')&&(auth()->user()->adm_type == 'super')) {
            return $next($request);
        }
    
        return redirect('/access_denied')->with('error', "You don't have valid permission to continue."); 
    }
}
