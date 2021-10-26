<?php

namespace App\Http\Services;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\UserBonusClub;
use File,DB;
use Auth;
use Cart;
class UserService extends Model
{
  
	public function getDateWiseSellForBonusClubIncome($date)
	{
		return User::where('date',$date)->where('bonus_club_income',0)->count();
	}

	public function getDateWiseSellForWinnersClub($date)
	{
		return User::where('date',$date)->where('winners_club_income',0)->count();
	}
}