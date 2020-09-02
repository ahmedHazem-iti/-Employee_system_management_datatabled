<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Session;

class CheckSuper
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
        if(Auth::check() && Auth::user()->admin_role==1)
        {
            return $next($request);
        }else{
            Auth::logout();
            Session::flash('status', 'You Must Be SuperUser!');

            return redirect('/login') ;
        }

        return $next($request);
    }
}
