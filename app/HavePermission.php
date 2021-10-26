<?php

namespace App;
use DB;
class HavePermission 
{
	

 public static function check($userid,$permission_for){


		$role = DB::table('roles')->select('id')->where('code',$permission_for)->first(); 			
		if (isset($role->id)){
			$roleID = $role->id;
		}else{
			return false;
		}
	$check = 	DB::table('user_roles')->where('user_id',$userid)->where('role_id',$roleID)->get();

	if ($check->count()) {
		return true;
	}else{
		return false;
	}

    }

}
?>