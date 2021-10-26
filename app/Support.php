<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
   protected $fillable = [
        'ticket_id','user_key', 'message','document','support_type_id'
    ];

    public function SupportType()
    {
    	return $this->belongsTo('App\SupportType');
    }

    public function users()
    {
    	return $this->belongsTo('App\User');
    }

    
    
}
