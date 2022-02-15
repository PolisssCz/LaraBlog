<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdministrator
{
    /**
     * reject if the user is not an administrator
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->rank !== 'Administrator') {   
            return redirect('/')->with('NotAuthorised',  (__("Auth.Not_Authorised")) );
        }
        return $next($request);
    }
}
