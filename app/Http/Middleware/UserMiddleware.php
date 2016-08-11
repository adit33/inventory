<?php

namespace App\Http\Middleware;
use Auth;
use Closure;
use Illuminate\Contracts\Auth\Guard;


class UserMiddleware
{

    protected $auth;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    // public function __construct(Guard $auth)
    // {
    //     $this->auth = $auth;
    // }

     public function handle($request, Closure $next)
    {
        if ( Auth::user()->userId != "admin") {
            
                return redirect('login');
            
        }
        else{

            return $next($request);
        }
    }
}
