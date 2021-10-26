<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAutoPool extends Model
{
   
	protected $fillable  = ['user_key','auto_pool_club_id','count','status','date'];


	public function AutoPoolClub()
    {
      return $this->belongsTo('App\AutoPoolClub');
    }

    public function users()
    {
      return $this->belongsTo('App\User','user_key','user_key');
    }
  
    

    public function UserAutoPoolPayout()
    {
      return $this->belongsTo('App\UserAutoPoolPayout','id');
    }
    


    
}
