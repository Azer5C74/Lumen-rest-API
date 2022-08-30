<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminsOnly
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
        // Pre-Middleware Action
        if(Auth::user()-> isAdmin = false){
            abort(Response::HTTP_FORBIDDEN);
        }
        $response = $next($request);

        // Post-Middleware Action

        return $response;
    }
}
