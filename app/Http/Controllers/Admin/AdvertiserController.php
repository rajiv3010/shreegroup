<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Advertiser;
use App\Advertisement;
use App\Email;
use Validator;
use Redirect;
use Session;
class AdvertiserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
    {
            /*is admin login*/
       $this->email  = new Email();
   }
    public function index()
    {   $advertisers = Advertiser::all();
        return view('admin.advertiser.list',compact('advertisers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.advertiser.add');

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
            'company_name' => 'required|unique:advertisers|max:255',
            'name' => 'required',
            'email' => 'required|email|unique:advertisers',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $password = strtolower(str_replace(' ', '', $request->name));
        Advertiser::create([
            'company_name'=>$request->company_name,
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($password)
        ]);
        $this->email->advertiserWelcome($request->all(),$password);
        session::flash('message','Advertiser has been created');
        return redirect('admin/advertiser');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $advertisements = Advertisement::where('advertiser_id',$id)
                            ->orderby('created_at','ASC')->get();
        return view('admin.advertiser.show',compact('advertisements'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $advertiser = Advertiser::find($id);
        return view('admin.advertiser.edit',compact('advertiser'));
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
       // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'name'       => 'required',
            'email'      => 'required|email',
            'company_name' => 'required'
        );
        $validator = Validator::make($request->all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('admin/advertiser/' . $id . '/edit')
                ->withErrors($validator);
                 } else {
            // store
            $advertiser = Advertiser::find($id);
            $advertiser->name       = $request->name;
            $advertiser->email      = $request->email;
            $advertiser->company_name      = $request->company_name;
            $advertiser->save();

            // redirect
            Session::flash('message', 'Successfully updated advertiser!');
            return Redirect::to('admin/advertiser');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         // delete
        $advertiser = Advertiser::find($id);
        $advertiser->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the advertiser!');
        return Redirect::to('admin/advertiser');
    }
}
