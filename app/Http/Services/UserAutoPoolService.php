<?php

namespace App\Http\Services;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Payout;
use App\AutoPoolClub;
use App\UserAutoPool;
use App\UserAutoPoolPayout;
use File,DB;
use Auth;
use Cart;
class UserAutoPoolService extends Model
{
   
	public function check($user_key)
	{
		$user = New User();
		$userInfo =  $user->getUserInfo($user_key);

		if ($userInfo->auto_pool_club_id==1) {
				$response =  $user->mySelfSponsor($user_key);
				if ($response ===2) {
						$myCurrentPool = 	UserAutoPool::where('user_key',$user_key)->where('auto_pool_club_id',$userInfo->auto_pool_club_id)->first();
						$myCurrentPool->status = 0 ;
						$myCurrentPool->status_change_date = now();
						$myCurrentPool->save();
						$message = "Income from Auto pool First Change Group";
						//UserAutoPoolPayout::pay($poolMember->user_key,$poolMember->id,$cPool->amount,date('Y-m-d'),$user_key);
						Payout::pay($user_key,400,env('adminCharges'),env('TDSpercent'),3,$status=0,$message,$user_type_id=1);
						$this->autoPoolProgram($user_key,$userInfo->auto_pool_club_id,2);
				}else{
					return false;
				}

		}else{

		}
	}


	public function autoPoolProgram($user_key,$current_auto_pool_club_id,$auto_pool_club_id)
	{
				
		$poolMember   =     UserAutoPool::where('auto_pool_club_id',$auto_pool_club_id)->where('status',1)->orderby('id','ASC')->first();
		$cPool 		  = 	AutoPoolClub::where('id',$auto_pool_club_id)->first();
		if(isset($cPool->id)){
			$userAutoPool = UserAutoPool::create([
			'user_key'=>$user_key,
			'auto_pool_club_id'=>$auto_pool_club_id,
			'status'=>1, //Active Member
			'count'=>0, //Active Member
			'date'=>now()
			]);
			User::where('user_key',$user_key)->update(['auto_pool_club_id'=>$auto_pool_club_id]);
			if (isset($poolMember->id)){
				$message = "Income from Auto pool for TOP ID:";
				$poolMember->count =$poolMember->count+1;
				$poolMember->save();
				UserAutoPoolPayout::pay($poolMember->user_key,$poolMember->id,$cPool->amount,date('Y-m-d'),$user_key);
				if ($poolMember->count==$cPool->limit) {
				//Get the first person on this group and sift to next group
					$userNextLevel = 	$poolMember;
					$userNextLevel->status = 0 ;
					$userNextLevel->status_change_date = now();
					$userNextLevel->save();
					$message = "Income from Auto pool Club Switch info";
					Payout::pay($userNextLevel->user_key,$cPool->profit,env('adminCharges'),env('TDSpercent'),$cPool->business_area_id,$status=0,$message,$user_type_id=1);
					$this->autoPoolProgram($userNextLevel->user_key,$userNextLevel->auto_pool_club_id,$userNextLevel->auto_pool_club_id+1);
				}else{
					return false;
				}

			}					
		}
	}
}