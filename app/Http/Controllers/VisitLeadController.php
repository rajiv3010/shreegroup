<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\VisitLead;
use DB;
use File;
use Auth;
use Paginate;
use Session;
use DateTime;
use \Carbon\Carbon;
class VisitLeadController extends Controller
{
     public function index()
    {
    	$visit_lead = VisitLead::where('user_key',auth::user()->user_key)->orderby('id','desc')->get();
      return view('users/visitLead/list',compact('visit_lead'));
    }

    public function create()
    {
        return view('users/visitLead/add');
    }
    public function edit($id)
    {
        $data =  VisitLead::where('id',$id)->where('user_key',auth::user()->user_key)->where('status',2)->first();
        if($data==null){
          dd("ASd");    
        }else{
        return view('users/visitLead/edit',compact('data'));
        }
    }

    public function update(Request $request)
    {
         VisitLead::where('id',$request->id)->update([
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
          'visit_leader'=>$request->visit_leader,
      ]);
      Session::flash('message','Visit Lead Updated has been updated');
      return redirect('/visit-leads');
     }


    public function store(Request $request)
    {
         VisitLead::create([
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
          'visit_leader'=>$request->visit_leader,
          'user_panel'=>$request->user_panel,
      ]);
      Session::flash('message','Visit Lead has been added');
      return redirect('/visit-leads');
     }


    


}
