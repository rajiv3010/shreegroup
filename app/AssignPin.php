<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
use App\Package;
class AssignPin extends Model
{
	 protected $fillable = [
        'user_key', 'pin_id','assign_by','status','assign_by_user_key','pin_owner'
    ];
	public function asignPinSave(array $data,$assign_by_user_key,$assign_by)
	{

		foreach ($data['pin_id'] as $key => $pin_id) {
				AssignPin::where('pin_id',$pin_id)->update(['status'=>2]);
				Pin::where('id',$pin_id)->update(['pin_owner'=>$data['user_key'],'status'=>2]);
	    		AssignPin::create([
	    		'user_key'=>$data['user_key'],
	    		'pin_id'=>$pin_id,
	    		 'assign_by'=>$assign_by,
	    		 'status'=>1,
	    		 'pin_owner'=>$data['user_key'],
	    		 'assign_by_user_key'=>$assign_by_user_key,
	    	]);
		}
		return true;
	}

	public function getAssignPinByUser()
	{

		return AssignPin::where('user_key',Auth::user()->user_key)->get();
	}

	 public function pin()
    {
        return $this->belongsTo('App\Pin');
    }

	 public function package()
    {
        return $this->belongsTo('App\Package');
    }

    public function pinAssignBy()
    {
    	if ($this->assign_by=="user") {
    	return $this->belongsTo('App\User','assign_by_user_key','user_key');
    	}else{
    	return $this->belongsTo('App\Admin','assign_by_user_key','id');
    	}
    }



	 public function user()
    {
        return $this->belongsTo('App\User');
    }
  
    public function assignUser()
    {
        return $this->belongsTo('App\User','user_key','user_key');
    }
	 public function asignPinStatus()
    {
    		return AssignPin::select('user_key',DB::raw("IFNULL(count(pin_id),0) as pin_id"))->groupby('user_key')->get();
    }

}
