<?php

namespace App\Http\Controllers\Admin\Mall;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mall\Product;
use App\Mall\Category;
use App\Mall\SubCategory;
use App\Mall\Color;
use App\Mall\Size;
use App\Mall\Brand;
use File;
use Storage;
use Paginate;
use DB;
use Input;
use Session;
use Validator;

class SizeController extends Controller
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
         $sizes = Size::orderby('id','DESC')->get();
        $subcategories = SubCategory::all();
        $categories = Category::all();
       return view('admin.mall.product.size.add')->with('sizes',$sizes)->with('categories',$categories)->with('subcategories',$subcategories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         Size::create([
            'size'=>$request->name,
            'category_id'=>$request->category_id,
            'sub_category_id'=>$request->sub_category_id
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
        
         $sizeEdit = Size::where('id', $id)->first();
         $sizes = Size::orderby('id','DESC')->get();
           return view('admin.mall.product.size.edit', compact('sizeEdit', 'id'))
                    ->with('sizes',$sizes);

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
            return Redirect('/admin/mall/products/size/create')
             ->withErrors($validator)
             ->withInput();
          }
          else
          {
             $category = Size::find($id);
            $category->name = $request->name;
            $category->save();
             Session::flash('message', 'Successfully updated color!');
            return Redirect('/admin/mall/products/size/create');
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
          $size = Size::find($id);
        $size->delete();

        return redirect('/admin/mall/products/size/create');
    }
}
