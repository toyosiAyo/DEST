<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!session()->has('user') && $request->path() != '/'
         && $request->path() !='get/account/form'){
            return redirect('/')->with('fail','You must login!');
        }
        if(session()->has('user') && ($request->path() == '/' || $request->path() == 'get/account/form')
        ){
            return back();
        }
        return $next($request)
        ->header('Cache-Control','no-cache, no-store, max-age=0,
        must-revalidate')
        ->header('pragma','no-cache')
        ->header('Expires','Sat 01 Jan 1990 00:00:00 GMT');
    }
}
