<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB,Session;
use App\Turnover;
use App\Achievement;
use App\Order;
use App\User;
use App\Charge;
use App\Activity;
use App\UserWalletLog;
use App\Payout;
use App\UserAchievement;
class TurnoverController extends Controller
{
	public function index(Request $request)
	{
		if ($request->year==null && $request->month==null) {
			$year = date('Y');
			$month =  date('m');
		}else{
			$year = $request->year;
			$month =  $request->month;

		}
		$TurnOver = $this->getTurnOver($year,$month);
		$turnoverHistories = Turnover::orderby('month','DESC')->get();
	    return view('admin/turnover/add',compact('TurnOver','turnoverHistories'));
	}

	public function distributions()
	{
		$orders = Payout::select(DB::raw("SUM(amount) as amountTOTAL"),'activity_id')->groupby('activity_id')->paginate();
		return view('admin/turnover/distributions',compact('orders'));
	}

	public function distributionsDetails($activity_id)
	{
		$payouts = 	Payout::where('activity_id',$activity_id)->get();
		return view('admin/turnover/distributionsDetails',compact('payouts'));
	}


	public function doPayout($month,$year,$amount)
	{	

		$users = User::where('package_id',2)->get();
	           $adminCharges = ['',env('adminCharges'),env('TDSpercent')];

		$adminCharges = $adminCharges[1];
		$TDSpercent =$adminCharges[2];
		$earning = round($amount / count($users),1);
	foreach ($users as $key => $user) {
			$message = "TurnOver amount  for the  month :".$month.' and year'.$year.' Amount '.$earning;
			Payout::pay($user->user_key,$earning,$adminCharges,$TDSpercent,7,$status=0,$message,$user_type_id=1);
		}
		
		Turnover::where('month',$month)->where('year',$year)->update(['status'=>1]);
		session::flash("message","TurnOver has been added to payout");
		return redirect('/admin/turnover');
	}


	public function store(Request $request)
	{

			$isTurnOver  = Turnover::whereMonth('created_at',$request->month)->whereYear('created_at',$request->year)->where('status',1)->count();	
			if ($isTurnOver) {
				session::flash("message","Turnover already has been distributed");
				return redirect()->back();
			}
			Turnover::updateorcreate(['month'=>$request->month,'year'=>$request->year],[
				'month'=>$request->month,
				'year'=>$request->year,
				'manual_turnover'=>$request->manualTO,
				'actual_turnover'=>$request->currentTO
			]);
    	session::flash("message","TurnOver has been added");
		return redirect()->back();
	}
	public function getTurnOver($year,$month)
	{


$turnovers = DB::select("SELECT month(pins.created_at) as month,SUM(packages.amount) as total_earning,count(*) as total_sell FROM pins JOIN packages ON packages.id = pins.package_id where month(pins.created_at)=".$month." and year(pins.created_at)=".$year." group by month(created_at) ORDER BY `month` ASC");
if (isset($turnovers[0])) {
				$TurnOver = $turnovers[0]->total_earning;
				$total_sell = $turnovers[0]->total_sell;
		}else{
				$TurnOver = 0;
				$total_sell = 0;
		}
		return  array('turnovers' =>$TurnOver,'total_sell'=>$total_sell ); 
	}

	public function AchieversPayout(Request $request,$month,$year,$amount)
	{
		$achievements = Achievement::all();
		if ($request->achievement==null) {
		$achievers = UserAchievement::where('status',0)->whereMonth('achievement_date',$month)->whereYear('achievement_date',$year)
		->get();			
		}else{
		$achievers = UserAchievement::where('status',0)->whereMonth('achievement_date',$month)->whereYear('achievement_date',$year)->where('achievement_id',$request->achievement)
		->get();


		}

	    return view('admin/turnover/payouts',compact('achievers','amount','month','year','achievements'));
	}
	
}
