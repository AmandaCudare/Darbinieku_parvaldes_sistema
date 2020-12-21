<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

use App\Providers\RouteServiceProvider;
class AdminCheck
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

    if ( Auth::check() && Auth::user()->Role == 1 )
    {
        return $next($request);
    }

    return redirect(RouteServiceProvider::HOME);

}
}
