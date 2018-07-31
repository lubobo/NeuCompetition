<?php

namespace App\Http\Middleware;

use Closure;

class Login
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
        session(['middle'=>'yes']);
        if(!session('user')){
            session(['url'=>$request->url()]);
            return redirect()->route('login');
        }
        if($request->url()==route('adminHome')){
            if(session('role')!='admin'){
                return redirect()->route('welcome');
            }
        }
        return $next($request);
    }
}
