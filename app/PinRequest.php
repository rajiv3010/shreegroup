<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PinRequest extends Model
{
    protected $fillable = ['user_key','package_id','qty','payment_mode','bank','reference_number','upload_receipt','status','remark','provider_bank','request_date','request_time'];


    public function package()
    {
    	return $this->belongsTo('App\Package');
    }
    
    public function user()
    {
    	return $this->belongsTo('App\User','user_key','user_key');
    }
}
