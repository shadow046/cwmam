<?php

namespace App\Http\Middleware;
use Closure;
use Auth;
class CheckMiddleware
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
        $agent = new \Jenssegers\Agent\Agent;
        $result = $agent->isDesktop();
        if (!$result) {
            return abort('404');
        }
        
        return $next($request);
    }
}
