<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserDocuments;
use App\BusinessSubCategory;
use App\City;
use App\User;
use App\Location;
use DB;
use Session;
use Auth;
use File;
class DocumentController extends Controller
{

     public function userLoginByAdmin($user_key)
 {
     $user = User::where('user_key', $user_key)->first();
     Auth::login($user);
     return redirect('/home');
 }



    public function getSubBusinessCategory($business_category_id)
    {
            $sub_business_category = BusinessSubCategory::where('category_id',$business_category_id)->get();
            echo json_encode($sub_business_category);
    }

    public function getCities($state_id)
    {
            $cities = City::where('state_id',$state_id)->get();
            echo json_encode($cities);
    }

    public function getLocation($city_id)
    {
            $locations = DB::table('pincodes')->where('city_id',$city_id)->get();
            echo json_encode($locations);
    }


    public function uploadDocument(Request $request)
    {
    	
		$path = env('USER_DOC_DESTINATION').Auth::user()->id.'/documents';
		if (!file_exists($path)) {
		File::makeDirectory($path, $mode = 0777, true, true);
		}
        if ($request->hasFile('document')) {
            $document = $request->file('document');
            $newname = time().'.'.$document->extension();
            $type = $document->extension();
         
            $document->move($path, $newname);
        }
        $originalFileName = $document->getClientOriginalName();
        
    $reps=  UserDocuments::create([
        	'user_id'=>Auth::user()->id,
        	'document_id'=>$request->document_id,
        	'document_name'=>$request->document_name,
        	'attachment_name'=>$originalFileName,
        	'attachment_temp'=>$newname,
        	'attachment_type'=>$type,
        	]);
    if ($reps->id) {
    	Session::flash('message',"Your " .$request->document_name. " document has been uploaded");
    }else{
    	Session::flash('message',"Something went wrong with" .$request->document_name. " document that you uploaded");
    }
    	return redirect()->back();    
    }
}
