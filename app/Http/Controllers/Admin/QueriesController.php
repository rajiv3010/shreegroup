<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\WebMessage;
use Validator;
use Redirect;
use Session;
class QueriesController extends Controller
{
  
    public function index($status=1)
    {   $WebMessage = WebMessage::where('status',$status)->orderby('created_at','DESC')->get();
        return view('admin/queries/list',compact('WebMessage'));
    }



    public function changeStatus($query_id,$status)
    {
        $query = WebMessage::find($query_id);
        $query->status =$status;
        $query->save();
        session::flash("message","Query status has been changed");
        return redirect()->back();
    }


    public function destroy($id)
    {
         // delete
        $query = WebMessage::find($id);
        $query->delete();

        // redirect
        Session::flash('message', 'Query Deleted!');
        return redirect()->back();
    }
}
