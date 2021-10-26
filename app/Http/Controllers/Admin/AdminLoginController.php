<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Session;
use App\Admin;
use Illuminate\Http\Request;

class AdminLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
     protected $redirectTo = '/admin/home';
     protected $guard = 'admins';
     protected function guard()
    {
        return Auth::guard('admins');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
      
    }

    function showLoginForm(){
    if (Auth::guard('admins')->guest()){
           return view('admin.login');
    }else{
           return redirect('admin/home');  
    } 
        
    }

public function username()
    {
        return 'user_key';
    }
    public function logout(Request $request)
    {
        $this->guard('admin')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect('/admin/login');
    }

}
