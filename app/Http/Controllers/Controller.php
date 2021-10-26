<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\State;
use App\City;
use App\Payout,DB,Log;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


  public function getCurrentFY($value='')
    {
			if (date('m') >= 4 ) {
			$year = date('Y')."-".(date('Y') +1);
			}
			else {
			$year = (date('Y')-1)."-".date('Y');
			}
			return $year;
    }

  public function getFY($value='')
    {
			if (date('m') >= 4 ) {
			$year = date('Y-04-01')."to".(date('Y-03-31',strtotime('+1 year')));
			}
			else {
			$year = (date('Y-04-01',strtotime('-1 year')))."to".date('Y-03-31');
			}
			return $year;
    }


    public function getUserFYpayment($user_key,$cearning)
    {
    	$fy = $this->getFY();
    	$dates = explode('to', $fy);
    	//dd($dates);
    	$payout = Payout::select(DB::raw('SUM(tds) as tds'), DB::raw('SUM(earning) as earning') )
                            ->whereBetween('created_at',$dates)
                            ->where('user_key',$user_key)
                            ->groupby('user_key')->first();



        Log::info("FY earing check",['step1'=>$payout]);
    	//$earning = DB::select("SELECT SUM(`earning`) FROM `payouts` WHERE `user_key` = ".$user_key." AND `created_at` BETWEEN '2020-04-01' AND '2021-03-31'");
    	if (isset($payout->earning))
        {
            $fyearning=   $payout->earning;
            $earning = $fyearning+$cearning;
            Log::info("FY earing check",['step2'=>$fyearning]);
           	if ($earning >= 15000) {
            Log::info("FY earing check",['step3'=>'TRUE']);
                    if ($payout->tds > 0) {
            Log::info("FY earing check",['step4'=>'TDS TRU','TDS'=>$payout->tds]);
            		      return 1;
                    }else{
                    Log::info("FY earing check",['step5'=>'TOTAL FY earing','TDS'=>$earning]);
                         return $earning;
                    }
           	}else{
                Log::info("FY earing check",['step6'=>'NA FY', 'earing'=>$payout->earing]);
           		return 0;
           	}
        }else{

           Log::info("FY earing check",['step7'=>'NA records']);
            return 0;
        }

    }


    public function getState(Request $request)
    {

            $cid = $request->cid;
            $state = new State();
            $states =  $state->getState($cid);
            echo json_encode($states);
    }
    public function getCities(Request $request)
    {    
           $state_id = $request->state_id;
            $city = new City();
            $cities =  $city->getCity($state_id);
            echo json_encode($cities);
    }
}