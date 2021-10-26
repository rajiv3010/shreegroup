<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FollowupLead extends Model
{
    protected $fillable = [
    	'user_key',
    	'name',
    	'email',
    	'phone',
    	'location',
    	'remark',
    	'occupation',
    	'phone1',
    	'gender',
    	'dob',
        'date',
        'user_panel'
    ];


    public function user()
    {
      return $this->belongsTo('App\User','user_key','user_key');
    }
}
