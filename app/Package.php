<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
		'name','business_area_id','amount','point_value','direct_income','silver','gold','diamond','classified_earning','wallet','daily_caping','direct_income','package_type_id','tenure','level_limit','cash_back_count','cost_per_lead','instant_cash_back','current_property_amount'
		
		
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

    public function levelLimit()
    {
        return $this->hasMany('App\LevelLimitPercentage');
    }


    public function Users()
    {
        return $this->belongsTo('App\User');
        # code...
    }
    
    
}
