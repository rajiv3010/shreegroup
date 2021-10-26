<?php

namespace App\Http\Controllers\Admin\Testimonial;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Testimonial\Testimonial;
use File;
use Storage;
use Paginate;
use DB;
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
   
         $testimonials = Testimonial::orderby('id','DESC')->get();
       return view('comman.testimonial.add')->with('testimonials',$testimonials);
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
   
         $testimonials = Testimonial::orderby('id','DESC')->get();
       return view('comman.testimonial.add')->with('testimonials',$testimonials);
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newImageName = '';
        if($request->hasFile('image')){
            $file=$request->file('image');
            $newImageName = rand().time('i').$file->getClientOriginalName();
            $file->move('images/testimonials/', $newImageName);
        }

        Testimonial::create([

        'name'=>$request->name,
        'member_id'=>$request->member_id,
        'message'=>$request->message,
        'image'=> $newImageName
      ]);

Session::flash('message','Testimonial has been inserted');
      return redirect('/admin/content-manager/testimonial');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
