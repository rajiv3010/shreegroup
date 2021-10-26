<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BusinessCategory;
use File;
use Storage;
use Paginate;
use DB;
use Session;

class ClassifiedCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $business_categories = BusinessCategory::orderby('id','DESC')->get();
       return view('classified.classifiedcategory')->with('business_categories',$business_categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $business_categories = BusinessCategory::orderby('id','DESC')->get();
       return view('classified.classifiedcategory')->with('business_categories',$business_categories);
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
            $file->move('images/business_category/image/', $newImageName);
        }

        BusinessCategory::create([

        'name'=>$request->name,
        'image'=> $newImageName
      ]);

Session::flash('message','classified category has been inserted');
      return redirect('/admin/category');
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
