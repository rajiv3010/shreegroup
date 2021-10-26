<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
     public function getCountry()
 {
 	return Country::orderby('name','ASC')->get();
 }

 public function users()
 {
 	return $this->hasMany('App\User');
 }

 public function groupCountries($user_type_id)
 {
 		return DB::table('countries')
 				->select(DB::raw('count(users.country_id)'),'countries.id','countries.name')
 				->rightjoin('users','users.country_id','=','countries.id')->where('users.user_type_id',$user_type_id)->groupby('users.country_id')->orderby('name','DESC')->get();

 }

}
