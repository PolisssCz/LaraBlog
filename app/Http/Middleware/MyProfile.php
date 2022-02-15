<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;

class MyProfile
{
    /**
     * Do not show my-posts/{other user}
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $Autorised, Closure $next)
    {
        $email = Auth::user()->email;

        if ( URL::current() !== url("my-posts/$email") )
        {
            return redirect('/')->with('NotAuthorised', (__("Auth.Not_Authorised")) );
        }
        
        return $next($Autorised);
    }
}
