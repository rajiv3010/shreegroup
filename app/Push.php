<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Push extends Model
{
      // push message title
    private $title;
    private $message;
    private $image;
    // push message payload
    private $data;
    private $client_id;
    private $notification_id;

    // flag indicating whether to show the push
    // notification or not
    // this flag will be useful when perform some opertation
    // in background when push is recevied
    private $is_background;
 
    function __construct() {
         
    }
 
    public function setTitle($title) {
        $this->title = $title;
    }
 
    public function setMessage($message) {
        $this->message = $message;
    }
 
    public function setImage($imageUrl) {
        $this->image = $imageUrl;
    }
 
    public function setPayload($data) {
        $this->data = $data;
    }
 
    public function setIsBackground($is_background) {
        $this->is_background = $is_background;
    }
    public function setClientId($client_id) {
        $this->client_id = $client_id;
    }
    public function setNotificationID($notification_id) {
        $this->notification_id = $notification_id;
    }
 
    public function getPush() {
        $res = array();
        $res['data']['title'] = $this->title;
        $res['data']['message'] = $this->message;
        $res['data']['client_id'] = $this->client_id;
        $res['data']['notification_id'] = $this->notification_id;
        $res['notification']['title'] = $this->title;
        $res['notification']['body'] = $this->message;
        $res['notification']['content_available'] = "true";

        return $res;
    }

}
