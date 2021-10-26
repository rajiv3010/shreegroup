<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\User;
use App\Advertisement;
use App\Admanagement;
use App\Advertiser;
use App\AdvertisementLevel;
use App\Payout;
use App\IpTracking;
use App\APC;
use App\Charge;
use App\Pin;
use App\Email;
use Illuminate\Http\Request;
use App\Http\Requests\AddManagementRequest;
use File;
use Storage;
use Session;
use Log;
use Redirect;
use DB;
class AdManagementController extends Controller
{

       public function __construct()
    {
            /*is admin login*/
        $this->middleware('auth:admin');
       $this->payouts  = new Payout();
       $this->email  = new Email();
       $this->admanagement  = new Admanagement();
       $this->advertisement  = new Advertisement();
    }

      public function payAdPayout($user_key, $date ,$advertisement_id,$ip_tracking_id)
      {

          $user = user::where('user_key',$user_key)->first();
         $resp =  $this->payouts->UserPayout($user->id, $date,$advertisement_id);
          $resPay = 1;
          if ($user->is_eligible) {
             $resPay = $this->payUserForAdverClick($user_key,$advertisement_id,$ip_tracking_id,$user);
          }
         if ($resp) {
           session::flash('message','Your payout has been processed');
         }else{
           session::flash('message','Something went wrong,user data not present,Please connect your administrator');
         }
         if ($resPay) {
           session::flash('message','Your payout has been processed');
         }else{
           session::flash('message','Something went wrong,user data not present,Please connect your administrator');
         }
         return redirect()->back();
      }

      public function payUserForAdverClick($user_key,$advertisement_id,$ip_tracking_id,$user)
      {


              $adver = Advertisement::where('id', $advertisement_id)->first();
              /*PayOut Moduel*/
              $business_area_id = 7;
              $admincharges = Charge::all();
              $TDMCharges = array();
              foreach ($admincharges as $key => $value) {
                  $TDMCharges[$value->code] = $value->percentage;
              }
             IpTracking::where('user_id',$user->id)
                ->where('id',$ip_tracking_id)
                ->update(['status'=>5]);

              Payout::pay($user->user_key,$adver->points,$TDMCharges[1],$TDMCharges[2],$business_area_id,1,'Income From campaign');

                      $pins = Pin::where('pin_number',$user->pin_number)->first();

                        if($pins->user_key){
                                if ($pins->created_by==1) {
                                      $apcamount = $adver->points*10/100;
                                        Payout::pay($pins->user_key,$apcamount,$TDMCharges[1],$TDMCharges[2],$business_area_id,1,'Income From campaign by user:'.$user->user_key);
                                      $apc = APC::where('apc_key',$pins->user_key)->first();
                                        $dpcamount = $apcamount*10/100;
                                        Payout::pay($apc->dpc_key,$dpcamount,$TDMCharges[1],$TDMCharges[2],$business_area_id,1,'Income From campaign by user:'.$user->user_key);
                                }
                        }
                  $adverLevel = AdvertisementLevel::where('advertisement_id', $advertisement_id)->get();
                  $this->payouts->AdvertisementPayment($user->user_key, $adverLevel,$business_area_id,$adver->points,$TDMCharges[1],$TDMCharges[2],$user->user_key);
                  /*Rajiv ne bola he yaha par ab point ka percentage batega*/
                  return true;



      }
    public function index()
    {
       $advertisementReports  = IpTracking::all();
       $status = DB::table('status')->whereNotIn('name', ['pay'])->where('business_area_id',7)->get();
       return view('admin.admanagement.dashboard')->with('advertisementReports',$advertisementReports)->with('status',$status);
    }
    public function testEmail(Request $request)
    {
        $this->email->sendTestCPlTemplateMail($request->advertisement_id,$request->email,$request->name);
        session::flash("message","Test Email has been sent to  ".$request->email);
        return redirect()->back();
    }
    public function store(AddManagementRequest $request)
    {


        $this->advertisement->saveAd($request);
            Session::flash('message', 'Successfully created report!');
        return Redirect::to('/admin/admanagement/list');
    }

     public function update(AddManagementRequest $request)
    {
        $this->advertisement->updateAd($request);
            Session::flash('message', 'Successfully updated report!');
        return Redirect::to('/admin/admanagement/list');
    }

        public function Adlist()
    {
        $advertisement = Advertisement::orderby('created_at','DESC')->get();
        return view('admin.admanagement.list')->with('advertisements',$advertisement);
    }

    public function editAdvertisment($id)
    {
      $advertisement = Advertisement::find($id);
      $admanagements = Admanagement::all();
      $advertisers   = Advertiser::all();
      return view('admin.admanagement.edit',compact('advertisement','advertisers','admanagements'));
    }

        public function AdRemove($id)
    {
         Advertisement::find($id)->delete();
         session::flash("message",'Advertisement has been removed');
         return redirect()->back();

    }

    public function add()
    {
        return view('admin.admanagement.create')
                ->with('admanagements',Admanagement::all())
                ->with('advertisers',Advertiser::all());
    }

    public function edit()
    {
        return view('admin.admanagement.editadd');
    }
    /*Report Section*/

    /*Report Section*/




}
