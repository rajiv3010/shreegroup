<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Payout;
use DB,Log;
class Payment extends Model
{
      protected $fillable = [
        'user_key','user_id','amount','earning','status','admin_id',
      ];


    public function user()
    {
    	return $this->belongsTo('App\User');
    }
   public function userByKey()
    {
      return $this->belongsTo('App\User','user_key','user_key');
    }



    public static function paymentCaping($user_key,$business_area_id, $amountCap, $newEarn)
    {
             $data = DB::select("SELECT SUM(earning) as amount FROM payouts WHERE user_key = ".$user_key." AND `updated_at` BETWEEN date_add(now(), interval -24 hour) AND now() AND business_area_id=".$business_area_id."");
        if ($data[0]->amount == null)
        {
            $amounte = 0;
        }
        else
        {
            $amounte = $data[0]->amount;
        }
        

        if (round($amounte) >= $amountCap)
        {
        
            return "no";     
        }
        else
        {
            $newTotalAmount = $amounte + $newEarn;
            if ($newTotalAmount >= $amountCap)
            {
                $amountPay = $amountCap - $amounte;
                $washed_amount = $newTotalAmount - $amountCap;
          Log::info('user caping Inner  info',['RESP'=>'PAY','user_key'=>$user_key,'amountCap'=>$amountCap,'Cureen earning'=>$amounte,'pay' =>$amountPay,'washed_amount'=>$washed_amount ]);

                return  array('pay' =>$amountPay,'washed_amount'=>$washed_amount );
            }
          Log::info('user caping Inner  info',['RESP'=>'YES','user_key'=>$user_key,'amountCap'=>$amountCap,'Cureen earning'=>$amounte]);

            return 'yes';
        }
    }





    public static function paymentCaping1($user_key,$business_area_id,$amountCap,$newEarn)
    {

      $data = DB::select("SELECT SUM(earning) as amount FROM payouts WHERE user_key = ".$user_key." AND `updated_at` BETWEEN date_add(now(), interval -24 hour) AND now()");
         if ($data[0]->amount ==null) {
               $amounte= 0;
          }else{
            $amounte = $data[0]->amount;
          }
      	    if (round($amounte) > $amountCap) {
      	    		return 'no';
      	    }else{
                $newTotalAmount = $amounte+$newEarn;

                if($newTotalAmount >$amountCap) {
                     $amountPay =  $amountCap-$amounte;
                    Log::info('NEW AMOUNT WASH',['amountPay'=>$amountPay,'user_key'=>$user_key]);
                    return $amountPay;
                }
      	    		return 'yes';
      	    }
	}

}
