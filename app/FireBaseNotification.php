<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FireBaseNotification extends Model
{




    protected $fillable =['title','message','customer_id','service_id','fcm_device_id'];

    function serviceName(){
        return $this->belongsTo('App\Service','service_id');
    }
    function username(){
        return $this->belongsTo('App\Client','client_id');
    }

public static function pushNotification($title ,$message, $push_type,$fcm_device_id,$notification_id,$customer_id)
    {

        $push =  New Push();
        $firebase =  New Firebase();
        $payload = array();
        $payload['team'] = 'India';
        $payload['score'] = '5.6';         
        $push->setTitle($title);
        $push->setMessage($message);
        $push->setClientId($customer_id);
        $push->setNotificationID($notification_id);
      
        $push->setImage('http://api.androidhive.info/images/minion.jpg');
      
        $push->setIsBackground(FALSE);
        $push->setPayload($payload);
        $json = '';
        $response = '';

        if ($push_type == 'multiple') {
            $json = $push->getPush();
            $response = $firebase->sendMultiple($fcm_device_id, $json);/*(array of ids)*/
        } else if ($push_type == 'individual') {

            $json = $push->getPush();
            $response = $firebase->send($fcm_device_id, $json);/*(single device_id)*/
        }
            return $response;
    }




}
