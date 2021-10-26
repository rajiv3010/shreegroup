<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Support;
use Auth;
use Session;
class SupportController extends Controller
{
    public function chat($user_key="")
		{	
			$users =Support::where('admin_id',Auth::guard('admin')->user()->id)
							->groupby('user_key')
							->get();
			$chats = Support::where('admin_id',Auth::guard('admin')->user()->id)
								->where('user_key',$user_key)
								->get();
			return view('admin.support.chat',compact('chats','users'));
		}

		public function chating(Request $request)
		{

				Support::create([
						'admin_id'=>Auth::guard('admin')->user()->id,
						'user_key'=>$request->user_key,
						'message'=>$request->message,
						'type'=>$request->type,
				]);
				return redirect()->back();
		}

		public function index ($status)
		{
			$user_support = Support::where('status',$status)->orderby('created_at','DESC')->get();
			return view('admin/support/list',compact('user_support','status'));
		}

		public function ChangeStatus($id,$status)
    {
        $query = Support::find($id);
        $query->status =$status;
        $query->save();
        session::flash("message","Status has been changed");
        return redirect()->back();
    }
}
