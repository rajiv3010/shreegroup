<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Admin;
use App\APC;
use App\Admanagement;
use Auth;
use Session;
use Illuminate\Support\Facades\Redirect;
use DB;
use File;
use App\Home;
use App\Email;
use App\Payout;
use App\Package;
use App\DPC;
class DpcController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->email = new Email;
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('admin.dashboard');
    }
    public function create()
    {
      $packages = Package::where('business_area_id',10)->get();
       return view('admin.dpc.create',compact('packages'));
    }
    public function pin()
    {
       return view('admin.dpc.pin');
    }
    public function generatePIN()
    {
        session::flash('message','DPC pin has been created');
        return redirect('/admin/dpc/pin');
    }
    public function store(Request $request)
    {
      $dpc_key = rand(100000,999999);
      do
      {
              $check = DPC::where('dpc_key',$dpc_key)->count();
              $flag = 1;
      if($check == 1)
          {
              $dpc_key = rand(100000,999999);
              $flag = 0;
          }
      }
      while($flag==0);
      $package = Package::where('id',$request->package_id)->first();
      $password = $request->password;
      $dpc =   DPC::create([
      'dpc_key' => 'DPC'.$dpc_key,
      'package_id' => $request->package_id,
      'name' =>    $request->name,
      'email' =>   $request->email,
      'password' => bcrypt($password),
      'phone' =>   $request->phone,
      'address' => $request->address,
      'wallet' => $package->wallet,
      ]);

      $pathP = public_path() . 'assets/dpc/' . $dpc->id;
      if (!file_exists($pathP)) {
      File::makeDirectory($pathP, $mode = 0777, true, true);
      }
      $this->email->sendWelcomeEmailDPC($dpc,$password);
       session::flash('message','DPC has been created');
      return redirect('/admin/dpc/list');
      }

    public function list()
    {
       $dpc=DPC::all();
       return view('admin.dpc.list')->with("dpcs",$dpc);

    }
    public function dpcListOfAPC($dpc_id)
    {
       $apc=APC::where('dpc_id',$dpc_id)->get();
       return view('admin.dpc.apclist')->with("apc",$apc);

    }

    public function payoutReportDPC()
    {
      $payouts = Payout::where('user_type_id',3)->get();
      $datewise =array();
      foreach ($payouts as $key => $date) {
      if(!array_key_exists($date->created_at, $datewise) ){
      $datewise[$date->created_at]=[];
      }
      $datewise[$date->created_at][]= $date;
      }

       return view('admin.dpc.payment.list',compact('payouts'));
    }

      public function payoutReportAPC()
    {
       $payouts = Payout::where('user_key',Auth::guard('apc')->user()->apc_key)->where('user_type_id',2)->get();
       return view('apc.payment.list',compact('payouts'));
    }
}
