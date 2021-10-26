<?php

namespace App\Http\Controllers\Admin\Affiliate;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Affiliate\AffiliateProduct;
use App\Affiliate\Affiliate;
use App\Mall\Category;
use App\Mall\SubCategory;
use File;
use Storage;
use Paginate;
use DB;
use Session;
use Validator;

class AffiliateProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        protected $url;

    public function __construct(UrlGenerator $url)
    {
        $this->url = $url;
    }

    public function index()
    {   $affiliateproducts = AffiliateProduct::orderby('id','DESC')->get();
        $affiliate_ids = Affiliate::all();
        $mall_cats = Category::all();
        $subcategories = SubCategory::all();

       return view('admin.affiliate.affiliate_product')
       ->with('affiliateproducts',$affiliateproducts)
       ->with('affiliate_ids',$affiliate_ids)
       ->with('mall_cats',$mall_cats)
       ->with('subcategories',$subcategories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
                    

         $affiliateproducts = AffiliateProduct::orderby('id','DESC')->get();
        $affiliate_ids = Affiliate::all();
        $mall_cats = Category::all();
        $subcategories = SubCategory::all();

       return view('admin.affiliate.affiliate_product')->with('affiliateproducts',$affiliateproducts)->with('affiliate_ids',$affiliate_ids)->with('mall_cats',$mall_cats)->with('subcategories',$subcategories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
           $validator = Validator::make($request->all(), [
            'company_id' => 'required',
            'name' => 'required',
            'category_id' => 'required',
            'link' => 'required',
            'sub_category_id' => 'required',
            'price' => 'required',
            'discount' => 'required',
           
        ]);
            if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
                 $images='';
                 if ($request->file('image')) {

                 $file=$request->file('image');
                 $name=$file->getClientOriginalName();
                 $extension=$file->getClientOriginalExtension();
                 $file->move('assets/images/mall/products',$name);
                 $images=$this->url->to('/').'/assets/images/mall/products/'.$name;
                 }

        AffiliateProduct::create([

        'affiliate_id'=>$request->company_id,
        'name'=>$request->name,
        'category_id'=>$request->category_id,
        'sub_category_id'=>$request->sub_category_id,
        'link'=>$request->link,
        'price'=>$request->price,
        'rating'=>$request->rating,
        'discount'=>$request->discount,
        'image'=>$images,
      ]);

      Session::flash('message','Product has been inserted');
      return redirect('/admin/affiliate-product');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

// By Dileep

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $affiliateProduct = AffiliateProduct::where('id', $id)->first();
        $affiliateproducts = AffiliateProduct::orderby('id','DESC')->get();
        $affiliate_ids = Affiliate::all();
        $mall_cats = Category::all();
        $subcategories = SubCategory::all();

       
     return view('admin.affiliate.product_edit', compact('affiliateProduct', 'id'))
       ->with('affiliateproducts',$affiliateproducts)
       ->with('affiliate_ids',$affiliate_ids)
       ->with('mall_cats',$mall_cats)
       ->with('subcategories',$subcategories);
        
           

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // By Dileep
    public function update(Request $request, $id)
    {

         $validator = Validator::make($request->all(), [
            'name' => 'required',
            'link' => 'required',
           
        ]);
    //         if ($validator->fails()) {
    //         return redirect('/admin/affiliate-product')
    //                     ->withErrors($validator)
    //                     ->withInput();
    //     }
    //       $images='';
    //     if($files=$request->file('image')){
    //        foreach($files as $file){
    //              $name=$file->getClientOriginalName();
    //              $extension=$file->getClientOriginalExtension();
    //              $file->move('public/images/homepage',$name);
    //             $images .=$this->url->to('/').'/public/images/homepage/'.$name;
    //             $images .=',';
    //          }

    //     $affiliateProduct = AffiliateProduct::find($id);
    //    $affiliateProduct->image =$request->image;
    //     if($files=$request->file('image')){
    //         $affiliateProduct->image= $images;
    //      }
    //     $affiliateProduct->save();
    //      return redirect('/admin/affiliate-product');
    // }


            AffiliateProduct::find($id)->update($request->all());
        return redirect('/admin/affiliate-product');

}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function destroy($id)
    {
       
        $affiliateProduct = AffiliateProduct::find($id);
        $affiliateProduct->delete();
        Session::flash('message','Record has been deleted');
        return redirect()->back();
    }
}

// bY Dileep