<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class is_admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->usr_type == 'usr_admin') {
            return $next($request);
            }
    
            return redirect('/access_denied')->with('error', "You don't have valid permission to continue access."); 
    }
}
