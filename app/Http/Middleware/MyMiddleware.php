<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class MyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $request->session()->put('auth_data', Auth::user());
            return $next($request);
        }
        
        return redirect('signout');
    }
}
