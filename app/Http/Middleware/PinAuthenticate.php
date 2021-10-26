<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use App\Authenticate;
use Illuminate\Http\Request;
use Response;
use Auth;

class PinAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
 
        $authObject = new Authenticate;
        $res = $authObject->transactionPinVerification($request['password']);
        if ($res) {
                return $next($request);
        }else{
                return redirect('pin/verification');
        }

    }
}