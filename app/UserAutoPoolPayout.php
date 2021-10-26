<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;
class UserAutoPoolPayout extends Model
{
 protected $fillable = ['user_key', 'user_auto_pool_id', 'amount', 'date','user_by'];
   public static function pay($user_key,$user_auto_pool_id,$amount,$date,$user_by){
          $activity =  UserAutoPoolPayout::create(['user_key'=>$user_key,
          											'user_auto_pool_id'=>$user_auto_pool_id,
          											'date'=>$date,
          											'amount'=>$amount,
          											'user_by'=>$user_by]);	 
    }

    public function users()
    {
      return $this->belongsTo('App\User','user_key','user_key');
    }

        public function RefUser()
    {
      return $this->belongsTo('App\User','user_by','user_key');
    }


    
}
