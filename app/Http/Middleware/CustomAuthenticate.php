<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CustomAuthenticate
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
        if( auth('medical_assistant')->check() ){
            return $next($request);
        }
        elseif( auth('doctor')->check() ){
            return $next($request);

        }
        elseif( auth('patient')->check() ){
            return $next($request);
        }
        else{
            return redirect()->route('login');
        }
    }
}
