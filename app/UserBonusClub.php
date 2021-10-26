<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserBonusClub extends Model
{
   protected $fillable = ['user_key','bonus_club_id','status','date'];

   public function BonusClub()
    {
      return $this->belongsTo('App\BonusClub');
    }
    public function user()
    {
      return $this->belongsTo('App\User','user_key','user_key');
    }
}

