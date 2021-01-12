<?php

namespace App\Http\Middleware;


use Closure;

class AuthGates
{
    public function handle($request, Closure $next)
    {
        $user = \Auth::user();
        return $next($request);
    }
}
