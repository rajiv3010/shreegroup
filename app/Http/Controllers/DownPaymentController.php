<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Requests\PinAsignRequest;
use App\DownPayment;
use App\User;
use App\Activity;
use Auth;
use Session;
use Validator;
class DownPaymentController extends Controller
{
       public function __construct()
    {   
        $this->middleware('auth');
    }


 
 
  
    
 
    public function index()
    {
     $down_payment=DownPayment::where('user_key',Auth::user()->user_key)->orderby('created_at','DESC')->get();
      return view('users/downpayment/list',compact('down_payment'));
    }

    public function add()
    {
      return view('users/downpayment/add');
    }

    
    
    public function store(Request $request)
    {

        $upload_receipt="";
        $folderPath = 'documentation/DownPaymentReceipt/';
        if($request->hasFile('upload_receipt')){
        $file=$request->file('upload_receipt');
        $upload_receipt = rand().$file->getClientOriginalName();
        $file->move($folderPath, $upload_receipt);
        }


        DownPayment::create([
                            'user_key'=>Auth::user()->user_key,
                            'amount'=>$request->amount,
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
         return redirect('/amount/'); 
    }
}
