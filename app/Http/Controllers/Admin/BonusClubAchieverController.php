<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BonusClubAchiever;
use App\Http\Services\UserBonusClubService;
use App\Http\Services\UserService;
use App\Email;
use App\User;
use Auth,Session;

class BonusClubAchieverController extends Controller
{
    public function __construct(UserBonusClubService $UserBonusClubService,UserService $UserService)
    {
        $this->UserBonusClubService  = $UserBonusClubService;
        $this->UserService  = $UserService;
    }


     public function achieversList(Request $request)
    {   
        if ($request->date==null) {
            $date = date('Y-m-d');
        }else{
            $date = $request->date;
        }

         $achievers = $this->UserBonusClubService->getAchieversList();
         $sell      = $this->UserService->getDateWiseSellForBonusClubIncome($date);
         return view('admin/payout/bonusClubachievers/list',compact('achievers','sell','date'));
    }

    public function processPayment(Request $request)
    {
//        dd($request->all());
        $achievers = $this->UserBonusClubService->achieversPayment($request);
        session::flash("message","Done");
        return redirect()->back();
    }
     public function achieversListDetails($id)
    {
         $bc = $this->UserBonusClubService->getBonusClubByID($id);
         return view('admin/payout/bonusClubachievers/details',compact('bc'));
    }
     public function achieversListHistory(Request $request)
    {   
        if ($request->bonus_club_id==null) {
            $bonus_club_id =0;    
        }else{
            $bonus_club_id = $request->bonus_club_id;    
        }
         $data = $this->UserBonusClubService->getHistory($bonus_club_id);
         return view('admin/payout/bonusClubachievers/history',compact('data'));
    }
     public function achieversListHistoryDetails()
    {
         return view('admin/payout/bonusClubachievers/historyDetails');
    }
    

    


}
