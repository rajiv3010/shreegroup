<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DashboardImage;
use Session;

class DashboardImageController extends Controller
{
	// public function __construct()
 //    {
 //        $this->middleware('auth');
 //    }

    public function add(Request $request)
    {
    	$bannerImage=DashboardImage::get();
        return view('admin/dashboard/add',compact('bannerImage'));
        
    }

    public function create(Request $data)
    {
         $newImageName="";
        $folderPath = 'dashboard_image/';
        if($data->hasFile('image')){
            $file=$data->file('image');
            $newImageName = rand().'_'.$file->getClientOriginalName();
            $file->move($folderPath, $newImageName);
        }
    	DashboardImage::create([
            'image' => $newImageName,
            'is_dashboard' => $data->is_dashboard,
        ]);
    	return redirect()->back();
    }


    public function changeStatus($image_id,$status)
    {
        $image = DashboardImage::find($image_id);
        $image->status =$status;
        $image->save();
        session::flash("message","Image status has been changed");
        return redirect()->back();
    }

    public function delete($id)
    {
    	$bannerImage=DashboardImage::find($id);
    	$bannerImage->delete();
    	return redirect()->back();
    }
    
    
}
