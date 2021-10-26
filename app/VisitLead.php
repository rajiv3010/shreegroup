<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VisitLead extends Model
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
        'visit_leader',
        'user_panel'
    ];

    public function user()
    {
      return $this->belongsTo('App\User','user_key','user_key');
    }
}
