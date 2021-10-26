<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\UserWinnersClubService;
use App\Http\Services\UserService;
use App\WinnersClubAchiever;
use App\WinnersClub;
use App\WinnersClubHistory;
use App\Email;
use App\User;
use Auth;

class WinnersClubAchieverController extends Controller
{
    
        protected $WinnersClub;
        public function __construct(UserWinnersClubService $UserWinnersClubService,UserService $UserService,WinnersClub $WinnersClub)
    {
               $this->UserWinnersClubService  = $UserWinnersClubService;
               $this->UserService  = $UserService;
    }

     public function achieversList(Request $request)
    {

            if ($request->date==null) {
            $date = date('Y-m-d');
            }else{
            $date = $request->date;
            }

            $sell =  $this->UserService->getDateWiseSellForWinnersClub($date);
            $clubs= $this->UserWinnersClubService->getCLubsList();
        return view('admin/payout/winnersClubachievers/list',compact('sell','clubs','date'));
    }

     public function achieversListDetails($club_id,$date)
    {

         $club= $this->UserWinnersClubService->getCLubById($club_id);
         return view('admin/payout/winnersClubachievers/details',compact('club','date'));
    }
     public function processPayment(Request $request)
    {

         $this->UserWinnersClubService->processPayment($request);
         return redirect()->back();
    }


     public function achieversListHistory()
    {
        $data = WinnersClubHistory::get();
         return view('admin/payout/winnersClubachievers/history',compact('data'));
    }
     public function achieversListHistoryDetails()
    {
         return view('admin/payout/winnersClubachievers/historyDetails');
    }
    

    


}
