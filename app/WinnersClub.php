<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WinnersClub extends Model
{
   public function UserWinners($date)
   {
 		return $this->hasMany('App\UserWinnersClub')->where('date',$date)->where('status',0)->orderby('created_at','DESC')->get();
   }

}
