<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\User;
use App\Advertisement;
use App\IpTracking;
use App\AdvertisementReport;
use Illuminate\Http\Request;
use App\Http\Requests\AddManagementRequest;
use App\Http\Requests\AdvertisementReportRequest;
use File;
use DB;
use Storage;
use Session;
use Redirect;
class AdvertisementReportController extends Controller
{

       public function __construct()
    {
            /*is admin login*/
        $this->middleware('auth:admin');
       $this->advertisementReport  = new AdvertisementReport();
    }


    public function index()
    {
       return view('admin.admanagement.reports.dashboard');
    }

    public function store(AddManagementRequest $request)
    {
        $this->advertisementReport->saveReport($request);
        Session::flash('message', 'Successfully created Report!');
        return Redirect::to('/admin/admanagement/report/list');
    }

    public function list()
    {
        $advertisement = Advertisement::all();
        return view('admin.admanagement.list')->with('advertisements',$advertisement);
    }

    public function add()
    {
        return view('admin.admanagement.create');
    }
    public function edit()
    {
        return view('admin.admanagement.editadd');
    }
    /*Report Section*/


    public function reportStore(AdvertisementReportRequest $request)
    {
        $this->advertisementReport->saveReport($request);
        Session::flash('message', 'Successfully created Report!');
        return Redirect::to('/admin/admanagement/reports');
    }
    public function reportList()
    {
         $advertisementReport = IpTracking::all();
         $status = DB::table('status')->where('business_area_id',7)->get();
        return view('admin.admanagement.reports.list')->with('advertisementReports',$advertisementReport)->with('status',$status);
    }
    public function changeStatusReport($id)
    {       $id = explode('-', $id);
            $adver_status = $id[0];
            $adver_id     = $id[1];
            
            IpTracking::where('id',$adver_id)->update(['status'=>$adver_status]);
            echo $adver_id;
    }

  
    public function reportAdd()
    {
        return view('admin.admanagement.reports.create');
    }
    /*Report Section*/




}
