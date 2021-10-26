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
class BrandController extends Controller
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
        return view('admin.mall.product.brand.add');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subcategories = SubCategory::all();
        $categories = Category::all();
         $brands = Brand::orderby('id','DESC')->get();
        return view('admin.mall.product.brand.add')->with('brands',$brands)->with('categories',$categories)->with('subcategories',$subcategories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         Brand::create([
            'category_id'=>$request->category,
            'sub_category_id'=>$request->subcategory,
            'name'=>$request->name
    ]);
         Session::flash('message','brand has been inserted');
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
         return view('admin.mall.product.brand.list');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $brnadEdit = Brand::where('id', $id)->first();
        $subcategories = SubCategory::all();
        $categories = Category::all();
         $brands = Brand::orderby('id','DESC')->get();
       
         return view('admin.mall.product.brand.edit', compact('brnadEdit', 'id'))
        ->with('brands',$brands)
        ->with('categories',$categories)
        ->with('subcategories',$subcategories);



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
            return Redirect('/admin/mall/products/brand/create')
             ->withErrors($validator)
             ->withInput();
          }
          else
          {
             $category = Brand::find($id);
            $category->name = $request->name;
            $category->save();
             Session::flash('message', 'Successfully updated brand!');
            return Redirect('/admin/mall/products/brand/create');
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
          $brand = Brand::find($id);
        $brand->delete();

        return redirect('/admin/mall/products/brand/create');
    }
}
