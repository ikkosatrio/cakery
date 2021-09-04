<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsMember
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
        if (Auth::guard('member')->user()) {
                return $next($request);
        }

        return redirect('/member/login')->withErrors(["Login to access the page"]);
    }
}
