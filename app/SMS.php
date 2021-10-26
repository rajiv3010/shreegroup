<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SMS extends Model
{
    
public static function send($mobile, $msg, $body = true, $header = false)
    {
 		$msg =urlencode($msg);
        $url = "http://trans.kapsystem.com/api/web2sms.php?workingkey=Af79e7ffc494663320f642804c3838351&to=$mobile&sender=ADARSH&message=$msg";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, $header);
        curl_setopt($curl, CURLOPT_NOBODY, !$body);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        $data = curl_exec($curl);
        curl_close($curl);
        $findme =  "Message GID";
           $find = strpos($data, $findme);
            if ($find === false) { 
              return false;
            }else{
          return true;
 
            }
    }
}
