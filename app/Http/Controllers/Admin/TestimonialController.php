<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Testimonial;
use DB;
use File;
use Auth;
use Paginate;
use Session;

class TestimonialController extends Controller
{

  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
       $Testimonials =   Testimonial::all();
        return view('admin/testimonial/list')->with('Testimonials',$Testimonials);
    }

    public function create()
       {
        return view('admin/testimonial/add');
       }

    public function store(Request $request)
    {
         Testimonial::create([
	      'name'=>$request->name,
	      'designation'=>$request->designation,
	      'message'=>$request->message,
          'placement'=>$request->placement,
	      ]);

		Session::flash('message','Testimonial added');
      	return redirect('/admin/testimonials');
     }
  
    public function edit($id)
    {
        $Testimonials = Testimonial::find($id);
        return view('admin/testimonial/edit',compact('Testimonials'));

    }
    public function changeStatus($testimonial_id,$status)
    {
        $Testimonials = Testimonial::find($testimonial_id);
        $Testimonials->status =$status;
        $Testimonials->save();
        session::flash("message","Testimonial status has been changed");
        return redirect()->back();
    }

    public function update(Request $request)
    {
	  $Testimonials = Testimonial::find($request->id);
	  $Testimonials->name = $request->name;
	  $Testimonials->designation = $request->designation;
	  $Testimonials->message = $request->message;
      $Testimonials->placement = $request->placement;
	  $Testimonials->save();

      session::flash("message","Your Testimonial has been updated");
      return redirect('/admin/testimonials');
    }

    
}
