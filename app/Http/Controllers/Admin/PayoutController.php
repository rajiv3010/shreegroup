<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Payout;
use App\Payment;
use App\Email;
use App\APC;
use App\DPC;
use App\Charge;
use App\User;
use App\UserWalletLog;
use App\UserPointValue;
use Auth;
use App\Pin;
use DB;
use File;
use Session;
class PayoutController extends Controller {
    public function __construct() {
        $this->email = new Email();
        $this->user = new User();
        $this->middleware('auth:admin');
    }
    public function index() {
        return view('users.payout.dashboard');
    }
    public function userInvoice($id) {
        $user = User::find($id);
        return view('admin.user.invoice', compact('user'));
    }
    public function binary() {
        $binary_payouts = UserPointValue::where('user_key', Auth::user()->user_key)->get();
        return view('users.payout.binary.list', compact('binary_payouts'));
    }
    public function userWallet($user_key) {
        $user = User::where('user_key', $user_key)->first();
        $walletLogs = UserWalletLog::where('user_key', $user_key)->orderby('id', 'DESC')->get();
        return view('admin.user.wallet', compact('user', 'walletLogs'));
    }
    public function userWalletUpdate(Request $request) {
        $this->user->updateWallet($request, auth::guard('admin')->user()->user_key, 'admin');
        session::flash("message", "User wallet has been updated");
        return redirect()->back();
    }
    public function level() {
        return view('users.payout.level.list');
    }
    public function ads() {
        $payouts = Payout::select('status', 'created_at', DB::raw("IFNULL(sum(amount),0) as amount"))->where('business_area_id', 7)->where('status', 1)->where('user_key', Auth::user()->user_key)->groupby('created_at')->get();
        return view('users.payout.ads.list')->with('payouts', $payouts);
    }
    public function application() {
        $payouts = Payout::where('business_area_id', 4)->where('status', 1)->select('created_at', DB::raw("IFNULL(sum(amount),0) as amount"))->where('user_key', Auth::user()->user_key)->groupby('created_at')->get();
        return view('users.payout.application.list')->with('payouts', $payouts);
    }
    public function classified() {
        $payouts = DB::table('payouts')->where('status', 1)->where('business_area_id', 5)->select('created_at', DB::raw("IFNULL(sum(amount),0) as amount"))->where('user_key', Auth::user()->user_key)->groupby('created_at')->get();
        return view('users.payout.classified.list')->with('payouts', $payouts);
    }
    public function payout() {
        $payouts = DB::table('payouts')->select('id', 'created_at', 'business_area_id', DB::raw("IFNULL(sum(amount),0) as amount"))->where('user_key', Auth::user()->user_key)->groupby('created_at', 'business_area_id')->get();
        $binary_payouts = DB::table('user_point_values')->select('id', 'created_at', DB::raw("IFNULL(sum(amount),0) as amount"))->where('user_key', Auth::user()->user_key)->groupby('created_at')->get();
        foreach ($binary_payouts as $key => $value) {
            $value->business_area_id = 1;
        }
        $result = $payouts->merge($binary_payouts);
        $datewise = array();
        foreach ($result as $key => $date) {
            if (!array_key_exists($date->created_at, $datewise)) {
                $datewise[$date->created_at] = [];
            }
            $datewise[$date->created_at][] = $date;
        }
        return view('users.payout.payout.list')->with('payouts', $datewise);
    }
    public function payment() {
        return view('admin.payout.payment');
    }
    public function paymentReleaseForBank() {
        $path = storage_path('app/' . date('d-m-Y') . env('payment_export_file_name') . '.csv');
        $fp = fopen($path, 'w');
        $headers = ['Name', 'User ID', 'Bank Name', 'Account no', 'Branch', 'IFSC', 'City', 'Amount'];
        fputcsv($fp, $headers);
        // $payments  =  DB::table('payments')->select('user_bank_details.*','users.name as user_name','payments.amount','payments.id as payment_id','users.mobile')
        //               ->join('users','users.id','payments.user_id')
        //               ->join('user_bank_details','users.user_key','user_bank_details.user_key')
        //               ->where('payments.status',2)
        //               ->get();
        $payments = Payment::select(DB::raw('sum(amount) amount'), DB::raw('sum(earning) earning'), 'user_key')->where('status', 2)->groupby('user_key')->get();
        if (count($payments)) {
            foreach ($payments as $key => $fields) {
                if (is_object($fields))
                // $fields = (array) $fields;
                $fdata['user_name'] = $fields->userByKey->name;
                $fdata['id'] = $fields->userByKey->user_key;
                $fdata['name'] = $fields->userByKey->bankDetails->name;
                $fdata['account_no'] = $fields->userByKey->bankDetails->account_no;
                $fdata['branch'] = $fields->userByKey->bankDetails->branch;
                $fdata['ifsc'] = $fields->userByKey->bankDetails->ifsc;
                $fdata['city'] = $fields->userByKey->bankDetails->city;
                $fdata['amount'] = $fields->amount;
                // $fdata['date'] = $fields->created_at;
                DB::table('payments')->where('user_key', $fields->userByKey->user_key)->where('status', 2)->update(['status' => 3]);
                fputcsv($fp, $fdata);
            }
        } else {
            $fdata = array('message' => "No transaction found ", 'date' => date('Y-m-d'));
            fputcsv($fp, $fdata);
        }
        fclose($fp);
        //$this->email->sendBandTransactionReport($path);
        return response()->download($path);
        return redirect()->back();
    }
    public function turnover() {
        $data = Payment::where('status', 2)->get();
        return view('admin/payout/payment_release', compact('data'));
    }
    public function paymentRelease() {
        $data = Payment::select(DB::raw('sum(amount) amount'), DB::raw('sum(earning) earning'), 'user_key')->where('status', 2)->groupby('user_key')->get();
        return view('admin/payout/payment_release', compact('data'));
    }
    public function paymentStop() {
        $data = Payout::where('status', 3)->get();
        return view('admin/payout/payment_stop', compact('data'));
    }
    public function paymentReleaseHistory() {
        $data = Payment::select(DB::raw('count(id) count'), DB::raw('sum(amount) amount'), 'created_at')->groupby('created_at')->orderby('created_at','DESC')->wherein('status', [3, 4])->get();
        return view('admin.payout.payment_history', compact('data'));
    }
    public function paymentReleaseHistoryByDate($date) {
        $data = Payment::where('created_at', $date)->get();
        return view('admin/payout/payment_history_details', compact('data'));
    }
    public function paymentReleaseHistoryChangeStatus(Request $request) {
        if ($request->payment_id == null) {
            session::flash("message", "Please selecte at least one payment ");
            return redirect()->back();;
        } else {
            Payment::wherein('id', $request->payment_id)->update(['status' => 4]);
            session::flash("message", "Payment for bank status changed");
            return redirect('/admin/payment/release/history');
        }
    }
    public function UserPaymentStatus($user_key, $user_id, $amount, $id, $status) {
        //     Payment::create([
        //     'user_key'=>$user_key,
        //     'user_id'=>$user_id,
        //     'amount'=>$amount,
        //     'status'=>$status,
        //     'admin_id'=>Auth::guard('admin')->user()->id,
        // ]);
        $user = User::find($user_id);
        $user->payment_status = $status;
        $user->save();
        Payout::where('id', $id)->where('created_at', '<=', date('Y-m-d'))->update(['status' => $status]);
        session::flash('message', 'User payment has been Stop');
        return redirect()->back();
    }
    public function userPayment() {
        $payouts = Payout::where('status', 0)->where('earning','!=',0)->get();
        // ->groupby('payouts.user_key')
        // ->groupby('payouts.business_area_id')


        // $payouts =Payout::select('payouts.user_key','message','payouts.created_at','payouts.earning','tds','admin_charges','amount','business_area_id','type','status')
        // ->join('users','users.user_key','=','payouts.user_key')
        // ->where('users.bank_kyc_status','=',2)
        // ->where('users.is_pan_verified','=',2)
        // ->where('payouts.status',0)
        // ->where('payouts.earning','!=',0)
        // ->groupby('payouts.user_key')
        // ->get();

        return view('admin/payout/userPayment', compact('payouts'));
    }
    // user payment
    // public function userPayment_Ori()
    // {
    //    $payouts =Payout::select(DB::raw('sum(amount) total'),DB::raw('sum(payouts.earning) earning'),'payouts.user_key','message','payouts.created_at','amount','business_area_id','type','status')
    //     ->join('users','users.user_key','=','payouts.user_key')
    //     ->where('users.bank_kyc_status',2)
    //     ->where('users.is_pan_verified',2)
    //     ->where('status',0)
    //     ->groupby('payouts.user_key')
    //     ->get();
    //     return view('admin/payout/userPayment',compact('payouts'));
    // }
    // user payment
    public function userPaymentPendingKyc() {
       $payouts =Payout::select('payouts.user_key','message','payouts.created_at','payouts.earning','tds','admin_charges','amount','business_area_id','type','status')->join('users', 'users.user_key', '=', 'payouts.user_key')->where('status', 0)->where('payouts.earning','!=',0)->where('users.bank_kyc_status', '!=', 2)->orWhereNull('users.bank_kyc_status')->groupby('payouts.user_key')->get();
        return view('admin/payout/userPaymentPendingKyc', compact('payouts'));
    }
    public function isPaymentStop($user_key) {
        return Payment::where('user_key', $user_key)->where('status', 2)->count();
    }
    public function getPayout($user_key, $user_id, $name, $daily_income, $user) {
        $directEarning = $this->email->directEarning($user_key, 3);
        $classified = $this->email->classifiedEarning($user_key, 5);
        $adEarning = $this->email->adEarning($user_key, 7);
        $binaryPayout = $this->email->binaryPayout($user_key);
        $classifiedWallet = $this->email->classifiedWallet($user_key);
        $havebankDetails = (count($user->bankDetails)) ? 1 : 0;
        return array('name' => $name, 'user_key' => $user_key, 'user_id' => $user_id, 'Ad Earning' => $adEarning, 'level Income' => $daily_income, 'Binary Payout' => $binaryPayout, 'Classified' => $classified, 'Recharge' => 0, 'Direct Earning' => $directEarning, 'bankDetails' => $havebankDetails,);
    }
    public function PayUserAmount($user_key, $user_id, $amount, $earning, $id) {
        Payment::create(['user_key' => $user_key, 'user_id' => $user_id, 'status' => 2, 'amount' => $amount, 'earning' => $earning, 'admin_id' => Auth::guard('admin')->user()->id, ]);
        Payout::where('user_key', $user_key)->where('id', $id)->where('created_at', '<=', date('Y-m-d'))->update(['status' => 1]);
        $user = User::find($user_id);
        $total_earning = $user->earning + $amount;
        DB::table('users')->where('user_key', $user_key)->update(['total_earning' => $total_earning, 'earning' => $total_earning, 'payment_status' => 1]);
        $this->ApcDpcPayout($user_key, $amount);
        session::flash('message', 'User payment has been released');
        return redirect()->back();
    }
    public function PayUserAmountOld($user_key, $user_id, $amount) {
        Payment::create(['user_key' => $user_key, 'user_id' => $user_id, 'status' => 2, 'amount' => $amount, 'admin_id' => Auth::guard('admin')->user()->id, ]);
        Payout::where('user_key', $user_key)->where('created_at', '<=', '2019-06-15')->update(['status' => 1]);
        $user = User::find($user_id);
        $total_earning = $user->earning + $amount;
        DB::table('users')->where('user_key', $user_key)->update(['total_earning' => $total_earning, 'earning' => $total_earning, 'payment_status' => 1]);
        $this->ApcDpcPayout($user_key, $amount);
        session::flash('message', 'User payment has been released');
        return redirect()->back();
    }
    public function ApcDpcPayout($user_key, $amount) {
        $TDMCharges = ['', env('adminCharges'), env('TDSpercent') ];
        $business_area_id = 16;
        $user = User::where('user_key', $user_key)->first();
        $pins = Pin::where('pin_number', $user->pin_number)->first();
        if ($pins == null) {
            return 1;
        }
        if ($pins->user_key) {
            if ($pins->created_by == 1) {
                $apcamount = $amount * 10 / 100;
                Payout::pay($pins->user_key, $apcamount, $TDMCharges[1], $TDMCharges[2], $business_area_id, 1, 'Income From campaign by user:' . $user->user_key, 2);
                $apc = APC::where('apc_key', $pins->user_key)->first();
                $dpcamount = $apcamount * 10 / 100;
                Payout::pay($apc->dpc_key, $dpcamount, $TDMCharges[1], $TDMCharges[2], $business_area_id, 1, 'Income From campaign by user:' . $user->user_key, 3);
            }
        }
    }
    public function update(Request $request, $id) {
        //
        
    }
    public function destroy($id) {
        //
        
    }
}
