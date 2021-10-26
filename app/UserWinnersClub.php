<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserWinnersClub extends Model
{
   protected $fillable = ['user_key','winners_club_id','date','status','amount'];

   public function winnersClub()
   {
   		return $this->belongsTo('App\WinnersClub');
   }
	public function user()
   {
   		return $this->belongsTo('App\User','user_key','user_key');
   }

}
