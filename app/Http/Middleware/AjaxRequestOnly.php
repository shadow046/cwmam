<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class AjaxRequestOnly
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
        if($request->ajax()) {
            //dd(Auth::user()->id);
            return $next($request);
        }
        abort(403, 'Unauthorized Access!');
    }
}
