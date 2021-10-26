<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\UserBonusClub;
use App\UserAutoPool;
use App\UserBankDetail;
use App\BinaryLevel;
use App\Payout;
use App\Payment;
use App\UsersOrg;
use App\UpgradePackage;
use App\UpgradeHistory;
use App\Tree;
use App\Pin;
use App\AssignPin;
use App\APC;
use App\Charge;
use Illuminate\Support\Facades\Validator;
use File;
use Illuminate\Http\Request;
use App\Package;
use DB;
use Auth;
use App\Email;
use Log;
use Illuminate\Support\Facades\Hash;
class AssociateModule extends Model {
    public $parent = array();
    public $puser_key;
    public $pleg = '';
    public $user_data = array();
    public $user_data_left = array();
    public $user_data_right = array();
    public $pvLeft = 0;
    public $pvRight = 0;
    public function __construct() {
        $this->payout = new Payout();
        $this->email = new Email();
        $this->pin = new Pin();
        $this->tree = new Tree();
        $this->UpgradePackage = new UpgradePackage();
    }
    public function UpdateNew() {
        $users = UsersOrg::where('is_online', 0)->orderby('id', 'asc')->get()->take(200);
        foreach ($users as $key => $value) {
            echo $value->id;
            $parent_key = $value->parent_key;
            $isDuplicate = User::where('parent_key', $value->parent_key)->where('leg', $value->leg)->count();
            if ($isDuplicate) {
                echo "<br>";
                echo "<br>";
                echo "isDuplicate RUN";
                echo "<br>";
                $user_placement = $this->getExtremePlacementId($value->sponsor_key, $value->leg);
                if ($user_placement) {
                    echo "<br>";
                    echo "if";
                    $parent_key = $user_placement;
                } else {
                    echo "<br>";
                    echo "else";
                    echo "<br>";
                    $parent_key = $value->sponsor_key;
                }
            } else {
            }
            $cparent = User::where('user_key', $parent_key)->first();
            $user = User::create(['user_key' => $value->user_key, 'balance_pv_right' => $value->balance_pv_right, 'balance_pv_left' => $value->balance_pv_left, 'parent_key' => $parent_key, 'sponsor_key' => $value->sponsor_key, 'transaction_password' => $value->transaction_password, 'package_id' => $value->package_id, 'winners_club_id' => $value->winners_club_id, 'leg' => $value->leg, 'pin_number' => $value->pin_number, 'classified_wallet' => $value->classified_wallet, 'pay_type' => $value->pay_type, 'redemption_wallet' => $value->redemption_wallet, 'wallet' => $value->wallet, 'earning' => $value->earning, 'total_earning' => $value->total_earning, 'is_redemption' => $value->is_redemption, 'traning_package_create' => $value->traning_package_create, 'daily_income' => $value->daily_income, 'name' => $value->name, 'email' => $value->email, 'mobile' => $value->mobile, 'mobile1' => $value->mobile1, 'gender' => $value->gender, 'occupation' => $value->occupation, 'address1' => $value->address1, 'address2' => $value->address2, 'address3' => $value->address3, 'pan' => $value->pan, 'pan_document' => $value->pan_document, 'aadhaar_no' => $value->aadhaar_no, 'adhaar_front' => $value->adhaar_front, 'adhaar_back' => $value->adhaar_back, 'is_pan_verified' => $value->is_pan_verified, 'is_adhaar_verified' => $value->is_adhaar_verified, 'dob' => $value->dob, 'country' => $value->country, 'state' => $value->state, 'city' => $value->city, 'pincode' => $value->pincode, 'profile_photo' => $value->profile_photo, 'password' => $value->password, 'admin_password' => $value->admin_password, 'forgot_token' => $value->forgot_token, 'banned' => $value->banned, 'is_eligible' => $value->is_eligible, 'signed_invoice' => $value->signed_invoice, 'is_kyc_document' => $value->is_kyc_document, 'bank_kyc_status' => $value->bank_kyc_status, 'is_bank_details_update' => $value->is_bank_details_update, 'signed_invoice_doc' => $value->signed_invoice_doc, 'invoice_verified_at' => $value->invoice_verified_at, 'signed_invoice_upload_at' => $value->signed_invoice_upload_at, 'is_online' => $value->is_online, 'ip' => $value->ip, 'achievement_id' => $value->achievement_id, 'auto_pool_club_id' => $value->auto_pool_club_id, 'bonus_club_income' => $value->bonus_club_income, 'winners_club_income' => $value->winners_club_income, 'nominee_name' => $value->nominee_name, 'nominee_relation' => $value->nominee_relation, 'payment_status' => $value->payment_status, 'remember_token' => $value->remember_token, 'created_at' => $value->created_at, 'date' => $value->date, 'registry_status' => $value->registry_status, 'package_activate_date' => $value->package_activate_date, 'updated_at' => $value->updated_at], $cparent);
            //                    echo $value->user_key;
            echo "<br>Updated<br>";
            $value->is_online = 1;
            $value->save();
        }
        dd();
    }
    public function generateRandomString($length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0;$i < $length;$i++) {
            $randomString.= $characters[rand(0, $charactersLength - 1) ];
        }
        return $randomString;
    }
    public function addNew($data) {
        $is_eligible = 1;
        $user_key = rand(111111, 999999);
        //if generated key is already exist in the DB then again re-generate key
        do {
            $check = User::where('user_key', $user_key)->count();
            $flag = 1;
            if ($check == 1) {
                $user_key = rand(111111, 999999);
                $flag = 0;
            }
        } while ($flag == 0);
        //if generated key is already exist in the DB then again re-generate key
        //
        $sponsor = $data['sponsor_key'];
        $parent_key = $data['parent_key'];
        //   $parent_key = $sponsor1;
        $transaction_password = $this->generateRandomString();
        $password = $data['password'];
        //$dob = date('Y-m-d', strtotime($data['dob']));
        //$package = Package::find($data['package_id']);
        
        $user = User::create(['user_key' => $user_key, 
        'parent_key' => $parent_key, 
        'sponsor_key' => $sponsor, 
        'leg' => 0, 
        'transaction_password' => $transaction_password, 
        'user_name' => $data['user_name'], 
        'name' => $data['name'], 
        'email' => $data['email'], 
        'pin_number' => 0, 
        'package_id' =>0, 
        'package_type_id' => 0, 
        'password' => Hash::make($data['password']), 
        'admin_password' => $data['password'], 
        'mobile' => $data['mobile'], 
        'gender' => $data['gender'], 
        'is_eligible' => $is_eligible, 
        'is_online' => 0, 
        'ip' => \Request::ip(), 
        'wallet' => 0, 
        'date' => date('Y-m-d'), 
        'paid_month' => 0, 
        'package_activate_date' => date('Y-m-d') ]);
        
        //$upgradePackageHistory = UpgradeHistory::create(['user_id' => $user->id, 'user_key' => $user_key, 'package_id' => $data['package_id'], 'package_type_id' => $package->package_type_id, ]);
        /*Payment and PV proccess move to Admin Site when invoice accepeted*/
        $pathP = public_path() . 'assets/user/' . $user->id . '/documents';
        if (!file_exists($pathP)) {
            File::makeDirectory($pathP, $mode = 0777, true, true);
        }
        // $this->email->welcomeUser($user,$password,$transaction_password);
        return $user;
    } //Create funtion end
    public function is_eligible($sponser_id, $package_id) {
        $user = User::where('user_key', $sponser_id)->first();
        if ($user == null) {
            return null;
        }
        $package_list = array('1', '2', '3');
        $resp = 0;
        if (in_array($user->package_id, $package_list)) {
            $resp = 1;
        }
        if (in_array($package_id, $package_list)) {
            $resp = 1;
        }
        return $resp;
    }
    function getExtremePlacementId($sponsor_key, $placement) {
        $user_placement = User::where('parent_key', $sponsor_key)->select('user_key')->where('leg', $placement)->orderby('created_at', 'desc')->first();
        if ($user_placement == null) {
            return $this->puser_key;
        } else {
            $this->puser_key = $user_placement->user_key;
            return $this->getExtremePlacementId($user_placement->user_key, $placement);
        }
    }
}
