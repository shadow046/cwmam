<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class test
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
        //$token = $request->header('APP_KEY');
        if (Auth::guest()) {
            dd(Auth::user());
        }else{
            return $next($request);
        }
        
    }
}