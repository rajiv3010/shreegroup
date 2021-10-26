<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Requests\PinAsignRequest;
use App\Pin;
use App\Banking;
use App\AssignPin;
use App\PinRequest;
use App\Package;
use App\Payout;
use App\User;
use App\Activity;
use Auth;
use Session;
use Validator;
class PinController extends Controller
{
       public function __construct()
    {   
        $this->middleware('auth');
        $this->pin  = new Pin();
        $this->assignPin  = new AssignPin();
    }


    public function assignPin()
    {
       $pins = $this->assignPin->getAssignPinByUser();
       return view('users.pin.assignPin')->with('pins',$pins);       
    }
    public function list()
    {
       $pins  = AssignPin::where('user_key',auth::user()->user_key)->get();
       return view('users.pin.list',compact('pins'));
    }
    public function RemoveAssignPin($pin_id)
    {
       $pins  = AssignPin::where('user_key',auth::user()->user_key)->where('id',$pin_id)->delete();
       session::flash("Pin has been removed from list");
       return redirect()->back();
    }
    public function asignPinSave(PinAsignRequest $PinAsignRequest)
    {

        $user = User::where('user_key',$PinAsignRequest->user_key)->count();    
      if ($user) {
       $pinResp = $this->assignPin->asignPinSave($PinAsignRequest->all(),Auth::user()->id,'user');
       Session::flash('message','Your pin asign successfully');
        
      }else{
       Session::flash('message','Invalid user id');

      }
       
       return redirect()->back(); 
     }
    public function verification()
    {
       return view('users.pin.verification');       
    }
    public function index()
    {
       return view('users.pin.dashboard');  
    }
    public function generateTraningPin()
    {
           $pins = Pin::where('user_key',Auth::user()->user_key)->where('package_id',5)->get();
          return view('users.pin.GTP')->with('pins',$pins);       
    }
    public function createTraningFreePins()
    {         
             if(Auth::user()->traning_package_create){
                session::flash('message','Aunthorized access');
             }else{
               $pins = $this->pin->createTraningPin();
              session::flash('message','You have used your '.$pins.' training package benifit');
             }
               return  redirect()->back();
              

    }
    public function pinTransfer()
    {
       $pins = $this->assignPin->getAssignPinByUser();
       return view('users.pin.pin-transfer')->with('pins',$pins);       
    }
    public function add()
    {
      
      $packages = Package::where('business_area_id',1)->where('status',1)->get();
      $Banking = Banking::get();
      return view('users/pin/add')->with('packages',$packages)->with('Banking',$Banking);
    }
    public function pinrecord()
    {
     $pin_requests=PinRequest::where('user_key',Auth::user()->user_key)->get();
      return view('users.pin.record',compact('pin_requests'));
    }
    
    public function store(Request $request)
    {

      $validator = Validator::make($request->all(), [
             'package_id' => 'required|numeric',
             'qty' => 'required|numeric',
             // 'reference_number' => 'required',
             // 'upload_receipt' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        if ($request->qty < 1) {
          session::flash('message','The qty field is required.');
          return redirect()->back();
        }

        $upload_receipt="";
        $folderPath = 'documentation/pinRequestReceipt/';
        if($request->hasFile('upload_receipt')){
        $file=$request->file('upload_receipt');
        $upload_receipt = rand().$file->getClientOriginalName();
        $file->move($folderPath, $upload_receipt);
        }


        PinRequest::create([
                            'user_key'=>Auth::user()->user_key,
                            'package_id'=>$request->package_id,
                            'qty'=>$request->qty,
                            'payment_mode'=>$request->payment_mode,
                            'bank'=>$request->bank,
                            'reference_number'=>$request->reference_number,
                            'upload_receipt'=>$upload_receipt,
                            'status'=>0,/*Initiated*/
                            'remark'=>$request->remark,
                            'provider_bank'=>$request->provider_bank,
                            'request_date'=>$request->request_date,
                            'request_time'=>$request->request_time,
                          ]);


         Session::flash('message','Your request has been submited.');
         return redirect('/pin/request/record'); 

/*

       $package=Package::where('id',$request['package_id'])->first();
       $finalAmount = $package->amount * $request->qty;
       $earning =  Auth::user()->earning;
       if ($earning >= $finalAmount) {
        $newEarning = $earning - $finalAmount;
         Payout::create([
              'user_key'=>Auth::user()->user_key,
              'amount'=>$finalAmount,
              'percentage'=>0,
              'business_area_id'=>12,
              'earning'=>0,
              'tds'=>0,
              'admin_charges'=>0,
              'txn_type'=>'d',
              'message'=>'Debit for pin purches'

              ]);
         $pinResp = $this->pin->savePin($request,Auth::user()->user_key,2);*/



     


      /* }else{
         Session::flash('message','Your Request can not be proccessed as remaing wallet amount is  '.  $earning.'');
         return redirect()->back(); 
        
       }*/
    }
}
