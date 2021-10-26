<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BonusClub extends Model
{
   
	public function users($value='')
	{
		return $this->hasMany('App\User');
	}


	public function usersfromBounusClub($value='')
	{
		return $this->hasMany('App\UserBonusClub')->where('status',1);
	}

	public function BA()
	{
		return $this->belongsTo('App\BusinessArea');
	}
}
