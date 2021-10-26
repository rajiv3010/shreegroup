<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Payout;
use App\Achievement;
use App\BusinessArea;
use App\Payment;
use App\UserPointValue;
use App\Email;
use App\Club;
use App\ClubIncomeLog;
use App\UserAutoPool;
use App\UserAutoPoolPayout;
use App\ReferenceLead;
use App\UserBonusClub;
use App\UserWinnersClub;
use App\WithdrawRequest;
use Auth;
use DB;
use Session;
class PayoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

       public function __construct()
      {
          $this->middleware('auth');
          $this->email  = new Email();
      }
    
       public function index()
    {
         $payouts =Payout::select(DB::raw('sum(amount) total'),'message','created_at','amount','business_area_id','type')
                    ->where('user_key',Auth::user()->user_key)
                    ->groupby('business_area_id')
                    ->get();
        return view('users.payout.dashboard',compact('payouts'));
    } 

       public function redeemption()
    {
         $redeemptions = Payout::where('business_area_id',2)->where('user_key',Auth::user()->user_key)
                               ->get();
        return view('users.payout.redeemption',compact('redeemptions'));
    } 

     public function clubDetails($club_id)
    {
       $logs =  ClubIncomeLog::where('user_key',auth::user()->user_key)->where('club_id',$club_id)->get();
        return view('users.club.details',compact('logs'));
    }


    public function binary()
    {
         $binary_payouts = UserPointValue::where('user_key',Auth::user()->user_key)->get();
         return view('users.payout.binary.list',compact('binary_payouts'));
    }

    public function withdraw($Revenue)
    {
        $payout =   Payout::where('user_key',Auth::user()->user_key)->where('status',0)->update(['status'=>2]);

        WithdrawRequest::create([
                    'user_key'=>Auth::user()->user_key,
                    'amount'=>$Revenue,
                    'status'=>0,
                ]);


        session::flash("message","Withdraw request sent");
        return redirect()->back();
    }


    public function withdrawHistory()
    {
     $WithdrawRequest =   WithdrawRequest::where('user_key',Auth::user()->user_key)->get();
        return view('users/payout/withdraw/history',compact('WithdrawRequest'));
    }
    public function businessoverview()
    {
         return view('users.payout.overview.businessoverview');
    }
    public function generalrevenue()
    {
         return view('users.payout.overview.generalrevenue');
    }
    
    
    public function singleLeg()
    {
         $binary_payouts = Payout::where('business_area_id',1)->where('user_key',Auth::user()->user_key)
                                 ->where('type','g')
                                ->get();
         return view('users.payout.single_leg.list',compact('binary_payouts'));
    }

    public function direct()
    {
         $payouts = Payout::where('business_area_id',3)->where('user_key',Auth::user()->user_key)
                                ->get();
         return view('users/payout/direct/list',compact('payouts'));
    }

    public function passbook()
    {   
         $passbooks = Payout::where('user_key',Auth::user()->user_key)->orderBy('created_at','DESC')->get();
         return view('users/payout/passbook',compact('passbooks'));
    }

   public function myPayment()
    {
        
         $myPayments = Payment::where('user_key',Auth::user()->user_key)->get();
         return view('users/payout/payout/myPayment',compact('myPayments'));
    }

    public function myPaymentDetails()
    {
        
         $myPaymentDetails = Payout::where('user_key',Auth::user()->user_key)->get();
         return view('users/payout/payout/myPaymentDetails',compact('myPaymentDetails'));
    }
    



    public function level()
    {

        $levels = Payout::where('business_area_id',13)->where('user_key',Auth::user()->user_key)
                                 ->where('type','l')
                                ->get();
         return view('users.payout.level.list',compact('levels'));
    }

    public function ads()
    {
        $payouts =  Payout::select('message','type','status','created_at','amount')
                              ->where('business_area_id',7)
                              // ->where('status',5)
                              ->where('user_key',Auth::user()->user_key)
                              ->get();
                
        return view('users.payout.ads.list')->with('payouts',$payouts);
    }

   
    public function application()
    {
        $payouts =  Payout::where('business_area_id',4)
        
        ->select('message','created_at','amount')
        ->where('user_key',Auth::user()->user_key)
        ->get();
        return view('users.payout.application.list')->with('payouts',$payouts);
    }
  
    public function classified()
    {
        $payouts = Payout::where('business_area_id',5)
        ->select('message','created_at','amount','status')
        ->where('user_key',Auth::user()->user_key)
        ->get();
        return view('users.payout.classified.list')->with('payouts',$payouts);
    }

    public function club()
    {
        
        $clubs =  Club::all();
        return view('users.club.list',compact('clubs'));
    }
   
    public function payout()
    {
       $payouts =DB::table('payouts')
                    ->select('message','created_at','amount','business_area_id','type')
                    ->where('user_key',Auth::user()->user_key)
                    ->get();
          $datewise =array();
        foreach ($payouts as $key => $date) {
        if(!array_key_exists($date->created_at, $datewise) ){
        $datewise[$date->created_at]=[];
        }
        $datewise[$date->created_at][]= $date;
             
        }

  
        return view('users/payout/payout/list')->with('payouts',$datewise);
    }


// bonusIncome
    // public function bonusIncome()
    // {
    //     $BonusClubPayout = UserBonusClub::where('user_key',Auth::user()->user_key)->get();
    //     return view('users/payout/bonus/list',compact('BonusClubPayout'));
    // }

    // public function bonusIncomeDetails($business_area_id)
    // {
    //     $BonusClubIncome = Payout::where('user_key',Auth::user()->user_key)->where('business_area_id',$business_area_id)->get();
    //     return view('users/payout/bonus/details',compact('BonusClubIncome'));
    // }

// bonusIncome


// winnersClubIncome
    // public function winnersClubIncome()
    // {
    //     $WinnersClubPayout = UserWinnersClub::where('user_key',Auth::user()->user_key)->get();
    //     return view('users/payout/winnersclub/list',compact('WinnersClubPayout'));
    // }

    // public function winnersClubIncomeDetails($business_area_id)
    // {
    //     $WinnersClubIncome = Payout::where('user_key',Auth::user()->user_key)->where('business_area_id',$business_area_id)->get();
    //     return view('users/payout/winnersclub/details',compact('WinnersClubIncome'));
    // }

// winnersClubIncome

// autoPoolIncome

    // public function autoPoolIncome()
    // {

    //     $autoPoolPayout = UserAutoPool::where('user_key',Auth::user()->user_key)->get();
    //     return view('users/payout/autopool/list',compact('autoPoolPayout'));
    // }

    // public function autoPoolIncomeIncomeDetails($id,$user_key)
    // {

    //     $autoPoolPayoutUser = UserAutoPoolPayout::where('user_key',$user_key)->where('user_auto_pool_id',$id)->get();
    //     return view('users/payout/autopool/fromUser',compact('autoPoolPayoutUser'));
    // }

    // public function autoPoolIncomeDetails($business_area_id)
    // {
    //     $autoPoolIncome = Payout::where('user_key',Auth::user()->user_key)->where('business_area_id',$business_area_id)->get();
    //     return view('users/payout/autopool/details',compact('autoPoolIncome'));
    // }
    
// autoPoolIncome


    // lifeTimeReward

public function getBadge($user_key)
    {
           //Log::info('GET BADGE CAll -1',['user_key'=>$user_key,'user->balance_pv_left'=>$user->balance_pv_left,'user->balance_pv_right'=>$user->balance_pv_right]);
           $current_pv= 0;
          $data = UserPointValue::select(DB::raw('SUM(blpv) as Total_blpv') , DB::raw('SUM(brpv) as Total_brpv'))->where('user_key', $user_key)->first();
          if($data ==null){
            $current_pv= 0;
          }else{
                    if ($data->Total_blpv <= $data->Total_brpv){
                        $current_pv= $data->Total_blpv;
                    }else{
                        $current_pv= $data->Total_brpv;
                    }
          }
        $UserAchievementsData = [];
        if ($current_pv >=10000000) {
            //Log::info('GET BADGE -2',['user_key'=>$user_key,'user->balance_pv_left'=>$user->balance_pv_left,'user->balance_pv_right'=>$user->balance_pv_left]);
            
                // User ka abhi ka balankce PV left jo user table me he. wo User Point table me JO BRPV ka some is month ka dono  yadi is IF conistion ke barbar  ya usse jada he to ye chaleha
                    //Log::info('GET BADGE  IF',['user_key'=>$user_key,'balance_pv_left'=>$user->balance_pv_left]);
                     if ($current_pv >= 10000000 && $current_pv <35000000)
                    {   
                        $UserAchievementsData = array('id'=>1,'current_pv'=>$current_pv);
                    }
                    if ($current_pv >= 35000000 && $current_pv < 85000000)
                    {
                        $UserAchievementsData = array('id'=>2,'current_pv'=>$current_pv);
                    }
                    if ($current_pv >= 85000000 && $current_pv < 185000000)
                    {
                        $UserAchievementsData = array('id'=>3,'current_pv'=>$current_pv);
                    }
                    if ($current_pv >= 185000000 && $current_pv < 385000000)
                    {
                        $UserAchievementsData = array('id'=>4,'current_pv'=>$current_pv);
                    }
                    if ($current_pv >= 385000000 && $current_pv < 885000000)
                    {
                        $UserAchievementsData = array('id'=>5,'current_pv'=>$current_pv);
                    }
                    if ($current_pv >= 885000000 && $current_pv < 885000000)
                    {
                        $UserAchievementsData = array('id'=>6,'current_pv'=>$current_pv);
                    }
                  
        }
        return $UserAchievementsData;
    }
    public function lifeTimeReward()
    {
      $Achievements = Achievement::get();
      $myAchivements = $this->getBadge(auth::user()->user_key);
      return view('users/payout/lifetimereward/list',compact('Achievements','myAchivements'));
    }

    public function lifeTimeRewardDetails($business_area_id)
    {
      $lifeTimeRewardPayout = Payout::where('user_key',Auth::user()->user_key)->where('business_area_id',$business_area_id)->get();
        return view('users/payout/lifetimereward/details',compact('lifeTimeRewardPayout'));
    }


    // Cash Back

    public function cashback()
    {
  $data =     ReferenceLead::select(DB::raw('count(id) as `data`'), DB::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"),  DB::raw('YEAR(created_at) year, MONTH(created_at) month'),'created_at')->where('user_key',auth::user()->user_key)->groupby('year','month')
->get();
        return view('users/payout/cashBack/list',compact('data'));
    }
    public function cashbackReferrals($date)
    {
            $date = explode('-', $date);
            $resp = ReferenceLead::
                     where('user_key',auth::user()->user_key)
                    ->where('status','1')
                    ->whereMonth('created_at',$date[0])
                    ->whereYear('created_at',$date[1])
                    ->orderby('created_at','desc')
                    ->get();
                   
        return view('users/payout/cashBack/referrals',compact('resp'));
    }
    
    public function cahbackDetails($date)
    {
        $date = explode('-', $date);
       $payouts = Payout::where('user_key',auth::user()->user_key)
       ->where('status','0')
       ->whereMonth('created_at', $date[0])
       ->whereYear('created_at', $date[1])
       ->orderby('created_at','desc')
       ->get();
        return view('users/payout/cashBack/details',compact('payouts'));
    }

}
