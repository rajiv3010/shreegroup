<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Firebase extends Model
{
    
    // sending push message to single user by firebase reg id
    public function send($to, $message) {
        $fields = array(
            'to' => $to,
        );
        return $this->sendPushNotification(array_merge($message,$fields));
    }
 
    // sending push message to multiple users by firebase registration ids
    public function sendMultiple($registration_ids, $message) {
        $customers =  Customer::all();
        $fields = array(
            'registration_ids' => $registration_ids,
           
             );
        return $this->sendPushNotification(array_merge($message,$fields));
    }
 
    // function makes curl request to firebase servers
    private function sendPushNotification($fields) {
        define('FIREBASE_API_KEY', 'AIzaSyDm16va65pmOB9NXFG14Eicp9Q2Zjoot9M ');

        // Set POST variables
        $url = 'https://fcm.googleapis.com/fcm/send';
 
        $headers = array(
            'Authorization: key=' . FIREBASE_API_KEY,
            'Content-Type: application/json',
            'Accept:application/json'
        );
        // Open connection
        $ch = curl_init();
 
        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
 
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
 
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
 
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
 
        // Close connection
        curl_close($ch); 
        return $result;
    }
}
