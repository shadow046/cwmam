<?php

namespace App\Http\Middleware;
use Closure;
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
        if ($result) {
            return $next($request);
        } else {
            return abort('404');
        }
    }
}
