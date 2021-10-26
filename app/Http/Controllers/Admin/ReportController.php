<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Payout;
use App\Payment;
use App\Pin;
use App\AssignPin;
use App\Package;
use DB;
class ReportController extends Controller
{
	  public function __construct()
    {
         $this->middleware('auth:admin');
    }
    public function tds(Request $request)
    {
       // $startDate = date("Y-m-d 00:00:00");
       // $endDate   = date("Y-m-d 23:59:59");
      //$payouts = Payout::select(DB::raw("IFNULL(sum(tds),0) as tds"),DB::raw("DATE_FORMAT(created_at,'%M %Y') as months"))->groupby('months')->where('status','1')->get();
        if ($request->year==null) {
        $year =date('Y');
      }else{
        $year  = $request->year;
      }



        $payouts= DB::select("SELECT year(payouts.created_at) as year, month(payouts.created_at) as month, sum(tds) as tds FROM payouts
            LEFT JOIN users ON users.user_key = payouts.user_key
            WHERE users.is_pan_verified =2 AND
            payouts.status = 1 group by year(payouts.created_at) ORDER BY `year` DESC");

      $payoutsMonth = Payout::select(DB::raw("SUM(tds) as tds"),DB::raw("month(payouts.created_at) as month"),DB::raw("year(payouts.created_at) as year"),DB::raw("payouts.user_key"))->WHERE('status','1')
      ->groupby('month')
      ->join('users','users.user_key','=','payouts.user_key')
      ->where('is_pan_verified', 2)
      ->whereYear('payouts.created_at', $year)
      ->orderby('payouts.created_at','desc')
      ->get();
      
      if ($request->month==null) {
        $month =date('m');
      }else{
        $month  = $request->month;
      }

      $tdsUsers = Payout::select(DB::raw("SUM(tds) as tds"),DB::raw("month(payouts.created_at) as month"),DB::raw("payouts.created_at"),DB::raw("payouts.user_key"))
      ->join('users','users.user_key','=','payouts.user_key')
      ->WHERE('status','1')
      ->whereMonth('payouts.created_at',$month)
      ->where('is_pan_verified', 2)
      ->groupby('payouts.user_key')
      ->orderby('payouts.created_at','desc')
      ->get();



       return view('admin/report/tds_list',compact('payouts','payoutsMonth','tdsUsers','year','month'));
    }
    public function tds_year($year)
    {
       
      $payouts = Payout::select(DB::raw("SUM(tds) as tds"),DB::raw("month(created_at) as month"),DB::raw("year(created_at) as year"),DB::raw("user_key"))->WHERE('status','1')->whereYear('created_at', $year)->groupby('month')->get();

       
       return view('admin/report/tds_list_year',compact('payouts'));
    }
    public function tds_month($year,$month)
    {
       
      $payouts = Payout::select(DB::raw("SUM(tds) as tds"),DB::raw("month(created_at) as month"),DB::raw("created_at"),DB::raw("user_key"))->WHERE('status','1')->whereMonth('created_at', $month)->groupby('user_key')->orderby('created_at','desc')->get();

       
       return view('admin.report.tds_list_month',compact('payouts'));
    }

    public function payouts()
    {
       $payouts = Payout::orderby('created_at','DESC')->get();
       return view('admin.report.payouts',compact('payouts'));
    }
    public function payments()
    {
       $payments = Payment::get();
       return view('admin.report.payments',compact('payments'));
    }

    public function sale()	
    {
	   $pins = Pin::select(DB::raw("IFNULL(count(package_id),0) as package_count"),'package_id','id')
	   				->wherein('created_by',[0,2])
	   				->groupby('package_id')
	   				->get();
	   	$assignpins = 		DB::select('SELECT packages.name as pname ,COUNT("package_id") as count, amount FROM `assign_pins` JOIN pins ON pins.id = assign_pins.pin_id JOIN packages ON packages.id = pins.package_id GROUP by packages.id');

 	   return view('admin.report.sale',compact('pins','assignpins'));
    	
    }
}

?>
