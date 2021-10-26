<?php

namespace App\Http\Controllers;

use Redis;
use Hash, Log;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
use App\DownPayment;
use App\DashboardImage;
use App\UserWinnersClub;
use App\Achievement;
use App\ClubUser;
use App\Charge;
use App\UserPointValue;
use App\Document;
use App\Tree;
use App\UserAchievement;
use App\Pin;
use App\AssignPin;
use App\Seminar;
use App\UserDocuments;
use App\UserBankDetail;
use App\UserBankDetailHistory;
use App\Payout;
use App\Package;
use App\PackageDescription;
use App\Notification;
use App\AssociateModule;
use App\UpgradeHistory;
use App\Country;
use App\State;
use App\City;

use App\Location;
use Validator;
use Paginate;
use Auth;
use File;
use Storage;
use DB;
use Session;
use Mail;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public $pid;
  public $parent =   array();
  public $user_data =   array();
  public $pleg = '';
  public $CPV = array();
  public $fuser = [];
  public $p = 1;
  public $pLevel = 1;
  public $pv = 0;
  public $user_data_left =   array();
  public $user_data_right =   array();
  public $pvLeft = 0;
  public $pvRight = 0;

  public function __construct()
  {
    $this->middleware('auth');
    $this->payouts = new Payout();
    $this->tree  = new Tree();
    $this->user  = new User();
    $this->associateModule  = new AssociateModule();
  }

  public function getUserName(Request $request)
  {
    $v = Validator::make($request->all(), [
      'user_name' => 'required|unique:users,user_name',
    ]);

    if ($v->fails()) {
        return 1;
    }else{
      return 0;
    }
  }
  public function myProfile()
  {

    $country = new Country;
        $countries = $country->getCountry();
    $cities =   DB::table('cities')->get();
    $states =   DB::table('states')->get();
    $packages =   Package::all();
    $addedBy =   $this->user->getAddedBy();
    return view('users.profile')
      ->with('countries', $countries)
      ->with('states', $states)
      ->with('addedBy', $addedBy)
      ->with('packages', $packages)
      ->with('cities', $cities);
  }
  public function invoice()
  {
    if (auth::user()->address1) {

      $PackageDescription =   PackageDescription::where('package_id', auth::user()->package_id)->first();

      return view('comman/invoice', compact('PackageDescription'));
    } else {
      session::flash("message", "Please update your address");

      return redirect('/member/profile');
    }
  }

  public function Printinvoice()
  {
    if (auth::user()->address1) {

      $PackageDescription =   PackageDescription::where('package_id', auth::user()->package_id)->first();

      return view('comman.printInvoice', compact('PackageDescription'));
    } else {
      session::flash("message", "Please update your address");

      return redirect('/member/profile');
    }
  }

  public function uploadSingedInvoice(Request $request)
  {
    $folderPath = 'assets/documents/';
    $newImageName = "";
    if ($request->hasFile('upload_invoice')) {
      $file = $request->file('upload_invoice');
      $newImageName = rand('111111', '999999') . $file->getClientOriginalName();
      $file->move($folderPath, $newImageName);
    }

    $user =   User::find(Auth::user()->id);
    $user->signed_invoice = 1;
    $user->signed_invoice_doc = $newImageName;
    $user->signed_invoice_upload_at = now();
    $user->save();
    session::flash("message", "Your document has been uploaded");
    return redirect()->back();
  }

  public function GetMyPackagePin($package_id)
  {
    $Corepins =   Pin::where('package_id', $package_id)->where('user_key', Auth::user()->user_key)->where('status', 1)->get()->Toarray();
    $pins = AssignPin::where('user_key', Auth::user()->user_key)->where('status', 1)->get();
    $avpin = [];
    foreach ($pins as $key => $pin) {
      $avpin[] = $pin->pin_id;
    }
    $Newpins =   Pin::wherenotin('status', [0])->where('package_id', $package_id)->wherein('id', $avpin)->get()->Toarray();
    if (count(array_merge($Corepins, $Newpins))) {
      echo    json_encode(array_merge($Corepins, $Newpins));
    } else {
      echo 0;
    }
  }



  public function welcomeLetter()
  {
    return view('comman.welcome-letter');
  }



  public function upgrade($value = '')
  {
    return view('user.upgrade');
  }
  public function upgradePackage(Request $request)
  {
    $v = Validator::make($request->all(), [
      'package_id' => 'required',
      'pin' => 'required',
    ]);

    if ($v->fails()) {
      return redirect()->back()->withErrors($v->errors());
    }
    $count =  Pin::where('package_id', $request->package_id)->where('pin_number', $request->pin)->where('status', 1)->count();
    if ($count) {
      session::flash('message', 'Package has been upgraded');
      Pin::where('package_id', $request->package_id)
        ->where('pin_number', $request->pin)
        ->update(['status' => 0]);
      $package = Package::find($request->package_id);
      $wallet = Auth::user()->wallet + $package->wallet;
      User::where('id', Auth::user()->id)
        ->update(
          ['package_id' => $request->package_id, 'wallet' => $wallet]
        );

      return redirect('/home');
    } else {
      session::flash('message', 'Invalid pin or used');
      return redirect()->back();
    }
  }


  public function upgradePackageHistory()
  {
    $UpgradeHistory = UpgradeHistory::where('user_key', Auth::user()->user_key)->get();
    return view('users/associatemodule/UpgradeHistory', compact('UpgradeHistory'));
  }
  public function updateAddress(Request $request)
  {
    $user =   User::find(Auth::user()->id);
    $user->address1 = $request->address1;
    $user->address2 = $request->address2;
    $user->address3 = $request->address3;
    $user->state = $request->state_id;
    $user->city = $request->city_id;
    $user->pincode = $request->pincode;
    $user->aadhaar_no = $request->aadhaar_no;
    $folderPath = 'assets/user/' . Auth::user()->id . '/documents';
    $adhaar_front = $adhaar_back = " ";
    if ($request->hasFile('adhaar_front')) {
      $file = $request->file('adhaar_front');
      $adhaar_front = rand() . $file->getClientOriginalName();
      $file->move($folderPath, $adhaar_front);
      $user->adhaar_front = $adhaar_front;
      $user->is_adhaar_verified = 1;
    }
    if ($request->hasFile('adhaar_back')) {
      $file = $request->file('adhaar_back');
      $adhaar_back = rand() . $file->getClientOriginalName();
      $file->move($folderPath, $adhaar_back);
      $user->adhaar_back = $adhaar_back;
      $user->is_adhaar_verified = 1;
    }

    $user->save();
    session::flash("message", "User Profile has been updated");
    return redirect()->back();
  }

  public function changeProfile_photo(Request $request)
  {

    /*Create Folder for Client */
    $folderPath = 'assets/user/' . Auth::user()->id . '/profile';
    if (!file_exists($folderPath)) {
      File::makeDirectory($folderPath, $mode = 0777, true, true);
    }
    if ($request->hasFile('profile_photo')) {
      $file = $request->file('profile_photo');
      $newImageName = rand() . time('i') . $file->getClientOriginalName();
      $file->move($folderPath, $newImageName);
    }

    User::where('id', Auth::user()->id)->update(['profile_photo' => $newImageName]);
    session::flash('message', 'Your profile photo has been changed');
    return redirect()->back();
  }
  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */

  public function getLeftRightCount($id, $leg)
  {

    $child =   User::where('parent_key', $id)->where('leg', $leg)->first();
    if (isset($child->id)) {
      $data =   DB::table('users')
        ->select(DB::raw('sum(point_value) as pv'))
        ->join('packages', 'packages.id', '=', 'users.package_id')
        ->whereBetween('_lft', [$child->_lft, $child->_rgt])
        ->first();
      if (isset($data->pv)) {
        return   array('pv' => $data->pv);
      } else {
        return   array('pv' => 0);
      }
    } else {

      return   array('pv' => 0);
    }
  }



  public function logic1($user_key, $current_user_pv, $current_leg, $i, $array, $TDMCharges, $count)
  {


    $fleftamount = $frightamount = $isPayment = $isLeftPayment =  0;
    $user_key = array('child_leg' => 0, 'user_key' => 176771);
    if ($user_key['child_leg']) {
      $p = 0;
      // User::where('user_key',$user_key['user_key'])->increment('balance_pv_right',$current_user_pv);
      $user =  User::where('user_key', $user_key['user_key'])->first();



      $max = 0.50;
      $min = 0.50;
      $totalPVRight = $user->balance_pv_right;
      $loopLeft = $user->balance_pv_left / $max;
      $loopRight = $totalPVRight / $min;

      if ($loopLeft < 1) {
        DB::table('user_point_values')->insert(
          [
            'user_key' => $user_key['user_key'],
            'blpv' => $user->balance_pv_left,
            'brpv' => $current_user_pv,
            'amount' => 0,
            'bpv' => $user->balance_pv_left . ':' . $user->balance_pv_right,
            'created_at' => date('Y-m-d')
          ]
        );
      }

      if ($loopRight > $loopLeft) {
        for ($i = 1; $i <= $loopLeft; $i++) {
          for ($l = 1; $l <= $loopRight - $l; $l++) {
            if ($i == $l) {
              echo "<br>";
              echo $i . "==" . $l;
              echo "<br>";

              $totalPVRightBalance = $loopRight - $l - $l;
              echo "<br>";
              $totalPVLEftBalance = $loopLeft - $i;
              echo 'loopLeft' . $loopLeft;
              echo "<br>";

              $totalPVRight1 = $totalPVRightBalance * $max;
              echo "Balance RIGHT PV" . $totalPVRight1;
              echo "<br>";

              $totalPVLeft1 = $totalPVLEftBalance * $max;
              echo "Balance LEFT PV" . $totalPVLeft1;
              echo "<br>";



              $p++;
              $isPayment = 1;
              $amount  = 300;
              $totalPVRight1 = $totalPVRightBalance * $min;
              $totalPVLeft1 = $totalPVLEftBalance * $max;
              $frightamount += $amount;
            }
          }
        }
      } else {
        for ($i = 1; $i <= $loopLeft - $i; $i++) {
          for ($l = 1; $l <= $loopRight; $l++) {
            if ($i == $l) {
              echo "<br>";
              echo $i . "==" . $l;
              echo "<br>";

              $totalPVRightBalance = $loopRight - $l;
              echo "<br>";
              $totalPVLEftBalance = $loopLeft - $i - $i;
              echo 'loopLeft' . $loopLeft;
              echo "<br>";

              $totalPVRight1 = $totalPVRightBalance * $max;
              echo "Balance RIGHT PV" . $totalPVRight1;
              echo "<br>";

              $totalPVLeft1 = $totalPVLEftBalance * $max;
              echo "Balance LEFT PV" . $totalPVLeft1;
              echo "<br>";



              $p++;
              $isPayment = 1;
              $amount  = 300;
              $totalPVRight1 = $totalPVRightBalance * $min;
              $totalPVLeft1 = $totalPVLEftBalance * $max;
              $frightamount += $amount;
            }
          }
        }
      }





      if ($isPayment) {
        echo "<br>";
        echo   $totalPVRightBalance;
        echo "<br>";
        echo "<br>";
        echo   $totalPVRightBalance;
        echo "<br>";
        echo "<br>";
        echo   $totalPVRightBalance;
        echo "<br>";
        echo "<br>";
        echo   $totalPVRight1;
        echo "<br>";
        echo "<br>";
        echo   $totalPVLeft1;
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo   $frightamount;
        echo "<br>";
        echo "<br>";
        dd("ASd");

        //             $this->logic21payment($totalPVRight1,$totalPVLeft1,0,$current_user_pv,$frightamount,$user_key['user_key'],$TDMCharges);
      }
    } else {
      $p = 0;
      //User::where('user_key',$user_key['user_key'])->increment('balance_pv_left',$current_user_pv);
      $user =  User::where('user_key', $user_key['user_key'])->first();
      $max = 0.50;
      $min = 0.50;
      $loopRight = $user->balance_pv_right / $min;
      $totalPVLeft = $user->balance_pv_left;

      if ($loopRight < 1) {
        Log::info('left insertion', ['loopRight' => $user->balance_pv_right, 'user_key' => $user_key['user_key'], 'current_user_pv' => $current_user_pv]);
        DB::table('user_point_values')->insert(
          [
            'user_key' => $user_key['user_key'],
            'blpv' => $current_user_pv,
            'brpv' => $user->balance_pv_right,
            'amount' => 0,
            'bpv' => $user->balance_pv_left . ':' . $user->balance_pv_right,
            'created_at' => date('Y-m-d')
          ]
        );
      }

      $loopLeft = $totalPVLeft / $min;
      if ($loopLeft > $loopRight) {
        for ($i = 1; $i <= $loopRight; $i++) {
          for ($l = 1; $l <= $loopLeft - $i; $l++) {
            if ($i == $l) {
              $userPaytype =   User::where('user_key', $user_key['user_key'])->first();
              echo "<br>";
              echo $i . "==" . $l;
              echo "<br>";
              $isLeftPayment = 1;
              $amount  =  300;




              $totalPVRightBalance = $loopRight - $i;
              $totalPVLEftBalance = $loopLeft - $l - $l;
              $newtotalPVRight = $totalPVRightBalance * $min;
              $newtotalPVLeft = $totalPVLEftBalance * $min;
              $fleftamount += $amount;
            }
          }
        }
      } else {
        for ($i = 1; $i <= $loopRight - $i; $i++) {
          $loopLeft = $totalPVLeft / $min;
          for ($l = 1; $l <= $loopLeft; $l++) {
            if ($i == $l) {
              $userPaytype =   User::where('user_key', $user_key['user_key'])->first();
              echo "<br>";
              echo $i . "==" . $l;
              echo "<br>";
              $isLeftPayment = 1;
              $amount  =  300;




              $totalPVRightBalance = $loopRight - $i - $i;
              $totalPVLEftBalance = $loopLeft - $l;
              $newtotalPVRight = $totalPVRightBalance * $min;
              $newtotalPVLeft = $totalPVLEftBalance * $min;
              $fleftamount += $amount;
            }
          }
        }
      }

      if ($isLeftPayment) {
        echo "<br>";
        echo  'totalPVRightBalance' . $totalPVRightBalance;
        echo "<br>";
        echo "<br>";
        echo  'totalPVLEftBalance' . $totalPVLEftBalance;
        echo "<br>";
        echo "<br>";
        echo  'newtotalPVRight' . $newtotalPVRight;
        echo "<br>";
        echo "<br>";
        echo  'newtotalPVLeft' . $newtotalPVLeft;
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo   $fleftamount;
        echo "<br>";
        echo "<br>";
        dd("Left");
        # code...
        //          $this->logic21payment($newtotalPVRight,$newtotalPVLeft,$current_user_pv,0,$fleftamount,$user_key['user_key'],$TDMCharges);
      }
    }
  }
  public function findF()
  {
    $date = "2020-03-14";
    $nextTuesday = date('Y-m-d', strtotime($date . 'next friday'));
    $weekNo = date('W');
    print_r(date('Y-m-d', strtotime($nextTuesday . ' + 7 days')));
    dd();
  }
  public function check($user_key)
  {
    $user = new User();
    $response =  $user->mySelfSponsor($user_key);
    if (count($response) === 2) {
      return true;
    } else {
      return false;
    }
  }

  public function getBadge($user_key, $user, $TDMCharges)
  {
    //Log::info('GET BADGE CAll -1',['user_key'=>$user_key,'user->balance_pv_left'=>$user->balance_pv_left,'user->balance_pv_right'=>$user->balance_pv_right]);
    $data = UserPointValue::select(DB::raw('SUM(blpv) as Total_blpv'), DB::raw('SUM(brpv) as Total_brpv'))->where('user_key', $user_key)->groupby('user_key')->first();
    Log::info('GET BADGE DATA', ['PV' => $data, 'user' => $user, 'user_key' => $user_key]);

    if ($data->Total_blpv >= 10000000 || $data->Total_brpv >= 10000000) {
      $UserAchievementsData = [];
      //Log::info('GET BADGE -2',['user_key'=>$user_key,'user->balance_pv_left'=>$user->balance_pv_left,'user->balance_pv_right'=>$user->balance_pv_left]);

      // User ka abhi ka balankce PV left jo user table me he. wo User Point table me JO BRPV ka some is month ka dono  yadi is IF conistion ke barbar  ya usse jada he to ye chaleha
      //Log::info('GET BADGE  IF',['user_key'=>$user_key,'balance_pv_left'=>$user->balance_pv_left]);
      if ($data->Total_blpv >= 10000000 && $data->Total_brpv >= 10000000) {
        $UserAchievementsData[] = 1;
      }
      if ($data->Total_blpv >= 35000000 && $data->Total_brpv >= 35000000) {
        $UserAchievementsData[] = 2;
      }
      if ($data->Total_blpv >= 85000000 && $data->Total_brpv >= 85000000) {
        $UserAchievementsData[] = 3;
      }
      if ($data->Total_blpv >= 185000000 && $data->Total_brpv >= 185000000) {
        $UserAchievementsData[] = 4;
      }
      if ($data->Total_blpv >= 385000000 && $data->Total_brpv >= 385000000) {
        $UserAchievementsData[] = 5;
      }
      if ($data->Total_blpv >= 885000000 && $data->Total_brpv >= 885000000) {
        $UserAchievementsData[] = 6;
      }


      for ($i = 1; $i <= count($UserAchievementsData); $i++) {
        if ($UserAchievementsData[$i - 1] > $user->achievement_id) {
          $achievement = Achievement::find($UserAchievementsData[$i - 1]);
          $message = "Income from achievement of Level. " . $achievement->name;
          Payout::pay($user->user_key, $achievement->percentage, $TDMCharges[1], $TDMCharges[2], $TDMCharges[4], $achievement->business_area_id, $status = 0, $message, $user_type_id = 1);
          UserAchievement::updateorcreate(['user_key' => $user_key, 'achievement_id' => $UserAchievementsData[$i - 1]], ['user_key' => $user_key, 'achievement_id' => $UserAchievementsData[$i - 1], 'achievement_date' => now()]);
        } else {
          UserAchievement::updateorcreate(['user_key' => $user_key, 'achievement_id' => $UserAchievementsData[$i - 1]], ['user_key' => $user_key, 'achievement_id' => $UserAchievementsData[$i - 1], 'achievement_date' => now()]);
        }
      }
    }
  }


  public function index()
  {
    //dd($this->getUserFYpayment(419848));

    //$this->remake();
    //die();

    //                          // 0 = admin Charges,1=TDS,2= Binary,3=Direct Income,4=PST
    //                          $TDMCharges = [$charges[0]->percentage,$charges[1]->percentage,$charges[2]->percentage,$charges[3]->percentage];

    // dd($this->getBadge(auth::user()->user_key,auth::user(),$TDMCharges));
    //      dd($this->check(392717));
    //      $this->logic1($user_key=176771,$current_user_pv=2,$current_leg=0,$i=1,$array=1,$TDMCharges=1,$count=1);
    $packages =  Package::where('status',1)->get();
    $directs = User::where('sponsor_key', Auth::user()->user_key)->count();
    $Revenue = $this->user->Revenue();
    $DashboardImage = DashboardImage::where('is_dashboard', 1)->where('status', 1)->orderby('updated_at', 'DESC')->first();
    $TotalRevenue = $this->user->TotalRevenue();
    $generated = $this->user->generated();
    $Sponsor = $this->user->Sponsor();
    $LevelIncome = $this->user->LevelIncome();
    $PropertySaving = $this->user->PropertySaving();
    $ActivePin = $this->user->ActivePin();
    $payment_received = $this->user->paymentReceived();
    // $reference_Total = $this->user->referenceTotal();
    // $followUp_Total = $this->user->followUpTotal();
    // $seminar_Total = $this->user->SeminarTotal();
    // $visit_Total = $this->user->visitTotal();
    $total_downpayment_amount = 0;
    if (isset(auth::user()->package->amount)) {

      if (auth::user()->package->package_type_id == 3) {
        $total_downpayment =  DownPayment::Where('user_key', auth::user()->user_key)
          ->select([DB::raw("SUM(amount) as total")])
          ->groupBy('user_key')
          ->first();
        if ($total_downpayment != null) {
          if ($total_downpayment->total) {
            $total_downpayment_amount += $total_downpayment->total;
          }
        }
      }
    }
    if (!auth::user()->bankDetails) {
      session::flash("message", "Please Update your Bank Details, otherwise your payment can not be tranfer");
    }
    return view('users/dashboard', compact('packages','directs', 'Revenue', 'generated', 'Sponsor', 'LevelIncome', 'ActivePin', 'payment_received', 'total_downpayment_amount', 'PropertySaving', 'TotalRevenue', 'DashboardImage'));
  }


  public function remake()
  {


    $user = $this->associateModule->UpdateNew();
  }


  public function logic111111($user_key, $current_user_pv, $current_leg, $i, $array, $TDMCharges, $count)
  {
    $fleftamount = $frightamount = $isPayment = $isLeftPayment =  0;

    if ($user_key['child_leg']) {
      $p = 0;
      User::where('user_key', $user_key['user_key'])->increment('balance_pv_right', $current_user_pv);
      $user =  User::where('user_key', $user_key['user_key'])->first();
      $loopLeft = $user->balance_pv_left;
      $loopRight = $user->balance_pv_right;


      if ($loopLeft == 0) {
        Log::info('Log-1', ['loopLeft' => $loopLeft, 'user_key' => $user_key['user_key']]);
        DB::table('user_point_values')->insert(
          [
            'user_key' => $user_key['user_key'],
            'blpv' => $user->balance_pv_left,
            'brpv' => $current_user_pv,
            'amount' => 0,
            'bpv' => $user->balance_pv_left . ':' . $user->balance_pv_right,
            'created_at' => date('Y-m-d')
          ]
        );
      } else {

        if ($loopLeft >= $loopRight) {

          for ($i = 1; $i <= $loopLeft; $i++) {

            for ($l = 1; $l <= $loopRight; $l++) {
              if ($i / 2 == $l / 1) {
                $userPaytype =   User::where('user_key', $user_key['user_key'])->first();
                $isPayment = 1;
                $amount  =  300;
                $totalPVRightBalance = $loopRight - $l;
                $totalPVLEftBalance = $loopLeft - $i;
                $totalPVRight1 = $totalPVRightBalance;
                $totalPVLeft1 = $totalPVLEftBalance;
                $frightamount += $amount;
              }
            }
          }
        } else {
          for ($i = 1; $i <= $loopRight; $i++) {
            for ($l = 1; $l <= $loopLeft; $l++) {
              if ($i / 2 == $l / 1) {
                Log::info('Log-2', ['loopLeft' => $loopLeft, 'loopRight' => $loopRight, 'user_key' => $user_key['user_key']]);
                $userPaytype =   User::where('user_key', $user_key['user_key'])->first();
                $isPayment = 1;
                $amount  =  300;
                $totalPVRightBalance = $loopRight - $i;
                $totalPVLEftBalance = $loopLeft - $l;
                $totalPVRight1 = $totalPVRightBalance;
                $totalPVLeft1 = $totalPVLEftBalance;
                $frightamount += $amount;
              }
            }
          }
        }


        if ($isPayment) {
          $this->logic21payment($totalPVRight1, $totalPVLeft1, 0, $current_user_pv, $frightamount, $user_key['user_key'], $TDMCharges);
        }
      }
    } else {
      $p = 0;
      //   User::where('user_key',$user_key['user_key'])->increment('balance_pv_left',$current_user_pv);
      $user =  User::where('user_key', $user_key['user_key'])->first();
      $loopRight = $user->balance_pv_right;
      $loopLeft = $user->balance_pv_left;

      if ($loopRight < 1) {
        Log::info('left insertion', ['loopRight' => $user->balance_pv_right, 'user_key' => $user_key['user_key'], 'current_user_pv' => $current_user_pv]);
        DB::table('user_point_values')->insert(
          [
            'user_key' => $user_key['user_key'],
            'blpv' => $current_user_pv,
            'brpv' => $user->balance_pv_right,
            'amount' => 0,
            'bpv' => $user->balance_pv_left . ':' . $user->balance_pv_right,
            'created_at' => date('Y-m-d')
          ]
        );
      } else {

        if ($loopRight >= $loopLeft) {

          for ($i = 1; $i <= $loopRight; $i++) {
            for ($l = 1; $l <= $loopLeft; $l++) {
              if ($i / 2 == $l / 1) {
                $userPaytype =   User::where('user_key', $user_key['user_key'])->first();
                $isPayment = 1;
                $amount  =  300;
                $totalPVRightBalance = $loopRight - $i;
                $totalPVLEftBalance = $loopLeft - $l;
                $totalPVRight1 = $totalPVRightBalance;
                $totalPVLeft1 = $totalPVLEftBalance;
                $frightamount += $amount;
              }
            }
          }
        } else {
          for ($i = 1; $i <= $loopLeft; $i++) {
            for ($l = 1; $l <= $loopRight; $l++) {
              echo $i . '<-i and l ->' . $l;

              if ($i / 2 == $l / 1) {
                echo "You";
                dd("ASd");
                $userPaytype =   User::where('user_key', $user_key['user_key'])->first();
                $isPayment = 1;
                $amount  =  300;
                $totalPVRightBalance = $loopRight - $l;
                $totalPVLEftBalance = $loopLeft - $i;
                $totalPVRight1 = $totalPVRightBalance;
                $totalPVLeft1 = $totalPVLEftBalance;
                $frightamount += $amount;
              }
            }
          }
        }
      }


      if ($isPayment) {
        # code...
        $this->logic21payment($newtotalPVRight, $newtotalPVLeft, $current_user_pv, 0, $fleftamount, $user_key['user_key'], $TDMCharges);
      }
    }
  }

  public function user_message()
  {
    return view('users.message');
  }



  public function congretsForEarnig($user_key)
  {
    $title = "Congratulation For the Achivment";
    $message = Auth::user()->name . 'has congrates you for the achivement';
    $type = "Top Earners";
    Notification::send($user_key, Auth::user()->user_key, $type, $title, $message);
    session::flash('message', 'You have succfully congrates');
    return redirect()->back();
  }


  public function admanagement()
  {
    $users =  User::all();
    return view('admin.admanagement')->with('users', $users);
  }

  public function userDocumentsDownload($user_id, $document_id)
  {
    $document =  DB::table('user_documents')->where('user_id', $user_id)->where('document_id', $document_id)->first();

    $file = 'assets/user/' . Auth::user()->id . '/documents/' . $document->attachment_temp . '';
    return response()->download($file);
  }

  public function application()
  {
    $users =  User::all();
    return view('admin.application')->with('users', $users);
  }


  public function getRightCountPackageWise($id, $leg, $package_id)
  {

    if (is_array($id)) {
      $parents = User::whereIn('parent_key', $id)->where('package_id', $package_id)->get();
    } else {
      $array = array($id);
      $parents = User::whereIn('parent_key', $array)->where('leg', $leg)->where('package_id', $package_id)->get();
    }

    if ($parents->count()) {
      $users_data_right = [];
      foreach ($parents as $key => $value) {
        $users_data_right[] =  $value->user_key;
        $this->user_data_right[] =  $value->user_key;
        $this->pvRight +=  $value->package->point_value;
      }
      $this->getRightCountPackageWise($users_data_right, $leg, $package_id);
    }

    return  array('users' => count($this->user_data_right), 'pv' => $this->pvRight);
  }


  public function getLeftRightCountPackageWise($package_id, $leg)
  {

    $child =   User::where('parent_key', auth::user()->user_key)->where('leg', $leg)->first();

    if (isset($child->id)) {

      $data =   DB::table('users')
        ->select(DB::raw('sum(point_value) as pv'), DB::raw('count(user_key) as count'))
        ->join('packages', 'packages.id', '=', 'users.package_id')
        ->where('users.package_id', $package_id)
        ->whereBetween('_lft', [$child->_lft, $child->_rgt])
        ->first();
      if (isset($data->pv)) {
        return   array('pv' => $data->pv, 'count' => $data->count);
      } else {
        return   array('pv' => 0, 'count' => 0);
      }
    } else {
      return   array('pv' => 0, 'count' => 0);
    }
  }

  public function getLeftRightCountPackageWiseDirect($package_id, $leg)
  {

    $child =   User::where('parent_key', auth::user()->user_key)->where('leg', $leg)->first();
    if (isset($child->id)) {
      $data =   DB::table('users')
        ->select(DB::raw('sum(point_value) as pv'), DB::raw('count(user_key) as count'))
        ->join('packages', 'packages.id', '=', 'users.package_id')
        ->where('users.package_id', $package_id)
        ->where('sponsor_key', auth::user()->user_key)
        ->whereBetween('_lft', [$child->_lft, $child->_rgt])
        ->first();
      if (isset($data->pv)) {
        return   array('pv' => $data->pv, 'count' => $data->count);
      } else {
        return   array('pv' => 0, 'count' => 0);
      }
    } else {
      return   array('pv' => 0, 'count' => 0);
    }
  }


  public function referal()
  {
    $packages =  Package::wherein('id', [1, 2, 3, 4, 5])->orderby('order', 'ASC')->get();

    foreach ($packages as $key => $package) {

      $left  =  $this->getLeftRightCountPackageWise($package->id, 0);
      $right =  $this->getLeftRightCountPackageWise($package->id, 1);
      $sumCount  = $left['count'] + $right['count'];
      $sumPV  = $left['pv'] + $right['pv'];
      $package->total =  array('team' => $sumCount, 'totalPV' => $sumPV);
      $package->left  =  $left;
      $package->right  = $right;


      $leftDirect  =  $this->getLeftRightCountPackageWiseDirect($package->id, 0);
      $rightDirect =  $this->getLeftRightCountPackageWiseDirect($package->id, 1);
      $sumCountDirect  = $leftDirect['count'] + $rightDirect['count'];
      $sumPVDirect  = $leftDirect['pv'] + $rightDirect['pv'];
      $package->totalDirect =  array('team' => $sumCountDirect, 'totalPV' => $sumPVDirect);
      $package->leftDirect  =  $leftDirect;
      $package->rightDirect  = $rightDirect;
    }



    return view('users.referal')->with('teamPackage', $packages);
  }

  public function getGenerationLevel($id, $level, $package_id)
  {
    $totlaDownLine = [];
    $downlines = $this->getLevel($id, $level, $package_id);

    return count($downlines);
  }

  public function getLevel($id, $cl, $package_id)
  {

    if (is_array($id)) {
      $parents = DB::table('users')->whereIn('sponsor_key', $id)->where('package_id', $package_id)->get();
    } else {
      $array = array($id);
      $parents = DB::table('users')->whereIn('sponsor_key', $array)->where('package_id', $package_id)->get();
    }
    $users =  array();
    $usersF =  array();
    if ($parents->count()) {
      $level = $this->pLevel++;
      foreach ($parents as $key => $value) {
        if ($level == $cl) {
          $users[] = $value->user_key;
          $this->user_in_downline[] =  array('level_user_id' => $value->user_key, 'level' => $level);
        }
        /* $resid =  DB::table('GL')->insert(['user_key'=>Auth::user()->user_key,'level_user_id'=>$value->user_id, 'level'=>$level]);*/
      }
      $this->getLevel($users, $cl, $package_id);
    }
    $this->fuser = $users;
    return $this->fuser;
  }

  public function wallet()
  {
    $users =  User::all();
    return view('admin.wallet')->with('users', $users);
  }

  public function generalDetails(Request $request)
  {

    $validator = Validator::make($request->all(), [
      'mobile' => 'required',
      'occupation' => 'required',
      'dob' => 'required',
      'panno' =>
      array(
        'required',
        'regex:/[a-zA-z]{5}\d{4}[a-zA-Z]{1}/'
      ),
    ]);

    if ($validator->fails()) {
      return redirect()->back()
        ->withErrors($validator)
        ->withInput();
    }

    $folderPath = 'assets/user/' . Auth::user()->id . '/documents';
    $pan_documents = " ";



    $user = User::find(Auth::user()->id);
    $user->name    = $request->name;
    $user->mobile    = $request->mobile;
    $user->email    = $request->email;
    $user->occupation = $request->occupation;
    $user->pan = $request->panno;
    $user->dob = $request->dob;
    /*If User upload Pan */
    if ($request->hasFile('pan_documents')) {
      $file = $request->file('pan_documents');
      $pan_documents = rand() . $file->getClientOriginalName();
      $file->move($folderPath, $pan_documents);
      $user->pan_document = $pan_documents;
      $user->is_pan_verified = 1;
    }
    /*If User upload Pan */
    $user->save();
    session::flash("message", "Profile has been updated");
    return redirect()->back();
  }
  public function bankDetails(Request $request)
  {

    $folderPath = 'assets/user/' . Auth::user()->id . '/documents';
    $kyc_document = '';
    $is_kyc_document = 0;
    if ($request->hasFile('kyc_document')) {
      $is_kyc_document = 1;
      $file = $request->file('kyc_document');
      $kyc_document = auth::user()->user_key . '-' . rand() . $file->getClientOriginalName();
      $file->move($folderPath, $kyc_document);
    }


    $user =   UserBankDetail::where('user_key', Auth::user()->user_key)->first();
    if (!empty($user)) {

      $UserBankDetail = UserBankDetail::find(Auth::user()->bankDetails->id);
      UserBankDetailHistory::create([
        'user_key' => Auth::user()->user_key,
        'account_no' => $UserBankDetail->account_no,
        'account_no' => $UserBankDetail->account_no,
        'name' => $UserBankDetail->name,
        'branch' => $UserBankDetail->branch,
        'ifsc' => $UserBankDetail->ifsc,
        'city' => $UserBankDetail->city,
        'kyc_document' => $UserBankDetail->kyc_document,
      ]);
      $UserBankDetail->account_no         =     $request->account_no;
      $UserBankDetail->name         =     $request->name;
      $UserBankDetail->branch         =     $request->branch;
      $UserBankDetail->ifsc         =     $request->ifsc;
      $UserBankDetail->city         =     $request->city;
      $user = User::find(Auth::user()->id);
      if ($request->hasFile('kyc_document')) {
        $UserBankDetail->kyc_document            = $kyc_document;
        $user->is_kyc_document = 1;
        $user->is_bank_details_update = 1;
      }
      $UserBankDetail->save();
      $user->is_bank_details_update = 1;
      $user->bank_kyc_status = 1;
      $user->save();
    } else {


      UserBankDetail::create([
        'user_key' => Auth::user()->user_key,
        'account_no' => $request->account_no,
        'name' => $request->name,
        'branch' => $request->branch,
        'ifsc' => $request->ifsc,
        'kyc_document' => $kyc_document,
        'city' => $request->city,
      ]);
      $user = User::find(Auth::user()->id);
      if ($request->hasFile('kyc_document')) {
        $user->is_kyc_document = 1;
      }
      $user->is_bank_details_update = 1;
      $user->bank_kyc_status = 1;
      $user->save();
    }
    session::flash("message", "Profile has been updated");
    return redirect()->back();
  }
  public function address(Request $request)
  {
    # code...
  }
  public function updatePassword(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'password' => 'required|string|min:6|confirmed'
    ]);

    if ($validator->fails()) {
      return redirect('/member/profile')
        ->withErrors($validator)
        ->withInput();
    }
    $user =   User::find(auth::user()->id);
    $user->password = Hash::make($request->password);
    $user->admin_password = $request->password;
    $user->save();
    session::flash("message", "Password has been updated");
    return redirect()->back();
  }

  public function transactionUpdate(Request $request)
  {
    $user =  User::find(Auth::user()->id);
    if ($request->new) {
      $user->transaction_password = $request->new;
      $user->save();
      session::flash('message', 'Transaction password has been updated');
    } else {
      session::flash('message', 'There is no  change');
    }

    return redirect()->back();
  }



  public function LeadsList()
  {

    $digital_Total = $this->user->digitalTotal();
    $followUp_Total = $this->user->followUpTotal();
    $seminar_Total = $this->user->SeminarTotal();
    $visit_Total = $this->user->visitTotal();
    return view('users/LeadDashboard', compact('digital_Total', 'followUp_Total', 'visit_Total', 'seminar_Total'));
  }
}