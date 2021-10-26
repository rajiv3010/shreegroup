<?php

namespace App\Http\Middleware;

use Closure;

class VerifyCustomer
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
        if ($request->customer_code="eSchool" && $request->access_token="123456789") {
                return $next($request);
        }else{
          $data = array('status' =>false,'error'=>'Invalid user');
            return response()->json($data);
        }
    }
}
