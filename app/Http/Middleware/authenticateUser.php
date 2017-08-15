<?php

namespace App\Http\Middleware;

use Closure;

class authenticateUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        session()->regenerate();
        if(session('usertype') == 'buyer'){
            
        }
            
        return $next($request);
    }
}
