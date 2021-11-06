<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Doctor
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return string|null
     */
    public function handle(Request $request, Closure $next)
    {
        if( auth('doctor')->check() ){
            if( auth('doctor')->user()->is_active == true ){
                return $next($request);
            }
            else{
                Auth::guard('doctor')->logout();
                return redirect()->route('login');
            }
        }
        else{
            return redirect()->route('login');
        }
    }
}
