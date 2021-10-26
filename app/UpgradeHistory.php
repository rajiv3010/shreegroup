<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UpgradeHistory extends Model
{
    protected $fillable = [
	'user_id','user_key','package_id','package_type_id','status'
	];


	public function package()
    {
        return $this->belongsTo('App\Package');
    }

    public function user()
    {
      return $this->belongsTo('App\User','user_key','user_key');
    }

    public function propertyAllotment()
    {
        return $this->belongsTo('App\PropertyAllotment');
    }

    public function haveProperty()
    {
        return $this->belongsTo('App\PropertyAllotment','id','upgrade_history_id');
    }
}
