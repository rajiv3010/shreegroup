<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\SeminarLead;
use DB;
use File;
use Auth;
use Paginate;
use Session;
use DateTime;
use \Carbon\Carbon;
class SeminarLeadController extends Controller
{
     public function index()
    {
      $seminar_lead = SeminarLead::where('user_key',auth::user()->user_key)->orderby('id','desc')->get();
      return view('users/seminarLead/list',compact('seminar_lead'));
    }

    public function create()
    {
        return view('users/seminarLead/add');
    }
    public function edit($id)
    {
        $data =  SeminarLead::where('id',$id)->where('user_key',auth::user()->user_key)->where('status',2)->first();
        if($data==null){
          dd("ASd");    
        }else{
        return view('users/seminarLead/edit',compact('data'));
        }
    }

    public function update(Request $request)
    {
         SeminarLead::where('id',$request->id)->update([
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
          'leader_name'=>$request->leader_name,
          'place_seminar'=>$request->place_seminar,
      ]);
      Session::flash('message','Seminar up Lead Updated has been updated');
      return redirect('/seminar-leads');
     }


    public function store(Request $request)
    {
         SeminarLead::create([
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
          'leader_name'=>$request->leader_name,
          'place_seminar'=>$request->place_seminar,
          'user_panel'=>$request->user_panel,
      ]);
      Session::flash('message','Seminar up Lead has been added');
      return redirect('/seminar-leads');
     }


    


}
