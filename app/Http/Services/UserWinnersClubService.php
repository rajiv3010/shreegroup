<?php

namespace App\Http\Services;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Payout;
use App\AutoPoolClub;
use App\UserAutoPool;
use App\UserWinnersClub;
use App\WinnersClubHistory;
use App\WinnersClub;
use File,DB;
use Auth;
use Cart;
class UserWinnersClubService extends Model
{
   
	public function getAchieversList($date)
	{
			return UserWinnersClub::where('date',$date)->where('status',0)->orderby('created_at','DESC')->get();
	}

	public function getCLubsList($value='')
	{
		return WinnersClub::all();
	}

	public function getCLubById($getCLubById='')
	{
		return WinnersClub::find($getCLubById);
	}

	public function processPayment($data)
	{
		

	for ($i=0; $i<count($data->winners_club_id); $i++) { 
		$turnOver = $data->sell[$i]*$data->perIDCost[$i];
		$perUserDistribution  = $turnOver /$data->achievers[$i];
		

		WinnersClubHistory::create([
			'winners_club_id'=>$data->winners_club_id[$i],
			'date'=>$data->date[$i],
			'sell'=>$data->sell[$i],
			'actual_amount'=>$data->perIDAcutalCost[$i],
			'modified_amount'=>$data->perIDCost[$i],
			'achievers'=>$data->achievers[$i],
			'distributed'=>$perUserDistribution
		]);



		$club = $this->getCLubById($data->winners_club_id[$i]);

		foreach ($club->UserWinners($data->date[$i]) as $key => $achiever) {

			$user = UserWinnersClub::where('user_key',$achiever->user_key)->where('winners_club_id',$data->winners_club_id[$i])->first();
			if($user==null){

			}else{
				    $amount =$perUserDistribution;
					$user->amount= $user->amount+$amount;
					$user->status =1;
					$user->save();
					$message = "Income from Winner Club";
					Payout::pay($achiever->user_key,$amount,env('adminCharges'),env('TDSpercent'),$club->business_area_id,$status=0,$message,$user_type_id=1);
				}
			}
			
		}
				User::where('date',$data->date[0])->update(['winners_club_income'=>1]);
		}//END COUNT LOOP	
	



}