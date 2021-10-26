<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;
class Activity extends Model
{
 protected $fillable = ['description', 'user_by_key', 'business_area_id', 'amount'];
   public static function lock($description,$user_key,$business_area_id,$amount){
          $activity =  Activity::create(['description'=>$description,'amount'=>$amount,'user_by_key'=>$user_key,'business_area_id'=> $business_area_id]);
	  		session(['activity_id'=>$activity->id]);
        ;
    }


    public function user()
    {
    	return $this->belongsTo('App\User','user_by_key','user_key');
    }
}
