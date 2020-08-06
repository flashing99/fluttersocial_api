<?php

namespace App\Http\Middleware;

use Closure;

class LocaleMiddleware
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
        // this is to check if header has locale then check if this locale ar or en then set it to app
        if($request->hasHeader('locale')){
            if(in_array($request->header('locale'), ['ar', 'en'])){
                app()->setLocale($request->header('locale'));
            }
        }

        return $next($request);
    }
}
