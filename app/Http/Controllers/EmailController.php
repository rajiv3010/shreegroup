<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Payout;
use App\Email;
use App\Package;
use Auth;
use DB;
use Session;
class EmailController extends Controller
{



         public function __construct()
      {
          $this->email  = new Email();
      }

    public function userDetailsByKey(Request $request)
    {
      $user =  User::where('user_key',$request->user_key)->first();
      if (count($user)) {
          return response()->json(['status'=>1,'user'=>$user]);
      }else{
           return response()->json(['status'=>0,'user'=>$user]);
      }
    }
   public function send(Request $request)
   {
   		if (Auth::guest()) {
   		$users = 	explode(',', $request->emailto);
   			foreach ($users as $key => $sponser_id) {
   				$UserData = User::where('sponser_id',$sponser_id)->first();
   			}
   		$resp = $this->sendMessgae($request,'admin',$UserData->id);
   		}else{
   		$resp = $this->sendMessgae($request,Auth::user()->id,'admin');

   		}
   		if ($resp){
   			session::flash('message','Email has been sent');
   		}else{
   			session::flash('message','Somthing went wrong,Please try again');
   		}
   		return redirect()->back();

   }
   public function sendMessgae($data,$sender,$receiver)
   {

   	$email = email::create([
   			'sender_id'=>$sender,
   			'receiver_id'=>$receiver,
   			'category_name'=>$data->category_name,
   			'subject'=>$data->subject,
   			'message'=>$data->message
   		]);
   	if ($email->id) {
   		return true;
   	}else{
   		return false;
   	}
   }
  public function getNotification($value='')
   {
      
         $wallet = Auth::user()->wallet;
         $member_since  =  Auth::user()->created_at;
         $user_name = Auth::user()->name;
         $user_key  =  Auth::user()->user_key;
         $messages  =  email::where('receiver_id',Auth::user()->id)->get();
         $payouts =Payout::select(DB::raw('sum(amount) total'),'message','created_at','amount','business_area_id','type')
                    ->where('user_key',Auth::user()->user_key)
                    ->where('status',0)
                    ->groupby('business_area_id')
                    ->get();
         $totalPayouts =Payout::select(DB::raw('sum(amount) total'))
        ->where('user_key',Auth::user()->user_key)
        ->first();
        $sum = 0;
        foreach ($payouts as $key => $payout) {
           $sum += $payout->total;
        }
         $myEarning = $totalPayouts->total;
         $logout = '/logout';
         $profile="/profile";
         $user_type = '/';
         if(Auth::user()->profile_photo){
           $img = '<img src="'.env("base_url").'assets/user/'.Auth::user()->id.'/profile/'.Auth::user()->profile_photo.'" class="img-circle" alt="'.Auth::user()->name.'" style="width: 25px;height:25px">';
         }else{
           if(Auth::user()->gender == "m"){
                $img = '<img src="'.env("base_url").'dist/img/avatar5.png" class="img-circle" alt="'.Auth::user()->name.'" style="width: 25px;height:25px">';
           }else{
                $img =  '<img src="'.env("base_url").'dist/img/avatar3.png" class="img-circle" alt="'.Auth::user()->name.'" style="width: 25px;height:25px">';
           }
         }


     if ($myEarning) {
       User::where('user_key',Auth::user()->user_key)->update(['earning'=>$myEarning]);
       if (Auth::user()->is_redemption==0) { 
         $package = package::where('id',Auth::user()->package_id)->first();
         if ($package->amount <=$myEarning) {
                User::where('id',Auth::user()->id)->update(['is_redemption'=>1]);
         }
     }
   }
 
       $view = view('comman.message_notification', [
            'messages' => $messages,
            'user_type' => $user_type,
            'member_since'=>$member_since,
            'user_key'=>$user_key,
            'user_name'=>$user_name,
            'payouts'=>$payouts,
            'sum'=>$sum,
            'profile'=>$profile,
            'logout'=>$logout,
            'img'=>$img

        ]);
        $html = $view->render();
        print_r($html);
   }

}
