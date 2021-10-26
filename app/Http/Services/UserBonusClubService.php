<?php

namespace App\Http\Services;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\UserBonusClub;
use App\BonusClubHistory;
use App\BonusClub;
use App\Payout;
use File,DB;
use Auth;
use Cart;
class UserBonusClubService extends Model
{
   
   public function check($user_key)
	{
				$user = New User();
				$userInfo =  $user->getUserInfo($user_key);
				if($userInfo->bonus_club_id){
					$resp =	UserBonusClub::where('user_key',$userInfo->user_key)
										  ->where('bonus_club_id',$userInfo->bonus_club_id)
										  ->first();				
							if($resp->status){
								//Sponsor kara he achi bat he par kuch nahi milega ,because already mil raha he
								return false;
							}else{
								$resp->status=1;
								$resp->save();
							}
				}else{
				$response =  $user->mySelfSponsor($user_key);
				if ($response ===2) {
						UserBonusClub::create([
							'user_key'=>$user_key,
							'bonus_club_id'=>1,
							'status'=>1,
							'date'=>now()
						]);
				User::where('user_key',$user_key)->update(['bonus_club_id'=>1]);
				}
	
				}
	}

	public function getAchieversList()
	{
		return UserBonusClub::select(DB::raw('count(id)'),'bonus_club_id')
					->where('status',"!=",0)
					->groupby('bonus_club_id')
					->get();
		// return User::select(DB::raw('count(id)'),'bonus_club_id')
		// 			->where('bonus_club_id',"!=",0)
		// 			->groupby('bonus_club_id')
		// 			->get();
	}
	public function getBonusClubByID($id)
	{
			return BonusClub::find($id);
	}

	public function getHistory($bonus_club_id)
	{
		$instance = 	BonusClubHistory::orderby('date','DESC');		
		if ($bonus_club_id) {
			$instance->where('bonus_club_id',$bonus_club_id);
		}
		return $instance->get();
	}
	public function achieversPayment($data)
	{

		
	for ($i=0; $i<count($data->bonus_club_id); $i++) { 
		$turnOver = $data->sell[$i]*$data->perIDCost[$i];
		$perUserDistribution  = $turnOver /$data->achievers[$i];
		

		BonusClubHistory::create([
			'bonus_club_id'=>$data->bonus_club_id[$i],
			'date'=>$data->date[$i],
			'sell'=>$data->sell[$i],
			'actual_amount'=>$data->perIDAcutalCost[$i],
			'modified_amount'=>$data->perIDCost[$i],
			'achievers'=>$data->achievers[$i],
			'distributed'=>$perUserDistribution
		]);



		$CurrentBonusClub = $this->getBonusClubByID($data->bonus_club_id[$i]);

		foreach ($CurrentBonusClub->usersfromBounusClub as $key => $achiever) {

			$club_income = $achiever->user->bonusClub->total_income;
			$user = UserBonusClub::where('user_key',$achiever->user_key)->where('bonus_club_id',$data->bonus_club_id[$i])->first();
			if($user==null){

			}else{
					$itnaOrDenahe = $club_income - $user->total_income;
							 if ($itnaOrDenahe >=$perUserDistribution) {
							 		$amount =$perUserDistribution;
							 }else{
							 		$amount =$itnaOrDenahe;
							 }

					$user->total_income 	 = $user->total_income+$amount;
					$user->withdrawal_income = $user->withdrawal_income+($amount/2);
					$user->upgrade_income 	 = $user->upgrade_income+($amount/2);



					$currentIncome = $user->total_income;

					$message = "Income from Bonus Club";
					Payout::pay($achiever->user_key,$amount/2,env('adminCharges'),env('TDSpercent'),$CurrentBonusClub->business_area_id,$status=0,$message,$user_type_id=1);

					if($currentIncome==$club_income){
					// yadi club ki max income same ho gai he to 
					$user->status =0;
					// Jitna paisa dena tha utna de diya he ab next club me add kr diya he
					$userBonusClub = UserBonusClub::create([
						'user_key'=>$achiever->user_key,
						'total_income'=>0,
						'bonus_club_id'=>$user->bonus_club_id+1,
						'withdrawal_income'=>0,
						'upgrade_income'=>0,
						'status'=>0,
					]);

					// User table me bhi update karna he wo kar diya he
					$achiever->user->bonus_club_id = $user->bonus_club_id+1;
					$achiever->user->save();
					}
					$user->save();
			}
			
		}

		}//END COUNT LOOP	
		User::where('date',$data->date[0])->update(['bonus_club_income'=>1]);

	}


}