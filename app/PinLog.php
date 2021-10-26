<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PinLog extends Model
{
	protected $fillable = ['pin_id','user_id','message','action_by','action_by_key'];
    public  static function saveLog($pin_id,$user_id,$message,$action_by,$action_by_key)
    {
        PinLog::create([
            'pin_id'=>$pin_id,
            'user_id'=>$user_id,
            'action_by'=>$action_by,
            'action_by_key'=>$action_by_key,
            'message'=>$message
        ]);
    }
}
