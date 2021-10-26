<?php
namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\User;
use App\UserPointValue;
use App\Charge;
use App\Http\Services\UserService;
use App\Http\Services\UserBonusClubService;
use App\Pin;
use App\AssignPin;
use App\Package;
use App\UpgradePackage;
use App\Activity;
use App\PinRequest;
use App\UserMonthlySalary;
use App\Achievement;
use App\UpgradeHistory;
use App\UserBankDetail;
use App\AssociateModule;
use App\UserWinnersClub;
use App\UserAchievement;
use App\GenerationIncome;
use App\WinnersClub;
use App\Payment;
use App\Payout;
use App\Country;
use App\State;
use App\City;
use Carbon\Carbon;
use DB, Auth, Session, Validator, Log, File;

class AssociateModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $user_data = array();
    public $user_data_left = array();
    public $user_data_right = array();
    public $pvLeft = 0;
    public $pvRight = 0;
    public $parent = array();
    public $user_in_downline = array();
    public $pid;
    public $pleg = '';
    public $user_keys =   array();
    public $p = 1;

    protected $UserService;
    protected $UserBonusClubService;
    public function __construct(UserService $UserService, UserBonusClubService $UserBonusClubService)
    {
        $this->middleware('auth');
        $this->user = new User();
        $this->userService = $UserService;
        $this->UserBonusClubService = $UserBonusClubService;
        $this->associateModule = new AssociateModule();
        $this->UpgradePackage = new UpgradePackage();
    }
    public function index()
    {
        return redirect('/member/direct');
    }
    public function getAllUsersPan()
    {
        return view('users.payout.dashboard');
    }

    public function invoicepending()
    {
        return view('users.associatemodule.invoicepending');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function topuppending()
    {
        return view('users.associatemodule.topuppending');
    }




    public function topUp(Request $request)
    {
        $v = Validator::make($request->all(), ['package_id' => 'required', 'pin' => 'required',]);
        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors());
        }

        if ($request->user_key) {
          $user =  User::where('user_key',$request->user_key)->first();
          // dd($user);
          if(isset($user->id)){

          }else{
            session::flash("message","Please re check the entered User key is invalid or already active");
            return redirect()->back();
          }
      
    }else{
          $user =   Auth::user();

    }


        $count = Pin::where('package_id', $request->package_id)->where('pin_number', $request->pin)->wherein('status', [1, 2])->count();
        if ($count) {
            $charges = Charge::all();
            // 0 = admin Charges,1=TDS,2= Binary,3=Direct Income,4=PST
            //$TDMCharges = [$charges[0]->percentage,$charges[1]->percentage,$charges[2]->percentage,$charges[3]->percentage];
            $package = Package::find($request->package_id);
            $pin = Pin::where('pin_number', $request->pin)->first();
            $pin->status = 0;
            $pin->save();

            $pinAssingn = AssignPin::where('pin_id', $pin->id)->first();

            $pinAssingn->status = 0;
            $pinAssingn->save();
            
            $user = $user;
            if ($user->package_id == 0) {
                $user->package_id = $request->package_id;
            }

            $user->package_activate_date = now();
            $user->is_eligible = 1;
            $user->package_id = $request->package_id;
            $user->package_type_id = $package->package_type_id;
            $user->save();
            $package = Package::find($request->package_id);
            //$direct_income = $package->direct_income;
            /**********************User ko Direct PayOut******************************
             ******************************************************************/
            $upgradePackageHistory = UpgradeHistory::create([
                'user_id' => $user->id,
                'user_key' => $user->user_key,
                'package_id' => $request->package_id,
                'package_type_id' => $package->package_type_id,
                'status' => 1,
            ]);
            /**********************User ko Direct PayOut******************************
            
             ******************************************************************/
            //$earning = $user->package->amount * $user->package->direct_income / 100;
            //$message = "Sponsor Income from user  " . $user->user_key;
            //Payout::pay($user->sponsor_key, $earning, 2, $status = 0, $message, $user_type_id = 1);
            // $earning = $user->package->amount*$user->package->direct_income/100;
            //              $message = "Broker Bonus Income from user  ".$user->user_key;
            //             Payout::pay($user->sponsor_key,$earning,$TDMCharges[0]->percentage,$TDMCharges[1]->percentage,2,$status=0,$message,$user_type_id=1);
            /*PV Add*/
            //Activity::lock($message, $user->user_key, 1, 0);

            $levelLimit = $user->package->levelLimit;
            $GenerationIncome = new GenerationIncome();
            //$GenerationIncome->DirectLevelWise($user->user_key, $levelLimit, 3, $earning, 0, 0, $user->user_key);

            $GenerationIncome->generationPayment($user->user_key);
            session::flash("message", "Status has been changed, your package has been upgraded");
            return redirect()->back();
        } else {
            session::flash('message', 'Invalid pin or used');
            return redirect()->back();
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function direct()
    {

        $directs = User::where('sponsor_key', Auth::user()->user_key)->get();
        //dd($directs);
        return view('users/associatemodule/direct')->with('directs', $directs);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function level()
    {
        $directs = User::where('sponsor_key', Auth::user()->user_key)->get();
        return view('admin/tree/generationLevel')->with('directs', $directs);
    }
    public function upgrade()
    {
        $PinRequests = PinRequest::where('user_key', auth::user()->user_key)->where('status', 1)->get();
        return view('users/associatemodule/upgrade', compact('PinRequests'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getLeftCount($id, $leg)
    {
        if (is_array($id)) {
            $parents = User::whereIn('parent_key', $id)->get();
        } else {
            $array = array($id);
            $parents = User::whereIn('parent_key', $array)->where('leg', $leg)->get();
        }
        if ($parents->count()) {
            $users_data_left = [];
            foreach ($parents as $key => $value) {
                $users_data_left[] = $value->user_key;
                $city_name = 'NA';
                if (isset($value->city_name->name)) {
                    $city_name = $value->city_name->name;
                }
                $packagename = "Yet to update";
                if (isset($value->package->name)) {
                    $packagename = $value->package->name;
                }
                $this->user_data_left[] = array('ip' => $value->ip, 'is_online' => $value->is_online, 'leg' => $value->leg, 'created_at' => $value->created_at, 'user_key' => $value->user_key, 'name' => $value->name, 'sponsor_key' => $value->sponsor_key, 'parent_key' => $value->parent_key, 'city' => $city_name, 'mobile' => $value->mobile, 'package_name' => $packagename);
            }
            $this->getLeftCount($users_data_left, $leg);
        }
        return $this->user_data_left;
    }
    public function getRightCount($id, $leg)
    {
        if (is_array($id)) {
            $parents = User::whereIn('parent_key', $id)->get();
        } else {
            $array = array($id);
            $parents = User::whereIn('parent_key', $array)->where('leg', $leg)->get();
        }
        if ($parents->count()) {
            $users_data_right = [];
            foreach ($parents as $key => $value) {
                $users_data_right[] = $value->user_key;
                $city_name = 'NA';
                if (isset($value->city_name->name)) {
                    $city_name = $value->city_name->name;
                }
                $packagename = "Yet to update";
                if (isset($value->package->name)) {
                    $packagename = $value->package->name;
                }
                $this->user_data_right[] = array('ip' => $value->ip, 'is_online' => $value->is_online, 'leg' => $value->leg, 'created_at' => $value->created_at, 'user_key' => $value->user_key, 'name' => $value->name, 'sponsor_key' => $value->sponsor_key, 'parent_key' => $value->parent_key, 'city' => $city_name, 'mobile' => $value->mobile, 'package_name' => $packagename);
            }
            $this->getRightCount($users_data_right, $leg);
        }
        return $this->user_data_right;
    }
    public function binaryPayment($user_key, $leg, $current_user_pv, $current_user_leg, $TDMCharges, $current_user)
    {
        if ($user_key) {
            $parent_key = DB::table('users')->where('user_key', $user_key)->first();
            if (isset($parent_key->parent_key)) {
                $this->parent[] .= $parent_key->parent_key;
                $this->parent[] .= $user_key;
                $this->user_data[] = array('user_key' => $user_key, 'winners_club_id' => $parent_key->winners_club_id, 'leg' => $parent_key->leg, 'child_leg' => $this->pleg);
                $this->pleg = $parent_key->leg;
                $this->parent_key = $this->binaryPayment($parent_key->parent_key, $leg, $current_user_pv, $current_user_leg, $TDMCharges, $current_user);
            }
        } else {
            unset($this->user_data[0]);
            $i = 1;
            foreach ($this->user_data as $key => $value) {
                $this->BP($value, $current_user_pv, $current_user_leg, $i, $this->user_data, $TDMCharges, $current_user);
                $i++;
            }
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
                    Payout::pay($user->user_key, $achievement->percentage, $TDMCharges[0], $TDMCharges[1], $TDMCharges[3], $achievement->business_area_id, $status = 0, $message, $user_type_id = 1);
                    UserAchievement::updateorcreate(['user_key' => $user_key, 'achievement_id' => $UserAchievementsData[$i - 1]], ['user_key' => $user_key, 'achievement_id' => $UserAchievementsData[$i - 1], 'achievement_date' => now()]);
                } else {
                    UserAchievement::updateorcreate(['user_key' => $user_key, 'achievement_id' => $UserAchievementsData[$i - 1]], ['user_key' => $user_key, 'achievement_id' => $UserAchievementsData[$i - 1], 'achievement_date' => now()]);
                }
            }
        }
    }
    public function getLeftRightCount($id, $leg)
    {
        $child = User::where('parent_key', $id)->where('leg', $leg)->first();
        if (isset($child->id)) {
            $data = DB::table('users')->select(DB::raw('sum(point_value) as pv'))->join('packages', 'packages.id', '=', 'users.package_id')->whereBetween('_lft', [$child->_lft, $child->_rgt])->first();
            if (isset($data->pv)) {
                return array('pv' => $data->pv);
            } else {
                return array('pv' => 0);
            }
        } else {
            return array('pv' => 0);
        }
    }
    function BP($user_key, $current_user_pv, $current_user_leg, $i, $array, $TDMCharges, $current_user)
    {
        $user = User::where('user_key', $user_key['user_key'])->first();
        $this->logic1($user, $user_key, $current_user_pv, $current_user_leg, $i, $array, $TDMCharges, $user->pay_type, $current_user);
    }
    public function logic1($user, $user_key, $current_user_pv, $current_leg, $i, $array, $TDMCharges, $count, $current_user)
    {
        if ($user_key['child_leg']) {
            $user->increment('balance_pv_right', $current_user_pv);
            $user->save();
            $totalPVRight = $user->balance_pv_right;
            $totalPVLeft = $user->balance_pv_left;
            if ($totalPVLeft > 1) {
                if ($totalPVRight >= $totalPVLeft) {
                    $balance_pv_left = 0;
                    $balance_pv_right = $totalPVRight - $totalPVLeft;
                    $amount = $totalPVLeft * $TDMCharges[2] / 100;
                } else {
                    $balance_pv_right = 0;
                    $balance_pv_left = $totalPVLeft - $totalPVRight;
                    $amount = $totalPVRight * $TDMCharges[2] / 100;
                }
                $this->logic21payment($user, $balance_pv_right, $balance_pv_left, 0, $current_user_pv, $amount, $user_key['user_key'], $TDMCharges, $current_user);
            } else {
                DB::table('user_point_values')->insert(['user_key' => $user_key['user_key'], 'user_by' => $current_user, 'blpv' => 0, 'brpv' => $current_user_pv, 'amount' => 0, 'bpv' => $user->balance_pv_left . ':' . $user->balance_pv_right, 'created_at' => date('Y-m-d')]);
            }
        } else {
            // Left Child Increments
            $user->increment('balance_pv_left', $current_user_pv);
            $user->save();
            $totalPVRight = $user->balance_pv_right;
            $totalPVLeft = $user->balance_pv_left;
            if ($totalPVRight > 1) {
                if ($totalPVLeft >= $totalPVRight) {
                    $balance_pv_right = 0;
                    $balance_pv_left = $totalPVLeft - $totalPVRight;
                    $amount = $totalPVRight * $TDMCharges[2] / 100;
                } else {
                    $balance_pv_left = 0;
                    $balance_pv_right = $totalPVRight - $totalPVLeft;
                    $amount = $totalPVLeft * $TDMCharges[2] / 100;
                }
                $this->logic21payment($user, $balance_pv_right, $balance_pv_left, $current_user_pv, 0, $amount, $user_key['user_key'], $TDMCharges, $current_user);
            } else {
                DB::table('user_point_values')->insert(['user_key' => $user_key['user_key'], 'user_by' => $current_user, 'blpv' => $current_user_pv, 'brpv' => 0, 'amount' => 0, 'bpv' => $user->balance_pv_left . ':' . $user->balance_pv_right, 'created_at' => date('Y-m-d')]);
            }
        }
    }
    public function logic21payment($user, $balance_pv_right, $balance_pv_left, $loopLeft, $loopRight, $amount, $user_key, $TDMCharges, $user_by)
    {
        //  $user =   User::where('user_key',$user_key)->first();
        if ($user->package_id) {
            $earning = $amount;
            $adminamount = $earning * $TDMCharges[0] / 100; /*Admin Charge %*/
            $TDS = $earning * $TDMCharges[1] / 100; /*TDS %*/
            $pst = $earning * $TDMCharges[3] / 100; /*Property saving Tax %*/
            $deduction = $TDS + $adminamount + $pst;
            $amountToBepaid = $earning - $deduction;
            DB::table('user_point_values')->insert(['user_key' => $user_key, 'user_by' => $user_by, 'blpv' => $loopLeft, 'brpv' => $loopRight, 'amount' => $amountToBepaid, 'bpv' => $balance_pv_left . ':' . $balance_pv_right, 'created_at' => date('Y-m-d')]);
            $user->balance_pv_right = $balance_pv_right;
            $user->balance_pv_left = $balance_pv_left;
            $user->save();
            $this->getBadge($user_key, $user, $TDMCharges);
            if (isset($user->package->daily_caping)) {
                $amountCap = $user->package->daily_caping;
                $resp = Payment::paymentCaping($user_key, 1, $amountCap, $amount);
                Log::info('user caping info', ['respCap' => $resp, 'user_key' => $user_key, 'amountCap' => $amountCap, 'New AMount' => $amount]);
                if ($resp == 'yes') {
                    Payout::pay($user_key, $amount, $TDMCharges[0], $TDMCharges[1], $TDMCharges[3], 1, $status = 1, 'Team Bonus Income');
                } elseif ($resp == 'no') {
                } else {
                    $pay = $resp['pay'];
                    $washed_amount = $resp['washed_amount'];
                    Payout::pay($user_key, $pay, $TDMCharges[0], $TDMCharges[1], $TDMCharges[3], 1, $status = 1, 'Team Bonus Income, Remaing amount washed' . $washed_amount);
                }
            }
        }
    }
    public function invoiceStatusLeft($status = 0)
    {
        $left = $this->getLeftCount(auth::user()->user_key, 0);
        $myTeam = $left;
        $user_id = [];
        foreach ($myTeam as $key => $value) {
            $user_id[] = $value['user_key'];
        }
        $users = User::wherein('user_key', $user_id)->where('signed_invoice', $status)->ORDERBY('invoice_verified_at', 'DESC')->get();
        return view('users.associatemodule.invoicependingleft', compact('users', 'status'))->with('myLeftLegUsers', $left);
    }
    public function invoiceStatusRight($status = 0)
    {
        $right = $this->getRightCount(auth::user()->user_key, 1);
        $myTeam = $right;
        $user_id = [];
        foreach ($myTeam as $key => $value) {
            $user_id[] = $value['user_key'];
        }
        $users = User::wherein('user_key', $user_id)->where('signed_invoice', $status)->ORDERBY('invoice_verified_at', 'DESC')->get();
        return view('users.associatemodule.invoicependingright', compact('users', 'status'))->with('myRightLegUsers', $right);;
    }
    public function downline()
    {
        $left = $this->getLeftCount(auth::user()->user_key, 0);
        $right = $this->getRightCount(auth::user()->user_key, 1);
        return view('users.associatemodule.downline')->with('myLeftLegUsers', $left)->with('myRightLegUsers', $right);
    }
    public function downlinePaidLeft()
    {
        $left = $this->getLeftCount(auth::user()->user_key, 0);
        $right = $this->getRightCount(auth::user()->user_key, 1);
        return view('users.associatemodule.downline')->with('myLeftLegUsers', $left)->with('myRightLegUsers', $right);
    }
    public function downlinePaidRight()
    {
        $left = $this->getLeftCount(auth::user()->user_key, 0);
        $right = $this->getRightCount(auth::user()->user_key, 1);
        return view('users.associatemodule.downline')->with('myLeftLegUsers', $left)->with('myRightLegUsers', $right);
    }

    public function addNew(Request $request)
    {

        // $arr = [1,2,3,4,4,7,4,6,7,7,2,4,4,552,222,4];
      
        // arsort($arr);

        // dd($GA,$GB);
         // $this->generationPayment(634087);
         // dd("ASd");
        $country = new Country;
        $countries = $country->getCountry();
        $cities = DB::table('cities')->get();
        $states = DB::table('states')->get();
        $packages = Package::where('business_area_id', 1)->where('status', 1)->get();
        $PinRequests = PinRequest::where('user_key', auth::user()->user_key)->where('status', 1)->groupby('package_id')->get();
        return view('users/associatemodule/add_new', compact('request', 'packages', 'countries', 'cities', 'states', 'PinRequests'));
    }
    public function checkVerifyUserParent($data)
    {
        $data = User::where('user_key', $data->sponsor_key)->first();
        if (isset($data->id)) {
            return 0;
        } else {
            return 1;
        }
    }
    public function checkParent(Request $request)
    {
        $data = User::where('parent_key', $request->user_key)->get();
        if (count($data) == 2) {
            echo "No position available";
        } elseif (count($data) == 0) {
            echo "Left and right leg are available";
        } else {
            foreach ($data as $key => $value) {
                if ($value->leg == 1) {
                    echo "Left Leg Free";
                } else {
                }
                if ($value->leg == 0) {
                    echo "Right Leg Free";
                }
            }
        }
    }
    public function bankDetails($request, $user)
    {
        $folderPath = 'assets/user/' . $user->id . '/documents';
        $kyc_document = '';
        $is_kyc_document = 0;
        if ($request->hasFile('kyc_document')) {
            $is_kyc_document = 1;
            $file = $request->file('kyc_document');
            $kyc_document = $user->user_key . '-' . rand() . $file->getClientOriginalName();
            $file->move($folderPath, $kyc_document);
        }
        $userBank = UserBankDetail::where('user_key', $user->user_key)->first();
        if (!empty($userBank)) {
            $UserBankDetail = UserBankDetail::find($user->bankDetails->id);
            UserBankDetailHistory::create(['user_key' => $user->user_key, 'account_no' => $UserBankDetail->account_no, 'account_no' => $UserBankDetail->account_no, 'name' => $UserBankDetail->name, 'branch' => $UserBankDetail->branch, 'ifsc' => $UserBankDetail->ifsc, 'city' => $UserBankDetail->city, 'kyc_document' => $UserBankDetail->kyc_document,]);
            $UserBankDetail->account_no = $request->account_no;
            $UserBankDetail->name = $request->name;
            $UserBankDetail->branch = $request->branch;
            $UserBankDetail->ifsc = $request->ifsc;
            $UserBankDetail->city = $request->city;
            $user = User::find($user->id);
            if ($request->hasFile('kyc_document')) {
                $UserBankDetail->kyc_document = $kyc_document;
                $user->is_kyc_document = 1;
                $user->is_bank_details_update = 1;
            }
            $UserBankDetail->save();
            $user->is_bank_details_update = 0;
            $user->bank_kyc_status = 0;
            $user->save();
        } else {
            UserBankDetail::create(['user_key' => $user->user_key, 'account_no' => $request->account_no, 'name' => $request->name, 'branch' => $request->branch, 'ifsc' => $request->ifsc, 'kyc_document' => $kyc_document, 'city' => $request->city,]);
            $user = User::find($user->id);
            if ($request->hasFile('kyc_document')) {
                $user->is_kyc_document = 1;
                $user->is_bank_details_update = 1;
                $user->bank_kyc_status = 1;
            }
            $user->is_bank_details_update = 0;
            $user->bank_kyc_status = 0;
            $user->save();
        }
        session::flash("message", "Profile has been updated");
    }
    public function addNewSave(Request $request)
    {
        $customMessages = ['required' => 'The :attribute field can not be blank.', 'unique' => 'The :attribute must be unique.'];
        $sponsor_key = $request->sponsor_key;
        $parent_key = $request->parent_key;
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'user_name' => 'required|unique:users,user_name',
            'mobile' => 'required',
            'email' => 'required',
            'password' => 'required',
            // 'dob' => 'required', 
            // 'gender' => 'required', 
            'sponsor_key' => [
                'required',
                // Rule::exists('users', 'user_key')
                // ->where(function ($query) use ($sponsor_key) {
                // $query->where('user_key', $sponsor_key);
                // $query->where('package_id','>',0);
                // }),
            ],  'parent_key' => [
                'required',
                Rule::exists('users', 'user_key')
                ->where(function ($query) use ($parent_key) {
                       $query->where('user_key', $parent_key);
                }),
            ],
        ], $customMessages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $userSponsorVerify = 0;
        if ($request->is_from_tree) {
            $userSponsorVerify = $this->checkVerifyUserParent($request);
        }
        //$pin = Pin::where('user_key', auth::user()->user_key)->where('status', '!=', 0)->where('pin_number', $request->pin)->first();
        // if (isset($pin->id)) {
        //     AssignPin::where('pin_id', $pin->id)->update(['status' => 0]);
        //     $pin->status = 0;
        //     $pin->save();
        // } else {
        //     session::flash("message", "Invalid pin or used");
        //     return redirect()->back();
        // }
        $isSponsor = User::where('user_key', $request->sponsor_key)->count();
        if ($isSponsor) {
        } else {
            session::flash("message", "Invalid Sponsor Key");
            return redirect()->back();
        }
        if ($userSponsorVerify) {
            session::flash("message", "Invalid request. Already have child");
            return redirect()->back();
        }
        $user = $this->associateModule->addNew($request->all());
        // $this->UserBonusClubService->check($sponsor_key);
        // $this->UserAutoPoolService->check($sponsor_key);
        // $this->bankDetails($request,$user);
        $folderPath = 'assets/user/' . $user->id . '/documents';
        $pan_documents = " ";
        if ($request->hasFile('pan_documents')) {
            $file = $request->file('pan_documents');
            $pan_documents = rand() . $file->getClientOriginalName();
            $file->move($folderPath, $pan_documents);
            $user->pan_document = $pan_documents;
            $user->is_pan_verified = 1;
            $user->save();
        }
        if ($request->hasFile('adhaar_front')) {
            $file = $request->file('adhaar_front');
            $adhaar_front = rand() . $file->getClientOriginalName();
            $file->move($folderPath, $adhaar_front);
            $user->adhaar_front = $adhaar_front;
            $user->is_adhaar_verified = 1;
            $user->save();
        }
        if ($request->hasFile('adhaar_back')) {
            $file = $request->file('adhaar_back');
            $adhaar_back = rand() . $file->getClientOriginalName();
            $file->move($folderPath, $adhaar_back);
            $user->adhaar_back = $adhaar_back;
            $user->is_adhaar_verified = 1;
            $user->save();
        }
        if ($user == null) {
            session::flash('message', 'Sponsor name can not be found');
            return redirect('/member/direct');
        }
        if ($user->id) {
            session::flash('message', 'User has been added');
            $description = 'User ' . $user->name . '/' . $user->user_key . 'registered by ' . $user->sponsor_key . 'User created by ' . auth::user()->user_key;
            /*PV Add*/
            $charges = Charge::all();
            $adminCharges =  $charges[0]->percentage;
            $TDSpercent =  $charges[1]->percentage;

            //       if ($user->package->package_type_id==4) {

            //                     $earning = $user->package->amount;
            //                     $levelLimit = $user->package->levelLimit;



            // $GenerationIncome = new GenerationIncome();

            //                     $GenerationIncome->DirectLevelWise($user->user_key,$levelLimit,3,$earning,$adminCharges,$TDSpercent,$user->user_key);

            //       }else{
            //       $earning = $user->package->amount * $user->package->direct_income / 100;
            //       $message = "Sponsor Income from user  " . $user->user_key;

            //       Payout::pay($user->sponsor_key, $earning, 2, $status = 0, $message, $user_type_id = 1);

            //       }


            /*PV Add*/

            session::flash('message', 'Registration Done');
            return redirect('/member/direct');
        } else {
            session::flash('message', 'Something went wrong,Please contact your sponsor');
            return redirect()->back();
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function blockedmember()
    {
        return view('users.associatemodule.blockedmember');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function tagachievers()
    {
        return view('users.associatemodule.tagachievers');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

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
        //

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

    }
}
