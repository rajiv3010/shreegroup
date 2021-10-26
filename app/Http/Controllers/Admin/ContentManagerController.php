<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\DispatchRequest;
use App\Http\Requests\SeminarRequest;
use App\Seminar;
use App\User;
use App\PayforDocument;
use App\DispatchEntry;
use Auth;
use Session;
use Paginate;
use File;
use Storage;
use Response;
class ContentManagerController extends Controller
{
    
 
	public function seminar()
	{
		if (Auth::guest()){
		$seminars = Seminar::orderBY('created_at','DESC')->paginate();
		}else{
		$seminars = Seminar::orderBY('created_at','DESC')->where('created_by_id',Auth::user()->id)->where('author',0)->paginate();
		}
		return view('comman.seminar.list')->with('seminars',$seminars);
	}

	public function addSeminar()
	{
		return view('comman.seminar.create');
	}


	public function saveSeminar(SeminarRequest $seminarRequest)
	{
		
		if (Auth::guest()){
			$created_by_id = Auth::guard('admin')->user()->id;
			$created_by_name =Auth::guard('admin')->user()->name;
			$author =1;
			$status = 1;
			$redirect = '/admin/content-manager/seminar';		
		}else{
			$created_by_id = Auth::user()->id;
			$created_by_name = Auth::user()->name;
			$author = 0;
			$status = 0;		
			$redirect = '/seminar';		

		}

		$folderPath = 'assets/seminar/';
		$image_name = "seminar.jpg";
		if($seminarRequest->hasFile('image')){
		$file=$seminarRequest->file('image');
		$image_name= $file->getClientOriginalName();
		$file->move($folderPath, $image_name);
		}
	$resp = Seminar::create([
				'created_by_id'=>$created_by_id,
				'created_by_name'=>$created_by_name,
				'title'=>$seminarRequest->title,
				'description'=>$seminarRequest->description,
				'time'=>$seminarRequest->time,
				'place'=>$seminarRequest->place,
				'image'=>$image_name,
				'contact_person'=>$seminarRequest->contact_person,
				'status'=>$status,
				'author'=>$author,
				'seminar_date'=>$seminarRequest->seminar_date,
			]);
		if ($resp->id) {
			session::flash('message','Seminar has been added');
		}else{
			session::flash('message','Somthing went wrong');
		}
		return redirect($redirect);
	}

	public function seminarStatus($status, $seminar_id)
	{
		Seminar::where('id',$seminar_id)->update(['status'=>$status]);
		if ($status){
				session::flash('message','Seminar has been approved');
			
		}else{
				session::flash('message','Seminar has been dis-approved');			
		}
		return redirect()->back();
	}
	public function seminarRemove($seminar_id)
	{
		Seminar::where('id',$seminar_id)->delete();
		session::flash('message','Seminar has been removed');
		return redirect()->back();
	}

	/*Documents*/
	public function documents()
	{	
		$documents = PayforDocument::orderby('created_at','DESC')->get();
		return view('comman.documents.list')->with('documents',$documents);
	}
	public function documentsStore(Request $request)
	{
		$folderPath = 'assets/pay4Documents/';
		$image_name = "seminar.jpg";
		$type = "jpg";
		if($request->hasFile('document')){

		$file=$request->file('document');
		$type= $file->extension();
		$image_name= $file->getClientOriginalName();
		$file->move($folderPath, $image_name);
		}

		PayforDocument::create([
			'title'		   	=>	$request->title,
			'document_name'	=>	$image_name,
			'document_type'	=>	$type,
			]);
		session::flash('message',"Document has been uploaded");
		return redirect('admin/content-manager/documents/');
	}

	public function documentsRemove($id)
	{
		PayforDocument::where('id',$id)->delete();
		session::flash('message','Document has been removed');
		return redirect()->back();
	}


    public  function  DownloadAttachment($id){

            $PayforDocument = PayforDocument::where('id',$id)->first();
            $destination = public_path('assets/pay4Documents').'/'. $PayforDocument->document_name;
        	session::flash("message","Fil has been downloaded");
            return Response::download( $destination,$PayforDocument->document_name,[],'attachment');

    }

    // dispatchEntry
    public function dispatchEntry($user_key="")
    {
    	if (Auth::guard('admin')->user()->id){
		$DispatchEntries = DispatchEntry::orderBY('created_at','DESC')->where('user_key',$user_key)->get();
		}else{
		$DispatchEntries = DispatchEntry::orderBY('created_at','DESC')
										 ->where('status',1)
										 ->get();
		}
		return view('comman/dispatchEntries/list')->with('user_key',$user_key)->with('DispatchEntries',$DispatchEntries);
    }

    // dispatchEntry form
    public function dispatchCreate()
    {
		return view('comman.dispatchEntries.create');
    }

    public function dispatchStore(DispatchRequest $dispatchRequest)
    {
    		$user = User::where('user_key',$dispatchRequest->user_key)->select('user_key')->first();
			if (isset($user->user_key)){

					$DispatchEntries = DispatchEntry::create([
										'user_key'=>$user->user_key,
										'admin_id'=>Auth::guard('admin')->user()->id,
										'title'=>$dispatchRequest->title,
										'courier_company'=>$dispatchRequest->courier_company,
										'url'=>$dispatchRequest->url,
										'tracking_id'=>$dispatchRequest->tracking_id,
										'dispatch_date'=>$dispatchRequest->dispatch_date,	
										]);
					session::flash('message','Dispatch Entries has been added');
				return redirect()->back();
			}else{
					session::flash('message','User not found');
					return redirect()->back();
			}
    }
    public function dispatchRemove($id)
    {
 		DispatchEntry::where('id',$id)->delete();
	    session::flash('message','Dispatch Entries has been removed');
		return redirect()->back();
    }



}
