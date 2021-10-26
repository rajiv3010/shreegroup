<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class City extends Model
{
    
 public function getCity($state_id='')
 {
  	return City::where('state_id',$state_id)->orderby('name','ASC')->get();
 }

   public function groupCities($state_id,$user_type_id)
 {
 		return DB::table('cities')
 				->select(DB::raw('count(users.city_id)'),'cities.id','cities.name')
 				->leftjoin('users','users.city_id','=','cities.id')
 				->where('users.user_type_id',$user_type_id)
 				->where('cities.state_id','=',$state_id)
 				->groupby('users.city_id')
 				->orderby('name','DESC')
 				->get();

 }

 public function state()
    {
        return $this->belongsTo('App\State');
    }

}
