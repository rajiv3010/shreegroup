<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AutoPoolClub extends Model
{
   		public function BA()
	{
		return $this->belongsTo('App\BusinessArea');
	}

	    public function activeMember()
    {
      return $this->hasMany('App\UserAutoPool')->where('status',1);
    }
    public function achievedMember()
    {
      return $this->hasMany('App\UserAutoPool')->where('status',0);
    }

}
