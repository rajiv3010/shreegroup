<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LevelLimitPercentage extends Model
{
    protected $fillable = [
		'package_id','level','direct','percentage'
    ];
    public function business_area($value='')
    {
    	return $this->belongsTo('App\BusinessArea');
    }

    public function package_type($value='')
    {
    	return $this->belongsTo('App\PackageType');
    }
    public function genUsers()
    {

        // $startDate = date("Y-m-d 00:00", strtotime("-7 day"));
        // $endDate = date("Y-m-d 23:59", strtotime("-7 day"));

        //return $this->hasMany('App\UpgradeHistory')->whereBetween('created_at',[$startDate,$endDate]);
        return $this->hasMany('App\UpgradeHistory');
        # code...
    }

    public function Users()
    {
        return $this->belongsTo('App\User');
        # code...
    }
    
    
}
