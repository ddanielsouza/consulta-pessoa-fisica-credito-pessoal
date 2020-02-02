<?php

namespace App\Http\Middleware;

use Closure;

class Caching
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
        
        if($request->isMethod('get')){
            $cacheKey = $request->getPathInfo();

            if(!\Cache::has($cacheKey)) {
                $response =  $next($request);
                \Cache::put($cacheKey, $response, 60 * 60 * 24);
                return $response;
            }
            else {
                return \Cache::get($cacheKey);
            }
        }
        else{
            return $next($request);
        }
        
    }
}
