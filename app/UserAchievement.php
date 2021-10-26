<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
class UserAchievement extends Model
{
protected $fillable = ['user_key','achievement_id','achievement_date'];

     public function user()
   {
     return $this->belongsTo('App\User','user_key','user_key');
   }

   public function achievement()
   {
    return $this->belongsTo('App\Achievement');
   }


   public function payoutsTotal()
   {
     return  $this->haMany('App\Payout');
   }
}