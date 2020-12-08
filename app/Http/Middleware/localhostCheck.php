<?php

namespace App\Http\Middleware;

use Closure;

class localhostCheck
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
        if($request->ip() == request()->server('SERVER_ADDR')){
            return $next($request);
        }
        abort(404);
    }
}
