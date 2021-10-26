<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDocuments extends Model
{


    protected $fillable = ['user_id','document_id','document_name','attachment_name','attachment_temp','attachment_type'];
    public function UserDocuments()
    {
    	return $this->hasOne('App\Documents');
    } 
     public function User()
    {
    	return $this->belongsTo('App\User');
    }
}
