<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DownPayment extends Model
{
    protected $fillable = ['user_key','amount','payment_mode','bank','reference_number','upload_receipt','status','remark','provider_bank','request_date','request_time'];  
    public function user()
    {
    	return $this->belongsTo('App\User','user_key','user_key');
    }
}
