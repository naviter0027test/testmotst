<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;
use Session;

class CheckMember
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
        if(Session::has('member') == true) {
            if($request->path() == 'member/login')
                return redirect('/member/home');
            return $next($request);
        } else if($request->path() == 'member/login') {
            return $next($request);
        }

        return redirect('/member/login');
    }
}
