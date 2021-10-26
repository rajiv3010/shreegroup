<?php

namespace App\Http\Controllers\Admin\Gallery;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Gallery\Image;
use File;
use Storage;
use Paginate;
use DB;
use Session;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::orderby('id','DESC')->get();
       return view('comman.gallery.add_image')->with('images',$images);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $images = Image::orderby('id','DESC')->get();
       return view('comman.gallery.add_image')->with('images',$images);
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
            $file->move('images/gallery/', $newImageName);
        }

        Image::create([

        'name'=>$request->name,
        'image'=> $newImageName
      ]);

Session::flash('message','Image has been inserted');
      return redirect('/admin/content-manager/gallery/image');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
