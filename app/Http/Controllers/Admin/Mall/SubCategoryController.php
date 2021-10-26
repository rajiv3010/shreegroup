<?php

namespace App\Http\Controllers\Admin\Mall;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mall\Product;
use App\Mall\Category;
use App\Mall\Color;
use App\Mall\Size;
use App\Mall\SubCategory;
use App\Mall\Brand;
use File;
use Storage;
use Paginate;
use DB;
use Session;
use Validator;

class SubCategoryController extends Controller
{
    
      public function __construct()
    {
      $this->middleware('auth:admin');   
     }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subcategories = SubCategory::orderby('id','DESC')->get();
        $cats = Category::all();
       return view('admin.mall.product.subcategory.add')->with('subcategories',$subcategories)->with('cats',$cats);   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         SubCategory::create([
            'name'=>$request->name,
            'category_id'=>$request->category
             
    ]);
         Session::flash('message','Category has been inserted');
        return redirect()->back();
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

        $subCategoryEdit = SubCategory::where('id', $id)->first();
        $subcategories = SubCategory::orderby('id','DESC')->get();
        $cats = Category::all();
         return view('admin.mall.product.subcategory.edit', compact('subCategoryEdit', 'id'))
       ->with('subcategories',$subcategories)
       ->with('cats',$cats); 


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
          $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
            if($validator->fails())
          {
            return Redirect('/admin/mall/products/subcategory/create')
             ->withErrors($validator)
             ->withInput();
          }
          else
          {
             $category = SubCategory::find($id);
            $category->name = $request->name;
            $category->save();
             Session::flash('message', 'Successfully updated color!');
            return Redirect('/admin/mall/products/subcategory/create'); 
          }
         
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          $subcategory = SubCategory::find($id);
        $subcategory->delete();

        return redirect('/admin/mall/products/subcategory/create');
    }
}
