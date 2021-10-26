<?php

namespace App;
use Eloquent;
use Session;
use Log;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use DB;
class Authenticate extends Model
{

    public function transactionPinVerification($password)
    {
        if (session::get('pinAuthenticate')){
                    return true;
        }else{

            $resParam = DB::table('users')->where('id',Auth::user()->id)->where('transaction_password', $password)->first();
            if ($resParam) {
                session::put(['pinAuthenticate'=>1]);
                return true;
            }else{

                if ($password) {
                        session::flash('message',"Authentication failed");
                } else {
                        
                }
                

                return false;
                }
        }
    }    

}
 