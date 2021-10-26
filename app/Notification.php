<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable =['user_key','sender_user_key','type','title','message'];

     public static function  send($data)
    {
    	Notification::create([
    			'user_key'=>$data->user_key,
    			'type'=>$data->type,
    			'title'=>$data->title,
    			'message'=>$data->message
    	]);
    }

    public function user()
    {
        return $this->belongsTo('App\User','user_key','user_key');
    }

}
