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

class CategoryController extends Controller
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
     
         return view('admin.mall.product.category.list');
        

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
       $categories = Category::orderby('id','DESC')->get();
        return view('admin.mall.product.category.add')->with('categories',$categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Category::create([
            'name'=>$request->name,
           
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
         $subcategories=SubCategory::where('category_id',$id)->get();
         return view('admin.mall.product.category.show',compact('subcategories','id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          $categoryEdit = Category::where('id', $id)->first();
        $categories = Category::orderby('id','DESC')->get();
           return view('admin.mall.product.category.edit', compact('categoryEdit', 'id'))
                   ->with('categories',$categories);
        

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
            return Redirect('/admin/mall/products/category/create')
             ->withErrors($validator)
             ->withInput();
          }
          else
          {
            $category = Category::find($id);
            $category->name = $request->name;
            $category->save();
             Session::flash('message', 'Successfully updated category!');
            return Redirect('/admin/mall/products/category/create');
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
         $category = Category::find($id);
        $category->delete();

        return redirect('/admin/mall/products/category/create');
    }
}
