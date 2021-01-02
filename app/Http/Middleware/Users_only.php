<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Closure;

class Users_only
{
    /** 
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    //Ja visām moduļa lapām var piekļūt tikai vadītajs vai darbinieks
    public function handle($request, Closure $next)
    {
        //Pārbauda vai lietotājs ir autentificējies un lietotāja loma ir vai nu 2(darbinieks) vai 3(vadītājs)
    if ( Auth::check() && (Auth::user()->Role == 2 || Auth::user()->Role == 3))
    {
        return $next($request);
    }
    //Ja nav tad tiek nosūtīts uz Home lapu, kas ir /profile
    return redirect(RouteServiceProvider::HOME);
    }
}
