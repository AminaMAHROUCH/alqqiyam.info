<?php

namespace App\Http\Middleware;

use Closure;
use Response;
use App\Helpers\RestTokenHelper;

class ApiMiddleware
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
        $token = RestTokenHelper::getUserFromToken($request->header('token'));
        
        if (!RestTokenHelper::getAuthUser()) {
            abort(403, 'Access denied');
        }
        
        return $next($request); 
    }
}
