<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class ValidMember
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
        if (auth::user()->banned) {
                    return $next($request);
               }else{
                    Auth::guard()->logout();
                    $request->session()->invalidate();

                    return redirect('/login');
               }
    }
}
