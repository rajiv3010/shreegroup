<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Admin;
use App\User;
use App\Email;
use App\Achievement;
use App\UpgradeHistory;
use App\Package;
use App\Payment;
use App\Pin;
use App\Payout;
use App\PackageDescription;
use App\Admanagement;
use Auth;
use Session;
use Illuminate\Support\Facades\Redirect;
use DB;
use File;
use App\Home;
use App\Notification;
class AdminController extends Controller
{
  public $parent =   array();
  public $user_in_downline =   array();
  public $user_keys =   array();
  public $p = 1;

    /**
     * Create a new controller instance.
     *
     * @return void */
    public function __construct()
    {
      $this->middleware('auth:admin');   
      $this->admin = new Admin;
     }


  public function getMyTeamIncome($id)
  {

    if (is_array($id)) {
      $parents = User::whereIn('parent_key', $id)->get();
    } else {
      $array = array($id);
      $parents = User::whereIn('parent_key', $array)->get();
    }
    $users =  array();
    if ($parents->count()) {
      $level = $this->p++;
      foreach ($parents as $key => $value) {
        $users[] = $value->user_key;

        $this->user_in_downline[] =  array($value->user_key);
      }
      $this->getMyTeamIncome($users);
    }
    return $this->user_in_downline;
  }
       public function checkGroupWiseIncome($user_key)
  {
    $cu = User::where('user_key',$user_key)->first();

   $topTeams  =  User::with(['package'])->select('user_key', 'achievement_id')->where('parent_key', $user_key)->get();
  
      $grand_total_income = 0;
      foreach ($topTeams as $top_level) :
        $this->user_in_downline = [];
        $top_level_teams =  $this->getMyTeamIncome($top_level->user_key);
        array_push($top_level_teams, $top_level->user_key);
        $total_income =  UpgradeHistory::select(DB::raw('SUM(packages.amount) as total'))
          ->join('packages', 'upgrade_histories.package_id', '=', 'packages.id')
          ->wherein('user_key', $top_level_teams)
          ->first()['total'];
        $total_income  = ($total_income == null) ? 0 : $total_income;
        $grand_total_income += $total_income;
        $top_level->total_income = $total_income;
      endforeach;
      $cu_achi = ($cu->achievment_id)?$cu->achievment_id+1:1;
        //$achievment = Achievement::whereRaw('? between min and max', [$grand_total_income])->first();
        $achievment = Achievement::find($cu_achi);
               
    //$topTeams = $topTeams->sortByDesc(function($item){
    //return $item->total_income;
//})->values();

    $group_a = $topTeams->splice(0,2);
    dump($grand_total_income);
    dump($achievment->min);
    $group_a_total_income = $group_a->sum('total_income');
    $group_b_total_income = $topTeams->sum('total_income');
     dump($group_a_total_income,$group_b_total_income);    
     if($group_a_total_income >= $achievment->min && $group_b_total_income >= $achievment->min):
        return 1;
    endif;
    return 0;
   

  }
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
     public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect('/admin/login');
    }

    public function getUsers($users)
    {
             $products = User::where('user_key',$user_key)->get(); 
        $dataArray = [];
        foreach ($products as $key => $value) {
               $dataArray[] = array('data'=>$value->user_key,'value'=>$value->id); 
        }
            $my = array('suggestions'=>$dataArray);
         return response()->json($my);

    }

    public function package_desc()
    {

       $package_descs =   PackageDescription::orderby('id','ASC')->get();
        return view('admin.package.desc')->with('package_descs',$package_descs);
    }


    public function package_desc_add()
    {
       $package_names =   Package::all();
       $package_descs =   PackageDescription::orderby('id','ASC')->get();
        return view('admin.package.desc_add')->with('package_names',$package_names)->with('package_descs',$package_descs);
    }

    

    public function package_desc_store(Request $request)
    {
         PackageDescription::create([

        
      'package_id'=>$request->package_id,
      'description'=>$request->editor1,
      ]);

        session::flash("message","Your package description has been added");
        return redirect('/admin/p/description');
     }


     public function package_desc_edit($id)
    {
        $package_descs =   PackageDescription::find($id);
        $package_names = Package::all();
        return view('admin.package.desc_edit',compact('package_descs','package_names'));

    }

     public function package_desc_update(Request $request)
    {
      $package_descs = PackageDescription::find($request->id);
      $package_descs->description = $request->description;
    
      $package_descs->save();

        session::flash("message","Your package has been updated");
        return redirect('/admin/p/description');
    }


    public function index()
    {  
       $Revenue = Payout::where('status',0)->sum('amount');
       $processed = Payment::where('status',2)->sum('amount');
       $under_processed = Payment::where('status',3)->sum('amount');
       $payment_received = Payment::where('status',4)->sum('amount');

       $totalMembers = User::count(); 
       $nonActiveMembers = User::where('package_id',0)->count(); 
       $activeMembers = User::where('package_id','>=',1)->count(); 
       $blockedMembers = User::where('banned',0)->count(); 

       $pinIssued = Pin::count();
       $pinRequestPending = Pin::count();
       return view('admin/dashboard',compact('Revenue','processed','under_processed','payment_received','totalMembers','nonActiveMembers','activeMembers','blockedMembers','pinIssued','pinRequestPending'));
    }

    public function userNotification()
    {  
        $notifications = Notification::all();
       return view('admin.userNotification',compact('notifications'));
    }


    public function userNotificationPush(Request $request)
    {  
         Notification::send($request);
         session::flash("message","Notification has been send");
         return redirect()->back();

    }

    public function userNotificationRemove($id)
    {  
        $notification =  Notification::find($id);
        $notification->delete();
         session::flash("message","Notification has been deleted");
         return redirect()->back();

    }




    public function DailyGenerationIncome()
    {
           \Artisan::call('DailyGenerationIncome');
        session::flash('messages','Daily Generation Income cron has been run');
        return redirect()->back();
    }
    public function redemptionPoint()
    {
       \Artisan::call('redemptionPoint');
       session::flash('messages','Redemption Point cron has been run');
        return redirect()->back();
    }
    public function getAllMessage()
    {
       $messages =  email::where('receiver_id','admin')->get();
       return view('admin.messages',compact('messages'));
    }
    public function getSingleMessage($id)
    {
       $messages =  email::where('id',$id)->get();
       return view('admin.messages',compact('messages'));
    }
    public function registerClient()
    {
       
        return view('admin.clients.registerClient');
    }
  
    public function changPassword()
    {
        return view('admin/changePassword');
    }
  
    public function updatePassword(Request $request)
    {
      $clientsUsers = DB::table('admins')
            ->where('id',Auth::guard('admin')->user()->id)
            ->update([
                'password'=>bcrypt($request->npassword),
            ]);
        Session::flash('message', 'Password has been updated');
        return redirect('/admin/dashboard');
    }

    public function updateTXPassword(Request $request)
    {
      if(auth::guard('admin')->user()->system_password==$request->password){

        $users = DB::table('admins')->update([
                        'system_password'=>$request->system_password,
                    ]);
          session::flash('message','Password changed');
        }else{
          session::flash('message','Old password invalid');

        }
      return redirect()->back();
    }

    public function PayUserManualPermission(Request $request)
    { 
        if(auth::guard('admin')->user()->system_password==$request->password){
            User::where('user_key', $request->user_key)->update(['is_allowed_for_level_income'=>$request->is_allowed_for_level_income,'allowed_limit'=>$request->allowed_limit]);
            Session::flash('message','Permission Granted');
        }else{
            Session::flash('message','Invalid password');
        }
        return redirect()->back();
    }

   
}
