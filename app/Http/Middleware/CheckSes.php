<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Session\Session;

class CheckSes
{

    public function handle($request, Closure $next)
    {
//        if(Session::start()){
//            $_SESSION = Session::save();
//        }
        return $next($request);
    }
}
