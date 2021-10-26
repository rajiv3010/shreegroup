<?php

namespace App\Http\Controllers\Admin\Mall;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mall\Product;
use App\Mall\Category;
use App\Mall\SubCategory;
use Auth;
use App\Mall\Color;
use App\Admin;
use App\Mall\Size;
use App\Affiliate\Affiliate;
use App\Mall\Brand;
use App\Mall\Merchant;
use File;
use Storage;
use Paginate;
use DB;
use Session;
use Validator;

class ProductController extends Controller
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
       return redirect('/admin/mall/product/create');
    }

    public function merchants()
    {
        $merchants =  Admin::where('is_merchant','>',0)->get();
        return view("admin.mall.merchant.list",compact('merchants'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          if(Auth::guard('admin')->user()->is_merchant){
            $products = Product::where('merchant_id',Auth::guard('admin')->user()->merchant_id)->get();
          }else{
            
            $products = Product::all();
          }

        $datas = Color::get();
        $sizes = Size::all();
        $brands = Brand::all();

        $affiliates = Affiliate::all();        
        $categories = Category::all();
        $merchants = Merchant::all();

       return view('admin.mall.product.add')
                   ->with('datas',$datas)
                   ->with('merchants',$merchants)
                   ->with('affiliates',$affiliates)
                   ->with('sizes',$sizes)
                   ->with('categories',$categories)
                   ->with('products',$products)
                   ->with('brands',$brands);

     


       
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $product = Product::where('id', $id)->first();
        $product->subcategories=SubCategory::where('category_id',$product->category_id)->get();
        $product->brands=Brand::where('category_id',$product->category_id)->get();
        if(Auth::guard('admin')->user()->is_merchant){
            $products = Product::where('merchant_id',Auth::guard('admin')->user()->merchant_id)->get();
          }else{
            
            $products = Product::all();
          }

        $datas = Color::get();
        $sizes = Size::all();
        $brands = Brand::all();

        $affiliates = Affiliate::all();        
        $categories = Category::all();
        $merchants = Merchant::all();
        
       return view('admin.mall.product.edit',compact('product', 'id'))
                   ->with('datas',$datas)
                   ->with('merchants',$merchants)
                   ->with('affiliates',$affiliates)
                   ->with('sizes',$sizes)
                   ->with('categories',$categories)
                   ->with('products',$products)
                   ->with('brands',$brands);

     


       
    }
    
    public function merchantsStatus($merchant_id,$status)
    {
        Admin::where('merchant_id',$merchant_id)->update(['status'=>$status]);
        Merchant::where('id',$merchant_id)->update(['status'=>$status]);
        Product::where('merchant_id',$merchant_id)->update(['status'=>$status]);
        session::flash("message","Status has been changed,Affected admin ,merchant and product table");
        return redirect()->back();
    }
    public function getProductSubCategory($category_id)
    {
         $subcategories = SubCategory::where('category_id',$category_id)->get();
         if ($subcategories->count()) {
         echo json_encode($subcategories);
            
         }else{
            echo 0;
         }
    }
    public function getProductSubCategoryColor($category_id)
    {
         $subcategories = Color::where('category_id',$category_id)->get();
         if ($subcategories->count()) {
         echo json_encode($subcategories);
            
         }else{
            echo 0;
         }
    }
    public function getProductSubCategoryBrand($sub_category_id)
    {
         $subcategories = Brand::where('sub_category_id',$sub_category_id)->get();
         if ($subcategories->count()) {
         echo json_encode($subcategories);
            
         }else{
            echo 0;
         }
    }

    public function getProductSubCategorySize($sub_category_id)
    {
         $subcategories = Size::where('sub_category_id',$sub_category_id)->get();
         if ($subcategories->count()) {
                 echo json_encode($subcategories);            
         }else{
                 echo 0;
         }
    }

    /**
     * Change Product Status.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function productStatus($status,$product_id)
    {
       $product =  Product::find($product_id);
       $product->status=$status;
       $product->save();
       session::flash("message",$product->product_name . '  product id : '.$product->id. " status has been updated");
       return redirect()->back();
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
            $file->move('images/mall/products/', $newImageName);
            $newImageName =  url(''.env('base_url').'images/mall/products/').'/'.$newImageName;
        }
        $is_affiliate=0;
        if ($request->is_affiliate) {
            $is_affiliate=1;
        }

        $our_price =  $request->cost*$request->discount/100;
        $our_price = $request->cost-$our_price;
         if ($request->size) {
                 $size =  implode(',', $request->size);
             }
             
        $product_code = time('ish').uniqid().rand('111111','999999');
        Product::create([
        'category_id'=>$request->category,
        'product_code'=>$product_code,
        'gender'=>$request->gender,
        'merchant_id'=>$request->merchant_id,
        'sub_category_id'=>$request->subcategory,
        'brand_name'=>$request->brand_name,
        'product_name'=>$request->product_name,
        'description'=>$request->description,
        'cost'=>$request->cost,
        'color_id'=>$request->color,
        'link'=>$request->link,
        'rating'=>$request->rating,
        'is_affiliate'=>$is_affiliate,
        'company_id'=>$request->company_id,
        'size_id'=>$size,
        'brand_id'=>$request->brand,
        'discount'=>$request->discount,
        'our_price'=>$our_price,
        'image'=> $newImageName
      ]);

    Session::flash('message','Product has been inserted');
      return redirect('/admin/mall/product/create');
     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('/admin/mall/product/create');
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
           
            'product_name' => 'required',
            'description' => 'required',
            'cost' => 'required',
            'discount' => 'required',
            'our_price' => 'required',
            
        ]);


         if ($validator->fails()) {
            return redirect('admin/mall/product/create')
                        ->withErrors($validator)
                        ->withInput();
        }
        $newImageName = '';
        if($request->hasFile('image')){
            $file=$request->file('image');
            $newImageName = rand().time('i').$file->getClientOriginalName();
            $file->move('images/mall/products/', $newImageName);
        }
        $product = Product::find($id);
       $product->name =$request->name;
       if($request->hasFile('image')){
            $product->logo= $newImageName;
         }

       $product = Product::find($id)->update($request->all());  
         return redirect('admin/mall/product/create')
                        ->with('success','Product updated successfully');


            


        
                       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $productEdit = Product::find($id);
        $productEdit->delete();

        return redirect('admin/mall/product/create');
    }
}
