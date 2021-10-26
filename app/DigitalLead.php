<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DigitalLead extends Model
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
        'leader_name',
        'place_seminar',
        'user_panel'
    ];


    public function user()
    {
      return $this->belongsTo('App\User','user_key','user_key');
    }
}
