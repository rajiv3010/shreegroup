<?php

namespace App\Http\Controllers\Admin\Affiliate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Affiliate\Affiliate;
use File;
use Storage;
use Paginate;
use DB;
use Session;
use Validator;

class AffiliateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $affiliates = Affiliate::orderby('id','DESC')->get();
       return view('admin.affiliate.add')->with('affiliates',$affiliates);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $affiliates = Affiliate::orderby('id','DESC')->get();
       return view('admin.affiliate.add')->with('affiliates',$affiliates);
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
            $file->move('images/affiliate/logo/', $newImageName);
        }

        Affiliate::create([

        'name'=>$request->name,
        'logo'=> $newImageName
      ]);

        Session::flash('message','Product has been inserted');
      return redirect('/admin/affiliate');
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
    


    // By Dileep

    public function edit($id)
    {


           $affiliate = Affiliate::where('id', $id)->first();

           return view('admin.affiliate.edit', compact('affiliate', 'id'));
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
            if ($validator->fails()) {
            return redirect('/admin/affiliate')
                        ->withErrors($validator)
                        ->withInput();
        }
         $newImageName = '';
        if($request->hasFile('logo')){
            $file=$request->file('logo');
            $newImageName = rand().time('i').$file->getClientOriginalName();
            $file->move('images/affiliate/logo/', $newImageName);
        }
        $affiliate = Affiliate::find($id);
       $affiliate->name =$request->name;
        if($request->hasFile('logo')){
            $affiliate->logo= $newImageName;
         }
        $affiliate->save();
         return redirect('/admin/affiliate')
                        ->with('success','Article updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $affiliate = Affiliate::find($id);
        $affiliate->delete();

        return redirect('/admin/affiliate');
    }
}
