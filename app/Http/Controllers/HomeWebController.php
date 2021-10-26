<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BusinessCategory;
use App\Classified;
use Session;
class HomeWebController extends Controller
{
    public function welcome()
    {
    	$business_categories =  BusinessCategory::take(12)->get();
    	return view('welcome')->with('business_categories',$business_categories);
    } 
    public function categories($name)
    {   $business_category = BusinessCategory::select('id')->where('name',$name)->first();
    	$classifieds = Classified::where('business_category_id',$business_category->id)->get();
    	if ($classifieds->count()) {
            
    		return view('categories')->with('classified',$classifieds);	
    	}else{
    		session::flash('message','Sorry  details not  found');
    		return redirect()->back();
    	}
    }
}
