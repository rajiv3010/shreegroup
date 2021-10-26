<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BusinessCategory;
use App\BusinessSubCategory;
use File;
use Storage;
use Paginate;
use DB;
use Session;

class ClassifiedSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $business_categories = BusinessCategory::orderby('id','DESC')->get();
        $business_sub_categories = BusinessSubCategory::orderby('id','DESC')->get();
       return view('classified.classified_sub_category')->with('business_categories',$business_categories)->with('business_sub_categories',$business_sub_categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $business_categories = BusinessCategory::orderby('id','DESC')->get();
        $business_sub_categories = BusinessSubCategory::orderby('id','DESC')->get();
       return view('classified.classifiedcategory')->with('business_categories',$business_categories)->with('business_sub_categories',$business_sub_categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        BusinessSubCategory::create([

        'category_id'=>$request->category,
        'name'=>$request->subcategory,
      ]);

Session::flash('message','sub category has been inserted');
      return redirect('/admin/subcategory');
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
