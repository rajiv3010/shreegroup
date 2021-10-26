<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use DB;
use App\Apc;
use App\ClubUser;
use App\ClubIncomeLog;
use App\Dpc;
use App\User;
use App\GenerationDayCal as GDC;
use App\IpTracking;
use Auth;
use Log;
use Session;
class Payout extends Model
{
    public $parent=   array();
    public $p=1;
    protected $fillable = [
       'user_key','activity_id','amount','txn_type','earning','tds','message','admin_charges','percentage','business_area_id','status','type','txn_type','user_type_id','created_at'
    ];


    public function user()
    {
      return $this->belongsTo('App\User','user_key','user_key');
    }
 
    public function activity()
    {
      return $this->belongsTo('App\Activity');
    }
 
    public function businessarea()
    {
      return $this->belongsTo('App\BusinessArea','business_area_id','id');
    }

    public function UserPayout($user_key, $date, $advertisement_id)
    {

      $res = Payout::where('status',0)->where('user_key',$user_key)->where('business_area_id',7)->where('created_at',$date)->get();
      if (count($res)) {
        return 0;
      }else{
        IpTracking::where('user_id',$user_key)->where('advertisement_id',$advertisement_id)->update(['status'=>5]);
        return  Payout::where('user_key',$user_key)->where('business_area_id',7)->where('created_at',$date)->update(['status'=>0]);
      }

    }


    public static function  pay($user_key,$earning,$business_area_id,$status,$message,$user_type_id=1)
{             
   // 0 = admin Charges,1=TDS,2= Binary,3=Direct Income,4=PST
            // $charges = Charge::all();
            // $adminCharges =  $charges[0]->percentage;
            // $TDSpercent =  $charges[1]->percentage;
            // $adminamount = $earning*$adminCharges/100; /*Admin Charge %*/
            // $TDS =  $earning*$TDSpercent/100; /*TDS %*/
            // $deduction = $TDS+$adminamount;
            // $amount = $earning-$deduction;

             Payout::create([
              'user_key'=>$user_key,
              'activity_id'=>session('activity_id'),
              'amount'=>$earning,
              'percentage'=>0,
              'business_area_id'=> $business_area_id,
              'earning'=>$earning,
              'tds'=>0,
              'message'=>$message,
              'admin_charges'=>0,
              'earning_by'=>$user_key,
              'status'=>0,
              'user_type_id'=>$user_type_id,
              ]);
    }

      /*Club Income Distribution*/
    public function payDailyClubIncome($user_key,$club_name,$club_id,$adminCharges,$TDSpercent,$date)
    {
            $earning = 10;
            $adminamount = $earning*$adminCharges/100; /*Admin Charge %*/
            $TDS =  $earning*$TDSpercent/100; /*TDS %*/
            $deduction = $TDS+$adminamount;
            $amount = $earning-$deduction;
            $message = "Daily ". $club_name .' club income '; 
             Payout::create([
              'user_key'=>$user_key,
              'activity_id'=>0,
              'amount'=>$amount,
              'percentage'=>$adminCharges+$TDSpercent,
              'business_area_id'=>16,
              'earning'=>$earning,
              'tds'=>$TDS,
              'message'=>$message,
              'admin_charges'=>$adminamount,
              'earning_by'=>$user_key,
              'status'=>0,
              'user_type_id'=>0,
              'created_at'=>$date
              ]); 
 
             $club =  ClubUser::find($club_id);
             $club->earned = $club->earned+$earning;
             $club->due = $club->due-$earning;
             $club->save();
             
             $ClubIncomeLog = new  ClubIncomeLog();
             $ClubIncomeLog->amount = $amount;
             $ClubIncomeLog->earning = $earning;
             $ClubIncomeLog->tds = $TDS;
             $ClubIncomeLog->admin_charges = $adminamount;
             $ClubIncomeLog->user_key = $user_key;
             $ClubIncomeLog->created_at = $date;
             $ClubIncomeLog->club_id = $club->club_id;
             $ClubIncomeLog->save();

    }
      /*Club Income Distribution*/

    function BA(){
      return $this->belongsTo('App\BusinessArea','business_area_id','id');
    }

    /****************************************************************************
    **********************Classified Distribute Payment**************************
    *****************************************************************************/
    public function ClassifiedDistributePayment($user_key,$amount,$classifiedLevel,$BA)
    {
      if ($user_key) {
         $parent_key = DB::table('users')->where('user_key',$user_key)->select('parent_key','package_id')->first();
         $this->parent[] .=$user_key;
         //$this->parent .=',';
         $this->parent_key = $this->ClassifiedDistributePayment($parent_key->parent_key,$amount,$classifiedLevel,$BA);
    if (isset($parent_key->parent_key)) {
        $this->parent[] .= $parent_key->parent_key;
      }
      }else{
          $current_user = $this->parent[0];
           unset($this->parent[0]);

          if (count($this->parent) > 0) {
             $this->classifiedDistributePaymentMadePayment($this->parent,$amount,$classifiedLevel,$BA,$current_user);
          }
      }
      return true;

  }
   public  function classifiedDistributePaymentMadePayment($users,$amount,$level_percent,$business_area_id,$current_user){


                      foreach ($level_percent as $key => $value) {
                        $levels[$key+1] =$value->percentage;
                      }
                     Log::info('Binary Level',[$levels]);
                    if(count($users) > count($levels)){
                            $loop = count($levels);
                         }elseif(count($users) < count($levels)) {
                            $loop = count($users);
                        }else{
                            $loop = count($levels);
                        }
                      $admincharges = Charge::all();
                      $TDMCharges = [];

                      foreach ($admincharges as $key => $value) {
                      $TDMCharges[$value->code] = $value['percentage'];
                      }
                      $user = Auth::user()->user_key;
                  for ($i=1; $i <=$loop; $i++) {

                              $earning = $amount*$levels[$i]/100;
                              $adminamount = $earning*$TDMCharges[1]/100; /*Admin Charge %*/
                              $TDS =  $earning*$TDMCharges[2]/100; /*TDS %*/
                              $deduction = $TDS+$adminamount;
                              $amount1 = $earning-$deduction;
                              $message = 'By Classified From user :'.$current_user.' in level: '. $i;

                           Log::info('Classified Level Income',[
                                  'user_key'=>$users[$i],
                                  'activity_id'=>session('activity_id'),
                                  'amount'=>$amount1,
                                  'percentage'=>$levels[$i],
                                  'business_area_id'=>$business_area_id,
                                  'earning'=>$earning,
                                  'tds'=>$TDS,
                                  'admin_charges'=>$adminamount,
                                  'type'=>'g',
                                  'message'=>$message,
                                  'status'=>0,
                                  'created_at'=>date('Y-m-d')
                              ]);



                              DB::table('payouts')->insert([
                                  'user_key'=>$users[$i],
                                  'activity_id'=>session('activity_id'),
                                  'amount'=>$amount1,
                                  'percentage'=>$levels[$i],
                                  'business_area_id'=>$business_area_id,
                                  'earning'=>$earning,
                                  'tds'=>$TDS,
                                  'admin_charges'=>$adminamount,
                                  'type'=>'g',
                                  'message'=>$message,
                                  'status'=>0,
                                  'earning_by'=>$current_user,
                                  'created_at'=>date('Y-m-d')
                              ]);
                              $user = $users[$i];

                      }
                     return true;
               }

 /****************************************************************************
    **********************Binary Generation Distribute Payment**************************
    *****************************************************************************/
    public function BinaryGenerationLevelPayment($user_key,$amount,$binaryLevel,$BA,$cuser_key)
    {
      if ($user_key) {
         $parent_key = DB::table('users')->where('user_key',$user_key)->select('sponsor_key','package_id')->first();
         $this->parent[] .=$user_key;
         //$this->parent .=',';
         $this->parent_key = $this->BinaryGenerationLevelPayment($parent_key->sponsor_key,$amount,$binaryLevel,$BA,$cuser_key);
    if (isset($parent_key->sponsor_key)) {
        $this->parent[] .= $parent_key->sponsor_key;
      }
      }else{

           unset($this->parent[0]);
          if (count($this->parent) > 0) {
             $this->binaryDistributePaymentMadePayment($this->parent,$amount,$binaryLevel,$BA,$cuser_key);
            }
      }
        $this->parent = [];
        $this->parent_key = [];
      return true;

  }

 public  function binaryDistributePaymentMadePayment($users,$amount,$levels,$business_area_id,$cuser_key){


                     Log::info('Binary Level',[$levels]);
                    if(count($users) > count($levels)){
                            $loop = count($levels);
                         }elseif(count($users) < count($levels)) {
                            $loop = count($users);
                        }else{
                            $loop = count($levels);
                        }
                      $admincharges = Charge::all();
                      $TDMCharges = [];
                      foreach ($admincharges as $key => $value) {
                      $TDMCharges[$value->code] = $value->percentage;
                      }

                        $userCount=1;
                  for ($i=1; $i <= $loop; $i++) {

                              $earning = $amount*$levels[$i-1]->percentage/100;
                              $adminamount = $earning*$TDMCharges[1]/100; /*Admin Charge %*/
                              $TDS =  $earning*$TDMCharges[2]/100; /*TDS %*/
                              $deduction = $TDS+$adminamount;
                              $amount1 = $earning-$deduction;
                              $message = 'Single Leg from user :'.$cuser_key.' in level: ' .$userCount. ' ';
                              DB::table('payouts')->insert([
                                  'user_key'=>$users[$userCount],
                                  'activity_id'=>session('activity_id'),
                                  'amount'=>$amount1,
                                  'percentage'=>$levels[$i-1]->percentage,
                                  'business_area_id'=>$business_area_id,
                                  'earning'=>$earning,
                                  'tds'=>$TDS,
                                  'admin_charges'=>$adminamount,
                                  'type'=>'g',
                                  'earning_by'=>$cuser_key,
                                  'message'=>$message,
                                  'status'=>0,
                                  'created_at'=>date('Y-m-d')
                              ]);

                        $userCount++;
                      }

                     return true;
               }




    /****************************************************************************
    **********************Classified Distribute Payment**************************
    *****************************************************************************/


  /****************************************************************************
    **********************Advertisment  Payment**************************
    *****************************************************************************/
    public function AdvertisementPayment($user_key,$adverLvel,$business_area_id,$amount,$adminCharges,$tds,$current_user)
    {
      if ($user_key) {

    $parent_key = DB::table('users')->where('user_key',$user_key)->select('parent_key','package_id')->first();

     $this->parent[] .=$user_key;
 //   $this->parent .=',';
    $this->parent_key = $this->AdvertisementPayment($parent_key->parent_key,$adverLvel,$business_area_id,$amount,$adminCharges,$tds,$current_user);
    if (isset($parent_key->parent_key)) {
    $this->parent[] .= $parent_key->parent_key;
    }

      }else{
           unset($this->parent[0]);
          if (count($this->parent) > 0) {
              $this->advertisementPaymentMadePayment($this->parent,$adverLvel,$business_area_id,$amount,$adminCharges,$tds,$current_user);
          }
      }
      return true;

  }
public  function advertisementPaymentMadePayment($users,$adverLvel,$business_area_id,$amount,$adminCharges,$tds,$current_user){
                        if(count($users) > count($adverLvel)){
                            $loop = count($adverLvel);
                            $loopFor = "Advertisment Count";
                         }elseif(count($users) < count($adverLvel)) {
                            $loopFor = "users Count";
                            $loop = count($users);
                        }else{
                            $loop = count($adverLvel);
                            $loopFor = "Advertisment Count 3rd loop";
                        }
                      Log::info('Advertisment Generation Payment Users',[$users]);
                      Log::info('Advertisment Generation Payment Users',[$loopFor]);
                      Log::info('Advertisment Level :',[$adverLvel]);
                      for ($i=1; $i <= $loop; $i++) {
                              $earning = $amount*$adverLvel[$i-1]->percentage/100;
                              $adminChargesAmount = $earning*$adminCharges/100;
                              $tdsAmount = $earning*$tds/100;
                              $deduction = $tdsAmount+$adminChargesAmount;
                              $amount_new =$earning-$deduction;
                              $message = 'By Campaign From user :'.$current_user.' in level: ' .$i. ' ';
                              DB::table('payouts')->insert([
                                  'user_key'=>$users[$i],
                                  'activity_id'=>session('activity_id'),
                                  'amount'=>$amount_new,
                                  'earning'=>$earning,
                                  'percentage'=>$adverLvel[$i-1]->percentage,
                                  'business_area_id'=>$business_area_id,
                                  'tds'=>$tdsAmount,
                                  'admin_charges'=>$adminChargesAmount,
                                  'type'=>'g',
                                  'earning_by'=>$current_user,
                                  'status'=>0,
                                  'message'=>$message,
                                  'created_at'=>date('Y-m-d')
                              ]);

                      }
                     return true;
               }



    /****************************************************************************
    **********************Advertisment Payment**************************
    *****************************************************************************/


  /****************************************************************************
    **********************Advertisment  Payment**************************
    *****************************************************************************/
public function getPayoutSevenGenerationLevel($id,$package_id,$user_key,$adminCharges,$tds)
    {
         Log::info('Model - DailyGenerationIncome',['User Key'=>$user_key]);
          if(is_array($id)){
                 $parents = User::whereIn('sponsor_key',$id)->whereIn('package_id',[1,2,3])->get();
          }else{
             $parents = User::whereIn('sponsor_key',array($id))->whereIn('package_id',[1,2,3])->get();
          }
          $users =  array();
          if ($parents->count()) {
            $level = $this->p++;
          foreach ($parents as $key => $value) {
                      $users[] =$value->user_key;
                    switch ($level) {
                      case 1:
                     
                   // $fdate= date('Y-m-d',strtotime($value->created_at));
                   // $tdate=now();
                   //  $to = \Carbon\Carbon::createFromFormat('Y-m-d', $fdate);
                   //  $from = \Carbon\Carbon::now();
                   //  $diff_in_days = $to->diffInDays($from);
                  $dataPay = GDC::payTEST($package_id,$level);
                      break;
                      case 2:
                     

                       $fdate= date('Y-m-d',strtotime($value->created_at));
                        $tdate=now();
                        $to = \Carbon\Carbon::createFromFormat('Y-m-d', $fdate);
                        $from = \Carbon\Carbon::now();
                        $diff_in_days = $to->diffInDays($from);
                  $dataPay = GDC::payTEST($package_id,$level,$diff_in_days);
                      break;
                      case 3:
                     

                   //    $fdate= date('Y-m-d',strtotime($value->created_at));
                   // $tdate=now();
                   //  $to = \Carbon\Carbon::createFromFormat('Y-m-d', $fdate);
                   //  $from = \Carbon\Carbon::now();
                   //  $diff_in_days = $to->diffInDays($from);
                  $dataPay = GDC::payTEST($package_id,$level);
                      break;
                      case 4:
                     

                   //    $fdate= date('Y-m-d',strtotime($value->created_at));
                   // $tdate=now();
                   //  $to = \Carbon\Carbon::createFromFormat('Y-m-d', $fdate);
                   //  $from = \Carbon\Carbon::now();
                   //  $diff_in_days = $to->diffInDays($from);
                  $dataPay = GDC::payTEST($package_id,$level);
                      break;
                      case 5:
                     

                   //    $fdate= date('Y-m-d',strtotime($value->created_at));
                   // $tdate=now();
                   //  $to = \Carbon\Carbon::createFromFormat('Y-m-d', $fdate);
                   //  $from = \Carbon\Carbon::now();
                   //  $diff_in_days = $to->diffInDays($from);
                  $dataPay = GDC::payTEST($package_id,$level);
                      break;
                      case 6:
                     

                   //    $fdate= date('Y-m-d',strtotime($value->created_at));
                   // $tdate=now();
                   //  $to = \Carbon\Carbon::createFromFormat('Y-m-d', $fdate);
                   //  $from = \Carbon\Carbon::now();
                   //  $diff_in_days = $to->diffInDays($from);
                  $dataPay = GDC::payTEST($package_id,$level);
                      break;
                      case 7:
                     

                   //    $fdate= date('Y-m-d',strtotime($value->created_at));
                   // $tdate=now();
                   //  $to = \Carbon\Carbon::createFromFormat('Y-m-d', $fdate);
                   //  $from = \Carbon\Carbon::now();
                   //  $diff_in_days = $to->diffInDays($from);
                  $dataPay = GDC::payTEST($package_id,$level);
                     break;
                  default:
                     $dataPay =  ['rs'=>0,"amount_new"=>0,'tdsAmount'=>0,'adminChargesAmount'=>0  ];

                  }
                
                  $resp = $this->DailyPaymentMadePayment($value->user_key);
                  if ($resp) {
                     $exist = Payout::where('user_key',$user_key)
                            ->where('business_area_id',13)
                            ->where('created_at',date('Y-m-d'))
                            ->where('type','l')
                            ->count();
                      $rs =  $dataPay['rs'];     
                      $amount_new =  $dataPay['amount_new'];     
                      $tdsAmount =  $dataPay['tdsAmount'];     
                      $adminChargesAmount =  $dataPay['adminChargesAmount'];     
                      $message = '7 Level income by '.$user_key;
                    if ($exist) {
                        Payout::where('created_at',date('Y-m-d'))->where('business_area_id',13)->where('user_key',$user_key)->where('type','l')->increment('amount',$amount_new);
                        Payout::where('created_at',date('Y-m-d'))->where('business_area_id',13)->where('user_key',$user_key)->where('type','l')->increment('earning',$rs);
                        Payout::where('created_at',date('Y-m-d'))->where('business_area_id',13)->where('user_key',$user_key)->where('type','l')->increment('tds',$tdsAmount);
                        Payout::where('created_at',date('Y-m-d'))->where('business_area_id',13)->where('user_key',$user_key)->where('type','l')->increment('admin_charges',$adminChargesAmount);
                    }else{
                          Payout::create([
                          'user_key'=>$user_key,
                          'activity_id'=>session('activity_id'),
                          'amount'=>$amount_new,
                          'percentage'=>$adminCharges+$tds,
                          'business_area_id'=> 13,
                          'earning'=>$rs,
                          'tds'=>$tdsAmount,
                          'message'=>$message,
                          'type'=>'l',
                          'earning_by'=>$user_key,
                          'txn_type'=>'c',
                          'admin_charges'=>$adminChargesAmount,
                          'status'=>0
                          ]);
                    }
                  }else{

                  }
              }
              $this->getPayoutSevenGenerationLevel($users,$package_id,$user_key,$adminCharges,$tds);
          }
          $this->p =1;
      Log::info('break ',['break'=>'breakbreakbreakbreakbreakbreakbreakbreak']);

    }



// *******************************Redmption***************************
// *******************************Redmption***************************
// *******************************Redmption***************************


  /****************************************************************************
    **********************Advertisment  Payment**************************
    *****************************************************************************/
public function payRedemption($id,$package_id,$user_key,$adminCharges,$tds,$date)
    {

                    switch ($package_id) {
                      case 1:/*Silver*/
                          $package =Package::select('pay_redemption')->where('id',$package_id)->first();
                          $rs =$package->pay_redemption;
                          break;
                      case 2:/*GOLD*/
                          $package=Package::select('pay_redemption')->where('id',$package_id)->first();
                          $rs =$package->pay_redemption;
                          break;
                      case 3:/*Dimond*/
                          $package =Package::select('pay_redemption')->where('id',$package_id)->first();
                          $rs =$package->pay_redemption;
                          break;
                      case 4:/*FREE*/
                          $package =Package::select('pay_redemption')->where('id',$package_id)->first();
                          $rs =$package->pay_redemption;
                          break;
                      case 5:/*Traning*/
                          $package =Package::select('pay_redemption')->where('id',$package_id)->first();
                          $rs =$package->pay_redemption;
                          break;
                      default:
                            $rs=0;
                  }

                      Log::info('Redmption Paymnt  ',['user_key'=>$user_key,'amount'=>$rs]);
                      $adminChargesAmount = $rs*$adminCharges/100;
                      $tdsAmount = $rs*$tds/100;
                      $deduction = $tdsAmount+$adminChargesAmount;
                      $amount_new =$rs-$deduction;
                      $message = 'Redmption income by '.$user_key;


                          Payout::create([
                          'user_key'=>$user_key,
                          'activity_id'=>session('activity_id'),
                          'amount'=>$amount_new,
                          'percentage'=>$adminCharges+$tds,
                          'business_area_id'=> 2,
                          'earning'=>$rs,
                          'tds'=>$tdsAmount,
                          'message'=>$message,
                          'type'=>'l',
                          'earning_by'=>$user_key,
                          'txn_type'=>'c',
                          'admin_charges'=>$adminChargesAmount,
                          'status'=>1,
                          'created_at'=>$date
                          ]);
    }


    public function payRedemptionDPC($id,$package_id,$user_key,$adminCharges,$tds)
    {

                    switch ($package_id) {
                      case 10:/*DPC-1*/
                          $rs =Package::select('pay_redemption')->where('id',$package_id)->first();
                          break;
                      case 11:/*DPC-2*/
                          $rs=Package::select('pay_redemption')->where('id',$package_id)->first();;
                          break;
                      default:
                            $rs=0;
                  }

                      Log::info('Redmption Paymnt  ',['user_key'=>$user_key,'amount'=>$rs]);
                      $adminChargesAmount = $rs*$adminCharges/100;
                      $tdsAmount = $rs*$tds/100;
                      $deduction = $tdsAmount+$adminChargesAmount;
                      $amount_new =$rs-$deduction;
                      $message = 'Redmption income by '.$user_key;


                          Payout::create([
                          'user_key'=>$user_key,
                          'activity_id'=>session('activity_id'),
                          'amount'=>$amount_new,
                          'percentage'=>$adminCharges+$tds,
                          'business_area_id'=> 2,
                          'earning'=>$rs,
                          'tds'=>$tdsAmount,
                          'message'=>$message,
                          'type'=>'l',
                          'earning_by'=>$user_key,
                          'txn_type'=>'c',
                          'admin_charges'=>$adminChargesAmount,
                          'status'=>1,
                          ]);
    }

     public function payRedemptionAPC($id,$package_id,$user_key,$adminCharges,$tds)
    {

                    switch ($package_id) {
                      case 12:/*DPC-1*/
                          $rs =Package::select('pay_redemption')->where('id',$package_id)->first();
                          break;
                      case 13:/*DPC-2*/
                          $rs=Package::select('pay_redemption')->where('id',$package_id)->first();;
                          break;
                      default:
                            $rs=0;
                  }

                      Log::info('Redmption Paymnt  ',['user_key'=>$user_key,'amount'=>$rs]);
                      $adminChargesAmount = $rs*$adminCharges/100;
                      $tdsAmount = $rs*$tds/100;
                      $deduction = $tdsAmount+$adminChargesAmount;
                      $amount_new =$rs-$deduction;
                      $message = 'Redmption income by '.$user_key;


                          Payout::create([
                          'user_key'=>$user_key,
                          'activity_id'=>session('activity_id'),
                          'amount'=>$amount_new,
                          'percentage'=>$adminCharges+$tds,
                          'business_area_id'=> 2,
                          'earning'=>$rs,
                          'tds'=>$tdsAmount,
                          'message'=>$message,
                          'type'=>'l',
                          'earning_by'=>$user_key,
                          'txn_type'=>'c',
                          'admin_charges'=>$adminChargesAmount,
                          'status'=>1,
                          ]);
    }






// *******************************Redmption***************************
// *******************************Redmption***************************
// *******************************Redmption***************************

    /****************************************************************************
    **********************Advertisment Payment**************************
    *****************************************************************************/




    public  function DailyPaymentMadePayment($user_id){
                          $user = User::where('user_key',$user_id)->first();
                          $date =  $user->created_at;
                          $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date);
                          $now = \Carbon\Carbon::now();
                          $diff_in_seconds = $to->diffInDays($now);
                          if ($diff_in_seconds > 750) {
                            return 0;
                              //Payment milana band
                          }else{
                              //Payment Milna chaiye
                            return 1;
                          }
               }



         public function madePayment($users,$amount,$percentage,$business_area_id,$user_key){
                      $parentArray = explode(',', rtrim($users,','));
                      $percentageAmount = $amount * $percentage / 100;
                      foreach ($parentArray as $key => $value)
                        {
                          $userBreak = explode('-', rtrim($value,','));
                          if ($userBreak[0])
                              {
                                if ($userBreak[1]== 4 || $userBreak[1]== 5)
                                {
                                    /*No Income */
                                }else{
                                       $user_id = Payout::create([
                                          'user_key'=>$userBreak[0],
                                          'activity_id'=>session('activity_id'),
                                          'amount'=>$percentageAmount,
                                          'percentage'=>$percentage,
                                          'business_area_id'=>$business_area_id,
                                          'created_at'=>date('Y-m-d'),
                                          'type'=>'g',
                                          'earning_by'=>$userBreak[0],
                                          'message'=>'madePayment',
                                          'status'=>0
                                      ]);
                                    }
                              }
                        }
                        return true;
        }
  }
