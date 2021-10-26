<?php

namespace App\Http\Controllers\Admin\Download;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Download;
use Session;

class DownloadController extends Controller
{
    // public function __construct()
 //    {
 //        $this->middleware('auth');
 //    }

    public function add(Request $request)
    {
        $bannerImage=Download::get();
        return view('comman/download/add',compact('bannerImage'));
        
    }

    public function create(Request $data)
    {
         $newFileName="";
        $folderPath = 'downloads/';
        if($data->hasFile('file')){
            $file=$data->file('file');
            $newFileName = rand().'_'.$file->getClientOriginalName();
            $file->move($folderPath, $newFileName);
        }
        Download::create([
            'file' => $newFileName,
            'name' => $data->name,
        ]);
        return redirect()->back();
    }


    public function changeStatus($image_id,$status)
    {
        $image = Download::find($image_id);
        $image->status =$status;
        $image->save();
        session::flash("message","Image status has been changed");
        return redirect()->back();
    }

    public function delete($id)
    {
        $bannerImage=Download::find($id);
        $bannerImage->delete();
        return redirect()->back();
    }
    
    
}
