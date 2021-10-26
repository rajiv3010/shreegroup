<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BannerAds;
use Auth;
use Session;
class BannerAdsController extends Controller
{
       public function __construct()
    {
         $this->middleware('auth:admin');
    }
       public function index()
    {  
    	$banners=BannerAds::all();
       return view('admin.banner-ads.index',compact('banners'));
    }
       public function add()
    {  
       return view('admin.banner-ads.add');
    }
       public function store(Request $request)
    {  

    	BannerAds::create([
    		'affiliate_name'=>$request->affiliate_name,
    		'type'=>$request->type,
            'html'=>$request->html,
    		'size'=>$request->size,
    		'status'=>$request->status,
    		'created_by'=>Auth::guard('admin')->user()->name
    	]);
    	session::flash('message','Your add has been added');
    	return redirect('/admin/banner-ads');
    }
    public function edit($id)
    {
    	$banner = BannerAds::find($id);
    	return view('admin.banner-ads.edit',compact('banner'));
    }
    public function remove($id)
    {
    	$banner = BannerAds::find($id);
    	$banner->delete();
    	return redirect()->back();
    }
    public function changeStatus($id,$status)
    {
    	$banner = BannerAds::find($id);
    	$banner->status = $status;
    	$banner->update();
    	session::flash('message','Status has been changed');
    	return redirect('/admin/banner-ads');
    }
}
