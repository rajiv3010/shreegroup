<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Payout;
use App\Payment;
use App\UserPointValue;
use App\Email;
use App\DispatchEntry;
use Auth;
use DB;
class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

       public function __construct()
      {
          $this->middleware('auth');
          $this->email  = new Email();
      }
      public function tds()
      {
        $tdsreport =  Payout::where('user_key',Auth::user()->user_key)->get();
        return view('users.reports.tds',compact('tdsreport'));
      }

      public function dispatchreport()
      {
        $dispatchreport =  DispatchEntry::where('user_key',Auth::user()->user_key)->get();
        return view('users/reports/dispatch',compact('dispatchreport'));
      }
      
      public function propertySavings()
      {
        return view('users/reports/propertySavings');
      }



}