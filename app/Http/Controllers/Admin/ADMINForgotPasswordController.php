<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Mail;
use Request;
use Auth;
use Illuminate\Support\Facades\Password;

class ADMINForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */
    use SendsPasswordResetEmails;

    protected $guard = 'admin';

    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function __construct()
    {
        $this->middleware('guest');
    }
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordAdmin($token));
    }

    public function showLinkRequestForm()
    {
        return view('admin.passwords.email');
    }


    public function broker()
    {
        return Password::broker('admins');
    }
}
