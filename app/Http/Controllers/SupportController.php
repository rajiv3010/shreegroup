<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Support;
use App\SupportType;
use App\Admin;
use App\User;
use Auth;
use Session;
class SupportController extends Controller
{
		public function chat()
		{	
			$isActiveChat = Support::where('user_key', Auth::user()->user_key)->first();
			if (count($isActiveChat)) {
			$chats = Support::where('user_key',Auth::user()->user_key)->where('admin_id',$isActiveChat->admin_id)->orderby('created_at','DESC')->get();						
			}else{
			$admin = Admin::inRandomOrder()->first();
			Support::create([
					'admin_id'=>$admin->id,
					'user_key'=>Auth::user()->user_key,
					'message'=>'Hello  ' .Auth::user()->name. '  how can i help you.',
					'type'=>'admin',
				]);
			$chats = Support::where('user_key',Auth::user()->user_key)->where('admin_id',$admin->id)->orderby('created_at','DESC')->get();
			}
			return view('users.support.chat',compact('chats'));
		}


		public function index()
		{
			$support_type = SupportType::orderby('name','ASC')->get();

			
			return view('users/support/add',compact('support_type'));
		}

		public function store(Request $request)
		{

			$ticket_id = 'WL'.rand(111111111,999999999).'EPL';
        //if generated key is already exist in the DB then again re-generate key
        do
        {
          $check = Support::where('ticket_id',$ticket_id)->count();
          $flag = 1;
          if($check == 1)
          {
            $ticket_id = 'WL'.rand(111111111,999999999).'EPL';
            $flag = 0;
          }
        }
        while($flag==0);


        $document="";
        $folderPath = 'documentation/support/';
        if($request->hasFile('document')){
        
        $file=$request->file('document');
        $document = rand().$file->getClientOriginalName();
        $file->move($folderPath, $document);
        }
				Support::create([
						'user_key'=>Auth::user()->user_key,
						'ticket_id'=>$ticket_id,
						'message'=>$request->message,
						'document'=>$document,
						'support_type_id'=>$request->support_type_id,
				]);
				Session::flash("message","Query Submitted");
				return redirect('/support/history');
		}

		public function history()
		{
			$support_history = Support::orderby('created_at','DESC')->get();
			return view('users/support/list',compact('support_history'));
		}
}
