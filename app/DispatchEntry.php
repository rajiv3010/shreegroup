<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DispatchEntry extends Model
{
      protected $fillable = ['user_key','admin_id','title',
			'courier_company',
			'url',
			'tracking_id',
			'dispatch_date',
    ];

    public function user()
    {
    	return $this->belongsTo('App\User','user_key','user_key');
    } 
    public function admin()
    {
    	return $this->belongsTo('App\Admin');
    }

}
