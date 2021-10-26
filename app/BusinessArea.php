<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessArea extends Model
{
	public function takepayouts($user_key = 7431985)
	{		
		return  $this->hasMany('App\Payout')->where('user_key',$user_key)->first();
	}
   
}
