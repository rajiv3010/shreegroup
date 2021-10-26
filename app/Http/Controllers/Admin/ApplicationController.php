<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Routing\UrlGenerator;
use DB;
use File;
use Session;
use Auth;
use App\Application;
use App\ApplicationKeywords;
use App\ApplicationCategory;
use App\ApplicationImage;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
     protected $url;


    public function __construct(UrlGenerator $url)
    {
        $this->url = $url;
         $this->middleware('auth:admin');
    }
    public function index()
    {
        $applications = Application::all();
        $applicationsCategories = ApplicationCategory::all();
        return view('admin.application.add',compact('applications','applicationsCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $applications = Application::orderby('id','DESC')->get();
        return view('admin.application.add')->with('applications',$applications);

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
        if($request->hasFile('logo')){
            $file=$request->file('logo');
            $newImageName = rand().time('i').$file->getClientOriginalName();
            $file->move('images/application/image/', $newImageName);
            $newImageNameUrl = $this->url->to('/').env('base_url').'images/application/image/'.$newImageName;
        }

        $newAPKName = '';
        if($request->hasFile('apk')){
            $file=$request->file('apk');
            $newAPKName = rand().time('i').$file->getClientOriginalName();
            $file->move('application/apk/', $newAPKName);
            $newAPKNameurl = $this->url->to('/').env('base_url').'application/apk/'.$newAPKName;

        }


      $application =   Application::create([
        'name'=>$request->name,
        'application_category_id'=>$request->application_category_id,
        'app_key'=>$this->getAppKey(),
        'description'=>$request->description,
        'apk'=>$newAPKNameurl,
        'image'=>$newImageNameUrl
      ]);
      foreach ($request->keywords as $key => $keyword) {
           ApplicationKeywords::updateOrCreate([
                'application_id'=>$application->id,
                'keywords'=>$keyword
           ]);
      }
        if($files=$request->file('images')){
            foreach($files as $file){
            $image_name = rand().time('i').$file->getClientOriginalName();
            $file->move('images/application/image/', $image_name);
            $image = $this->url->to('/').env('base_url').'images/application/image/'.$image_name;

              ApplicationImage::create([
                    'application_id'=>$application->id,
                    'image'         =>$image,
               ]);
           }
          }

      Session::flash('message','Application has been Uploaded');
      return redirect('/admin/application/');
    }

    public function getAppKey()
    {
         $app_key =  uniqid().rand(10000000,99999999);
        //if generated key is already exist in the DB then again re-generate key
        do
        {
          $check = Application::where('app_key',$app_key)->count();
          $flag = 1;
          if($check == 1)
          {
            $app_key = uniqid().rand(10000000,99999999);
            $flag = 0;
          }
        }
        while($flag==0);

        return $app_key;
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
        Application::destroy ($id);
        session::flash('message','Application has beeb deeet');
        return redirect()->back();
    }

}
