<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Package;
use Auth;
class LoginController extends Controller
{
    public function login(Request $request)
    {
    	 $credentials = $request->only('user_key', 'password');
        
        $rules = [
            'user_key' => 'required',
            'password' => 'required',
        ];
        $validator = Validator::make($credentials, $rules);
        if($validator->fails()) {
            return response()->json(['success'=> false,'level'=>1,'error'=> $validator->messages()]);
        }
        
        
        // all good so return the token
        if (Auth::attempt($credentials)) {
        		$data = array(
                              'status' =>True,
                              'user_key' =>auth::user()->user_key,
                              'fname'=>auth::user()->name,
                               'lname'=>'','joining_date'=>auth::user()->created_at,
                               'date_of_birth'=>auth::user()->dob,
                               'phone'=>auth::user()->mobile,
                               'email'=>auth::user()->email,
                               'package_name'=>auth::user()->package->name
                           );
                return response()->json($data);
        }else{
        	$data = array('status' =>false,'error'=>'User not exists');
            return response()->json($data);

        }
    }


    public function getPackages()
    {
        $packages = Package::all();
        $data = array('status' =>true,'packages'=>$packages);
        return response()->json($data);

    }
}
