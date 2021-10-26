<?php
  namespace App\Http\Controllers;
  use App\User;
  use App\Admanagement;
  use App\Email;
  use App\AdvertisementReport;
  use App\Advertisement;
  use App\IpTracking;
  use Illuminate\Http\Request;
  use Auth;
  use DB;
  use Redirect;
  use Session;
  use Mail;
  use Route;
  use Carbon\Carbon;
  class AdManagementController extends Controller
  {

         public function __construct()
      {
          $this->middleware('auth');
          $this->IpTracking  = new IpTracking();
          $this->email  = new Email();

      }


      public function index()
      {
        $advertisementReports  = IpTracking::where('user_id',Auth::user()->id)->get();

        $date = date('Y-m-d');
        $adManagements  = Admanagement::all();
        foreach ($adManagements as $key => $value) {
            $name = $value->name;
            $admanagements_id = Admanagement::where('name',$value->name)->select('id')->first();
            $value->$name =  Advertisement::where('admanagement_id',$admanagements_id->id)->where('expiry_date','>=',$date)->get();
            foreach ($value->$name as $key => $advertisements) {
              $advertisements->advertisementsCount =  IpTracking::where('advertisement_id',$advertisements->id)->where('user_id','=',Auth::user()->id)->count();

                  $advertisements->clickeable =$this->isEligible($advertisements->link,$advertisements->id);
            }
        }
//        dd($adManagements);
        return view('users.admanagement.dashboard')->with('report',$advertisementReports)->with('adManagements',$adManagements);

      }

      public function isEligible($url,$advertisement_id)
      {
         $result  = IpTracking::where('advertisement_id',$advertisement_id)
                  ->where('ip',\Request::ip())
                  ->where('url',$url)
                  ->orderBY('created_at','DESC')
                  ->first();

                  if (count($result)) {
                  $created = new Carbon($result->created_at);
                  $now = Carbon::now();
                  $difference = ($created->diff($now)->days < 30) ? '0 ': $created->diffInDays($now);
                  if ($difference >= 30) {
                  return true;
                  }else{
                  return false;
                  }
                  }else{
                  return true;
                  }
      }


      public function openAd($offer_type)
      {


        if ($offer_type =='adreport') {
            $advertisementReports  = IpTracking::where('user_id',Auth::user()->id)->get();
            $status = DB::table('status')->where('business_area_id',7)->get();
            return view('users.admanagement.adreport.list')->with('advertisementReports',$advertisementReports)->with('status',$status);
        }else{
            $admanagements_id = Admanagement::where('name',$offer_type)->select('id')->first();
            $links =  Advertisement::where('admanagement_id',$admanagements_id->id)->get();
            return view('users.admanagement.list')->with('advertisements',$links);
        }
      }

      public function doOpenLink(Request $request)
      {

           $resp =  $this->IpTracking->checkRequest($request);
            
            if ($resp) {
                if ($request->sendmail) {
                      $this->email->sendCPlTemplateMail($request->advertisement_id);
                      Session::flash('message','Please check your email, we had sent you an email in your register email id '.Auth::user()->email);
                      return redirect()->back();
                }else{
                  Session::flash('message','Thank you for cliking');
                      return redirect()->away($request->url);
                }
            }else{
               Session::flash('message','You exceeded your monthly limit');
               return redirect()->back();
            }
     }

      public function advertisementsHistory()
      {
        $advertisementsHistory = IpTracking::select(DB::raw("IFNULL(count(advertisement_id),0) as advertisement_count"),'advertisement_id','id')->groupby('advertisement_id','id')->where('user_id',Auth::user()->id)->get();
          return view('users.admanagement.advertisementsHistory',compact('advertisementsHistory'));
      }
      public function advertisementsHistoryDetails($advertisement_id)
      {
        $advertisementsHistoryDetails = IpTracking::where('user_id',Auth::user()->id)->where('advertisement_id',$advertisement_id)->get();
        $view = view('users.admanagement.advertisementsHistoryDetails', [
        'advertisementsHistoryDetails' => $advertisementsHistoryDetails,
        ]);
        $html = $view->render();
        print_r($html);
 
      }
      public function cpv()
      {
          return view('users.admanagement.cpv.list');
      }

      public function adreport()
      {
          return view('users.admanagement.adreport.list');
      }

      public function add()
      {
          return view('users.admanagement.createadd');
      }
      public function edit()
      {
          return view('users.admanagement.editadd');
      }


  }
