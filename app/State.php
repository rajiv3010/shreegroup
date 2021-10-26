<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class State extends Model
{
     public function getState($country_id='1')
 {
 	return State::where('country_id',$country_id)->orderby('name','ASC')->get();
 }

  public function groupStates($country_id,$user_type_id)
 {
 		return DB::table('states')
 				->select(DB::raw('count(users.state_id)'),'states.id','states.name')
 				->rightjoin('users','users.state_id','=','states.id')
 				->where('users.user_type_id',$user_type_id)
 				->where('states.country_id','=',$country_id)
 				->groupby('users.state_id')
 				->orderby('name','DESC')->get();

 }
 public function country()
    {
        return $this->belongsTo('App\Country');
    }

}
