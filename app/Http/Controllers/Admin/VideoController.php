<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Video;
use Session;

class VideoController extends Controller
{
   public function add(Request $request)
    {
        $video=Video::get();
        return view('admin/video/add',compact('video'));
    }

    public function create(Request $data)
    {
        Video::create([
            'name' => $data->name,
            'video_url' => $data->video_url,
            'short_desc' => $data->short_desc,
        ]);
        return redirect()->back();
    }


    public function changeStatus($video_id,$status)
    {
        $video = Video::find($video_id);
        $video->status =$status;
        $video->save();
        session::flash("message","Video status has been changed");
        return redirect()->back();
    }

    public function delete($id)
    {
        $video=Video::find($id);
        $video->delete();
        session::flash("message","Video deleted");
        return redirect()->back();
    }
}
