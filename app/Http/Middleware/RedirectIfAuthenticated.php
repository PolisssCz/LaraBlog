<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;
        foreach ($guards as $guard) {
            //if the user is logged in, edit the url as requested.
            if (Auth::guard($guard)->check()) {
                $url= url()->current();
                if( strpos( $url, "home") )  {
                    return redirect(url(''));
                }else{
                    $trim = explode("/guest", $url);
                    return redirect($trim[0]);
                }
            }
        }

        return $next($request);
    }
}
