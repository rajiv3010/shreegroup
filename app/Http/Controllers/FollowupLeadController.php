<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\FollowupLead;
use DB;
use File;
use Auth;
use Paginate;
use Session;
use DateTime;
use \Carbon\Carbon;
class FollowupLeadController extends Controller
{
     public function index()
    {
      $followup_lead = FollowupLead::where('user_key',auth::user()->user_key)->orderby('id','desc')->get();
      return view('users/followupLead/list',compact('followup_lead'));
    }

    public function create()
    {
        return view('users/followupLead/add');
    }
    public function edit($id)
    {
        $data =  FollowupLead::where('id',$id)->where('user_key',auth::user()->user_key)->where('status',2)->first();
        if($data==null){
          dd("ASd");    
        }else{
        return view('users/followupLead/edit',compact('data'));
        }
    }

    public function update(Request $request)
    {
         FollowupLead::where('id',$request->id)->update([
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
          'date'=>$request->date,
      ]);
      Session::flash('message','Follow up Lead Updated has been updated');
      return redirect('/follow-up-leads');
     }


    public function store(Request $request)
    {
         FollowupLead::create([
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
          'date'=>$request->date,
          'user_panel'=>$request->user_panel,
      ]);
      Session::flash('message','Follow up Lead has been added');
      return redirect('/follow-up-leads');
     }


    


}
