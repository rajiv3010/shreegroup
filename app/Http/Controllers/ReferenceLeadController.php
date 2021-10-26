<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\ReferenceLead;
use App\Events\StatusLiked;
use DB;
use File;
use Auth;
use Paginate;
use Session;
use DateTime;
use \Carbon\Carbon;
class ReferenceLeadController extends Controller
{
     public function index()
    {
    	$reference_lead = ReferenceLead::where('user_key',auth::user()->user_key)->orderby('id','desc')->get();
      $count = ReferenceLead::where('user_key',auth::user()->user_key)
                                      ->whereMonth('date', Carbon::now()->month)
                                      ->wherein('status', [0,1])
                                      ->count();
        return view('users/referenceLead/list',compact('reference_lead','count'));
    }

    public function create()
    {
        $now = new DateTime();
        $begin = new DateTime('10:00');
        $end = new DateTime('24:00');
        if ($now >= $begin && $now <= $end){
        $isBetween=0;
        }else{
        $isBetween=1;
        }
        return view('users/referenceLead/add');
                        
        if(auth::user()->haveTodayRef || $isBetween){
          return redirect()->back();
        }else{

        }
    }
    public function edit($id)
    {
        $data =  ReferenceLead::where('id',$id)->where('user_key',auth::user()->user_key)->where('status',2)->first();
        if($data==null){
          dd("ASd");    
        }else{
        return view('users/referenceLead/edit',compact('data'));
        }

    }

    public function update(Request $request)
    {
         ReferenceLead::where('id',$request->id)->update([
          'user_key'=>$request->user_key,
          'name'=>$request->name,
          'email'=>$request->email,
          'phone'=>$request->phone,
          'location'=>$request->location,
          'remark'=>$request->remark,
          'status'=>$request->status,
          'occupation'=>$request->occupation,
          'phone1'=>$request->phone1,
          'gender'=>$request->gender,
          'dob'=>$request->dob,
          'status'=>0,
          'date'=>date('Y-m-d'),
      ]);
      Session::flash('message','Reference has been updated');
      $url = "<a target='_blank' href='/admin/user/reference-leads/$request->user_key'>Click here</a>" ;
//        event(new OrderShipped($order));
      event(new StatusLiked('user'.$request->user_key.'update the ref lead data please verify.'.$url));
Session::flash('message','Reference has been added');

      return redirect('/reference');
     }


    public function store(Request $request)
    {
         ReferenceLead::create([
          'user_key'=>$request->user_key,
          'name'=>$request->name,
          'email'=>$request->email,
          'phone'=>$request->phone,
          'location'=>$request->location,
          'remark'=>$request->remark,
          'status'=>$request->status,
          'occupation'=>$request->occupation,
          'phone1'=>$request->phone1,
          'gender'=>$request->gender,
          'dob'=>$request->dob,
          'date'=>date('Y-m-d'),

      ]);
      $url = "<a target='_blank' href='/admin/user/reference-leads/$request->user_key'>Click here</a>" ;

//        event(new OrderShipped($order));
      event(new StatusLiked('user '.$request->user_key.' added a new reference lead data, please verify.'.$url));
Session::flash('message','Reference has been added');
      return redirect('/reference');
     }


    


}
