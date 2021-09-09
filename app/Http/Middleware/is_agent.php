<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class is_agent
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
        if(auth()->user()->usr_type == 'usr_agent') {
            return $next($request);
            }
          //  session()->flash( 'message', 'Your message' );
          //  return  redirect()->route('access_denied')->with('error','You do not have the permission to access this area');
           return  redirect()->route('access_denied');
    }
}
