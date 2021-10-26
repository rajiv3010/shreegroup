<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Payout;
use DB;
use Mail;
use Auth;
class Email extends Model
{
    protected $fillable = [
        'sender_id', 'receiver_id', 'category_name','subject','message'
    ];


      public function sendBandTransactionReport($attachment)
      {
         Mail::send('email.transactionSentToBank', function ($m){
            $m->from('no-reply@myocean.in', 'My Ocean');
            $m->to('anirudhmishra77@gmail.com')->subject('Transaction sent to bank '.date('Y-m-d'));
            $m->attach($attachment);
        }); 
          
      }

      // Email for benefit details

      public function sendsUserPasswordResetEmail($user,$token)
      {
         Mail::send('email.userPasswordReset', ['user' => $user,'token'=>$token],  function ($m) use ($user){
            $m->from('no-reply@myocean.in', 'The Ocean');
            $m->to($user->email, $user->first_name)->subject('Password Reset Email');
        }); 

      }


      public function sendBenefitsEmailDetails($data,$classified)
      {
         Mail::send('email.sendBenefitsEmailDetails', ['data' => $data,'classified'=>$classified],  function ($m) use ($classified){
            $m->from('no-reply@myocean.in', 'My Ocean');
            $m->to($classified->email, $classified->first_name)->subject('Benefit cover details');
        }); 
      }

      public function sendWelcomeEmailDPC($dpc,$password)
      {
         Mail::send('email.DPCWelcome', ['data' => $dpc,'password'=>$password],  function ($m) use ($dpc){
            $m->from('no-reply@myocean.in', 'My Ocean');
            $m->to($dpc->email, $dpc->name)->subject('Welcome to My Ocean');
        }); 
      }
      public function APCWelcome($apc,$password)
      {
         Mail::send('email.apcWelcome', ['data' => $apc,'password'=>$password],  function ($m) use ($apc){
            $m->from('no-reply@myocean.in', 'My Ocean');
            $m->to($apc->email, $apc->name)->subject('Welcome to My Ocean');
        }); 
      }
         public function sendCPlTemplateMail($advertisement_id)
      {
        $data = Advertisement::where('id',$advertisement_id)->first();
          Mail::send('email.cplTemplate', ['data' => $data->email_template],  function ($m) use ($data){
            $m->from('no-reply@myocean.in', 'My Ocean');
            $m->to(Auth::user()->email, Auth::user()->name)->subject($data->subject);
        });
        return 1;

      }
         public function sendTestCPlTemplateMail($advertisement_id,$email,$name)
      {
        $data = Advertisement::where('id',$advertisement_id)->first();
          Mail::send('email.cplTemplate', ['data' => $data->email_template],  function ($m) use ($data,$email,$name){
            $m->from('no-reply@myocean.in', 'My Ocean');
            $m->to($email, $name)->subject($data->subject);
        });
        return 1;

      }

         public function sendClassifiedDetails($data,$password)
      {
          Mail::send('email.ClassifiedWelcome', ['data' => $data,'password'=>$password],  function ($m) use ($data){
            $m->from('no-reply@myocean.in', 'My Ocean');
            $m->to($data->email, $data->name)->subject('Welcome to My Ocean');
        });
        return 1;

      }
         public function welcomeUser($data,$password,$transaction_password)
      {
          Mail::send('email.UserWelcome', ['data' => $data,'password'=>$password,'transaction_password'=>$transaction_password],  function ($m) use ($data){
            $m->from('no-reply@myocean.in', 'My Ocean');
            $m->to($data->email, $data->name)->subject('Welcome to My Ocean');
        });
        return 1;

      }

      public function advertiserWelcome($data,$password)
      {
         Mail::send('email.advertiserWelcome', ['data' => $data,'password'=>$password],  function ($m) use ($data){
            $m->from('no-reply@myocean.in', 'My Ocean');
            $m->to($data['email'], $data['name'])->subject('Welcome to My Ocean');
        });
        return 1;
      }
// Email SEND PART


    public function myEarning()
    {
            return Auth::user()->wallet;    
    }

    public function classifiedWallet($user_key)
    {
        $wallet= DB::table('classified_wallets')->where('user_key',$user_key)->first();
        if ($wallet) {
            return $wallet->amount;
        }else{
            return 0;
        }
    }
    
    public function pincreate($user_key)
    {
         $payout  =  Payout::select(DB::raw("IFNULL(sum(amount),0) as amount"))
                            ->where('user_key',$user_key)
                            ->where('status',0)
                            ->where('business_area_id',12)
                            ->groupby('business_area_id')
                            ->first();
                        
                if (count($payout)) {
                     return $payout->amount;
                }
                   return 0;
    }

    public function classifiedEarning($user_key)
    {
        $payout  =   Payout::select(DB::raw("IFNULL(sum(amount),0) as amount"))->where('status',0)->where('business_area_id',5)->where('user_key',$user_key)->first();
        if (count($payout)) {
        return $payout->amount;
        }
        return 0;
    } 
 public function redemption($user_key)
    {
        $payout  =   Payout::select(DB::raw("IFNULL(sum(amount),0) as amount"))->where('business_area_id',2)->where('user_key',$user_key)->first();
        if (count($payout)) {
        return $payout->amount;
        }
        return 0;
    }

    public function days750($user_key)
    {
        $payout  =   Payout::select(DB::raw("IFNULL(sum(amount),0) as amount"))->where('business_area_id',13)->where('user_key',$user_key)->first();
        if (count($payout)) {
        return $payout->amount;
        }
        return 0;
    } 

        public function binaryPayout($user_key)
    {
        $payout  =   Payout::select(DB::raw("IFNULL(sum(amount),0) as amount"))->where('status',0)->where('business_area_id',1)->where('user_key',$user_key)->first();
        if (count($payout)) {
        return $payout->amount;
        }
        return 0;
    } 
    public function directEarning($user_key,$ba_id)
    {
        $payout  =  Payout::select(DB::raw("IFNULL(sum(amount),0) as amount"))
                            ->where('user_key',$user_key)
                            ->where('status',0)
                            ->where('business_area_id',$ba_id)
                            ->groupby('business_area_id')
                            ->first();
                if (count($payout)) {
                     return $payout->amount;
                }
                   return 0;
    } 
    public function adEarning($user_key,$ba_id)
    {

          $pay =   Payout::select('status','created_at',DB::raw("IFNULL(sum(amount),0) as amount"))
                              ->where('business_area_id',7)
                              ->where('status',0)
                              ->where('user_key',$user_key)->groupby('created_at','status')
                              ->get();
                $sum = 0;
                foreach ($pay as $key => $value) {
                    $sum += $value->amount;
                }
                return $sum;
    } 

}
