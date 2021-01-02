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
 //Ja visām moduļa lapām var piekļūt tikai administratori
    public function handle($request, Closure $next)
{
  //Pārbauda vai lietotājs ir autentificējies un lietotāja loma ir 1(administrators)
    if ( Auth::check() && Auth::user()->Role == 1 )
    {
        return $next($request);
    }
 //Ja nav tad tiek nosūtīts uz Home lapu, kas ir /profile
    return redirect(RouteServiceProvider::HOME);

}
}
