<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PinAsignRequest;
use App\Pin;
use App\PinRequest;
use App\AssignPin;
use App\Package;
use App\User;
use Session;
use Auth,DB;
class PinController extends Controller
{
       public function __construct()
    {
         $this->middleware('auth:admin');
        $this->pin  = new Pin();
        $this->assignPin  = new AssignPin();
    }


    public function index()
    {
       $pins = Pin::orderby('created_at','DESC')->paginate(200);
       $count = Pin::count();
       $statusList = DB::select('SELECT COUNT(id) as count,status FROM `pins` GROUP BY status order by status DESC');
       $packages = Package::all();
       $status = 'all';
       $package_id = 'all';
      return view('admin/pin/list',compact('pins','packages','count','status','package_id','statusList')); 
    }

    public function blockPin($pin_id,$status)
    {
      Pin::where('id',$pin_id)->update(['status'=>$status]);
      AssignPin::where('pin_id',$pin_id)->update(['status'=>$pin_id]);
      session::flash("message","Pin Status has been changed");
      return redirect()->back();
    }

    public function removePin($pin_id)
    {
      Pin::where('id',$pin_id)->delete();
      AssignPin::where('pin_id',$pin_id)->delete();
      session::flash("message","Pin has been removed");
      return redirect()->back();
    }

    public function removePinsByStatus($status)
    {
          Pin::where('status',$status)->delete();
          AssignPin::where('status',$status)->delete();
          session::flash("message","Core pin and assign pins has been deleted!");
          return redirect()->back();
    }

    public function searchFilterAlt(Request $request)
    {
      if ($request->package_id=='all') {
        $pins = Pin::where('status',$request->status)->orderby('created_at','DESC')->paginate(200);
        $count = Pin::where('status',$request->status)->count();
        }elseif ($request->status=='all') {
        $pins = Pin::where('package_id',$request->package_id)->orderby('created_at','DESC')->paginate(200);
        $count = Pin::where('package_id',$request->package_id)->count();
        }elseif ($request->status=='all' && $request->package_id=='all') {
        $pins = Pin::orderby('created_at','DESC')->paginate(200);
        $count = Pin::count();
        }else{
        $pins = Pin::where('status',$request->status)->orderby('created_at','DESC')->where('package_id',$request->package_id)->paginate(200);
        $count = Pin::where('status',$request->status)->where('package_id',$request->package_id)->count();          
        }

       $status = $request->status;
        $package_id = $request->package_id;
           $packages = Package::all();
      return view('admin.pin.list',compact('pins','packages','count','status','package_id')); 
    }


    
    public function searchFilter(Request $request)
    {
        if ($request->package_id=='all') {
        $pins = Pin::where('status',$request->status)->orderby('created_at','DESC')->paginate(500);
        $count = Pin::where('status',$request->status)->count();
        }elseif ($request->status=='all') {
        $pins = Pin::where('package_id',$request->package_id)->orderby('created_at','DESC')->paginate(500);
        $count = Pin::where('package_id',$request->package_id)->count();
        }elseif ($request->status=='all' && $request->package_id=='all') {
        $pins = Pin::orderby('created_at','DESC')->paginate(500);
        $count = Pin::count();
        }else{
        $pins = Pin::where('status',$request->status)->orderby('created_at','DESC')->where('package_id',$request->package_id)->paginate(500);
        $count = Pin::where('status',$request->status)->where('package_id',$request->package_id)->count();          
        }



        $view =  view('admin.pin.filterSeach',[
            'pins' => $pins,
            'count' => $count,
            'status' => $request->status,
            'package_id' => $request->package_id,
                ]);
        $html = $view->render();
        print_r($html);
    }

    
    public function add()
    {
       $packages = Package::all();
       return view('admin.pin.add')->with('packages',$packages);
    }
    public function request()
    {
       $PinRequests = PinRequest::orderby('status','ASC')->where('status','0')->paginate(15);
       return view('admin.pin.request',compact('PinRequests'));
    }
    public function requestAccepted()
    {
       $PinRequests = PinRequest::orderby('created_at','DESC')->where('status','1')->paginate(15);
       return view('admin.pin.request',compact('PinRequests'));
    }
    
    public function requestDetails($id)
    {       
       $PinRequests = PinRequest::find($id);
       $pins = Pin::where('user_key',$PinRequests->user_key)->get();
      
       return view('admin.pin.requestDetails',compact('pins'));

    }
    

    public function requestStatus($request_id,$status)
    {
        
        $PinRequests = PinRequest::find($request_id);
        if ($PinRequests->status==1) {
          session::flash("message","Your request already completed");
          return redirect()->back();
        }
        $PinRequests->status=$status;
        $PinRequests->updated_at=now();
        $PinRequests->save();
        


        $user_key = $PinRequests->user_key;
        $count = $PinRequests->qty;
        $package_id = $PinRequests->package_id;
        $created_by = $PinRequests->user_key;

        if ($status==1) {              
        $this->pin->createPinRequest($user_key,$count,$package_id,$created_by);
        }
        session::flash("message","Status has been updated");
        return redirect()->back();
    }
    
    public function store(Request $request)
    {

       $pinResp = $this->pin->savePin($request,Auth::guard('admin')->user()->id,Auth::guard('admin')->user()->name);
       Session::flash('message','Your '.$pinResp.' pin number has been added');
       return redirect('/admin/pin');
    }
    public function asign()
    {
       $users =  User::all();
       $pins  =  Pin::where('status',1)->where('created_by',0)->get();
       return view('admin.pin.assignPin')->with('users',$users)->with('pins',$pins);
    }
    public function asignPinSave(PinAsignRequest $PinAsignRequest)
    {   
      dd("ASd");
      $user = User::where('user_key',$PinAsignRequest->user_key)->count();
      if ($user) {
       $pinResp = $this->assignPin->asignPinSave($PinAsignRequest->all(),Auth::guard('admin')->user()->id,'admin');
       Session::flash('message','Your pin asign successfully');
        
      }else{
       Session::flash('message','Invalid user id');

      }
       return redirect()->back();
    }
    public function statusPin()
    {
       $pinsStatus = $this->assignPin->asignPinStatus();
       
         return view('admin.pin.status',compact('pinsStatus'));
    }


}
