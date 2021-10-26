<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Pin;
use App\AssignPin;
use App\ReferenceLead;
use App\FollowupLead;
use App\VisitLead;
use App\DigitalLead;
use App\Payment;
use App\WinnersClub;
use App\UserWalletLog;
use Auth,DB;
class User extends Authenticatable
{
    
    protected $guarded = [];
    use NodeTrait;
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   protected $fillable = [
  'user_key',
  'user_name',
  'transaction_password',
  'parent_key',
  'is_eligible',
  'sponsor_key',
  'banned',
  'package_id',
  'package_type_id',
  'pin_number',
  'leg',
  'name',
  'email',
  'password',
  'mobile',
  'mobile1',
  'occupation',
  'pan',
  'dob',
  'gender',
  'address1',
  'address2',
  'address3',
  'country',
  'state',
  'city',
  'pincode',
  'wallet',
  'ip',
  'is_online',
  'parent_id',
  'eCommerce_wallet',
  'admin_password',
  'date',
  'nominee_name',
  'nominee_relation',

  'aadhaar_no',
  'adhaar_front',
  'adhaar_back',
  'pan_document',
  'package_activate_date',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public $user_data=array();
    public $user_data_left=   array();
    public $user_data_right=   array();

    // Specify parent id attribute mutator
    public function setParentAttribute($value)
    {
      $this->setParentIdAttribute($value);
    }
    public function autoPool()
    {
      return $this->belongsTo('App\UserAutoPool');
    }
    public function city_name()
    {
        return $this->belongsTo('App\City','city','id');
    }
    public function state_name()
    {
        return $this->belongsTo('App\State','state','id');
    }

     public function bankDetails()
    {
        return $this->hasOne('App\UserBankDetail','user_key','user_key');
    }

     public function myRefLeads()
    {
        return $this->hasMany('App\ReferenceLead','user_key','user_key');
    }


    public function tree()
    {
        return $this->hasOne('App\Tree');
    }

    public static function getName($data)
    {
        return $data;
    }

    public function updateWallet($data,$created_by,$user_type)
    {

        $user = User::where('user_key',$data->user_key)->first();
        $new_wallet = $user->wallet+ $data->add_amount;

        UserWalletLog::create([
            'user_key'=>$data->user_key,
            'old_wallet'=>$user->wallet,
            'add_amount'=>$data->add_amount,
            'new_wallet'=>$new_wallet,
            'admin_id'=>$created_by,
            'user_type'=>$user_type
        ]);
        User::where('user_key',$data->user_key)->update(['wallet'=>$new_wallet]);

    }
    public function getAddedBy()
    {
      /*0 Admin,1=APC,2:User,3-DPC*/  
      $pinData =   Pin::where('pin_number',auth::user()->pin_number)->first();
      if ($pinData==null) {
            $data  = array('created_by' =>'Admin');
            return $data;
      }
      if ($pinData->created_by==1) {
            $apc =  APC::where('apc_key',$pinData->user_key)->first();
            $data  = array('created_by' =>'APC','apc_key'=>$apc->apc_key,'apc_name'=>$apc->name );
      }elseif ($pinData->created_by==2) {
            $data  = array('created_by' =>'User');
          
      }elseif ($pinData->created_by==3) {
            $data  = array('created_by' =>'DPC');
                  
      }else{
            $data  = array('created_by' =>'Admin');
      }
      return $data;
    }

    public function infoGetAddedBy($user)
    {
      /*0 Admin,1=APC,2:User,3-DPC*/  
      $pinData =   Pin::where('pin_number',$user->pin_number)->first();
      if ($pinData==null) {
            $data  = array('created_by' =>'Admin');
            return $data;
      }
      if ($pinData->created_by==1) {
            $apc =  APC::where('apc_key',$pinData->user_key)->first();
            $data  = array('created_by' =>'APC','apc_key'=>$apc->apc_key,'apc_name'=>$apc->name );
      }elseif ($pinData->created_by==2) {
            $data  = array('created_by' =>'User');
          
      }elseif ($pinData->created_by==3) {
            $data  = array('created_by' =>'DPC');
                  
      }else{
            $data  = array('created_by' =>'Admin');
      }
      return $data;
    }

    public function package()
    {
        return $this->belongsTo('App\Package');
    }



     public function packageVerification($package_id,$pin)
    {
       $resp =  Pin::where('package_id',$package_id)->where('pin_number',$pin)->wherenotin('status',[0])->count();
        if ($resp){
            return 1;
        }else{
            return 0;
        }
    }

    public function payout()
    {
      return $this->hasmany('App\Payout','user_key','user_key');
    }

   public function Revenue()
    {
      return Payout::where('user_key',auth::user()->user_key)->where('status',0)->sum('amount');
    }

    public function TotalRevenue()
    {
      return Payout::where('user_key',auth::user()->user_key)->where('status',0)->sum('earning');
    }
    
    public function generated()
    {
      return Payout::where('user_key',auth::user()->user_key)->where('status',0)->sum('amount');
    }
    
   public function Binary()
    {
      return Payout::where('user_key',auth::user()->user_key)->where('business_area_id',1)->sum('earning');
    }
   public function Sponsor()
    {
      return Payout::where('user_key',auth::user()->user_key)->where('business_area_id',2)->sum('earning');
    }
   
   public function LevelIncome()
    {
      return Payout::where('user_key',auth::user()->user_key)->where('business_area_id',3)->sum('earning');
    }

    public function RewardBonus()
    {
      return Payout::where('user_key',auth::user()->user_key)->where('business_area_id',20)->sum('earning');
    }

    public function PropertySaving()
    {
      return Payout::where('user_key',auth::user()->user_key)->sum('PST');
    }
    
    
   
    
    
   public function SponsorDetails($user_key)
    {
      return User::where('user_key',$user_key)->first();
    }
  public function ActivePin()
    {
      return AssignPin::where('user_key',auth::user()->user_key)->where('status',1)->count();
    }

  public function paymentReceived()
    {
      return Payment::where('user_key',auth::user()->user_key)->where('status',3)->sum('amount');
    }

    public function digitalTotal()
    {
      return DigitalLead::where('user_key',auth::user()->user_key)->count();
    }

    public function followUpTotal()
    {
      return FollowupLead::where('user_key',auth::user()->user_key)->count();
    }

    public function visitTotal()
    {
      return VisitLead::where('user_key',auth::user()->user_key)->count();
    }

    public function SeminarTotal()
    {
      return SeminarLead::where('user_key',auth::user()->user_key)->count();
    }

    
    




public function getLeftCount($id,$leg)
    {
 
          if(is_array($id)){
                 $parents = User::whereIn('parent_key',$id)->get();
          }else{
             $array =array($id);

             $parents = User::whereIn('parent_key',$array)->where('leg',$leg)->get();
          }

          if ($parents->count()) {
            $users_data_left = [];
               foreach ($parents as $key => $value) {
                       $users_data_left[]=  $value->user_key;
                        $city_name= 'NA';
                        if (isset($value->city_name->name)) {
                        $city_name =$value->city_name->name;
                        }
                        $packagename = "Yet to update";
                        if (isset($value->package->name)) {
                        $packagename =$value->package->name;
                        }

                       $this->user_data_left[]= array(
                                                    'ip' =>$value->ip,
                                                    'is_online'=>$value->is_online,
                                                    'leg'=>$value->leg,
                                                    'created_at'=>$value->created_at,
                                                    'user_key'=>$value->user_key,
                                                    'name'=>$value->name,
                                                    'sponsor_key'=>$value->sponsor_key,
                                                    'parent_key'=>$value->parent_key,
                                                    'city'=>$city_name,
                                                    'mobile'=>$value->mobile,
                                                    'package_name'=>$packagename
                                                    );
          
              }
              $this->getLeftCount($users_data_left,$leg);
          }
               
        return  $this->user_data_left;


    }
public function getRightCount($id,$leg)
    {
 
          if(is_array($id)){
                 $parents = User::whereIn('parent_key',$id)->get();
          }else{
             $array =array($id);

             $parents = User::whereIn('parent_key',$array)->where('leg',$leg)->get();
          }

          if ($parents->count()) {
            $users_data_right = [];
               foreach ($parents as $key => $value) {
                       $users_data_right[]=  $value->user_key;
                           $city_name= 'NA';
                       if (isset($value->city_name->name)) {
                           $city_name =$value->city_name->name;
                       }
                       $packagename = "Yet to update";
                       if (isset($value->package->name)) {
                         $packagename = $value->package->name;
                       }
                       $this->user_data_right[]= array(
                                                    'ip' =>$value->ip,
                                                    'is_online'=>$value->is_online,
                                                    'leg'=>$value->leg,
                                                    'created_at'=>$value->created_at,
                                                    'user_key'=>$value->user_key,
                                                    'name'=>$value->name,
                                                    'sponsor_key'=>$value->sponsor_key,
                                                    'parent_key'=>$value->parent_key,
                                                    'city'=> $city_name,
                                                    'mobile'=>$value->mobile,
                                                    'package_name'=>$packagename
                                                    );
          
              }
              $this->getRightCount($users_data_right,$leg);
          }
               
        return   $this->user_data_right;


    }

    /*For Admin */
    public function getUsers()
    {

         $orderby = 'created_at';
          $q = User::select('*');
            $response = $q->orderBy($orderby, 'DESC')
            ->paginate(100);
        return $response;
    }

     public function getUsersSearch($limit, $offset, $search, $orderby, $order,$package_id)
    {

         $orderby = 'created_at';
        $order = $order ? $order : 'desc';
          $q = User::select('*');
        if ($search && !empty($search)) {
        $q->where('name', 'LIKE', '%' . $search . '%');
        $q->orwhere('user_key', 'LIKE', '%' . $search . '%');
        $q->orwhere('mobile', 'LIKE', '%' . $search . '%');
        $q->orwhere('sponsor_key', 'LIKE', '%' . $search . '%');
        }
      if ($package_id) {
        $q->orwhere('package_id', $package_id);
      }
     
        $response = $q->orderBy($orderby, $order)
        ->get();
        return $response;
    }
    /*For Admin */


    public function mySelfSponsor($user_key)
    {
        return User::where('sponsor_key',$user_key)->where('package_id',1)->count();
//      return User::select(DB::raw('count("id")as count'),'leg')->where('sponsor_key',$user_key)->groupby('leg')->get();
    }


    public function getUserInfo($user_key)
    {
      return User::where('user_key',$user_key)->first();

    }
    public function bonusClub()
    {
      return $this->belongsTo('App\BonusClub');
    }
    public function AutoPoolClub()
    {
      return $this->belongsTo('App\AutoPoolClub');
    }
    
    public function winnerClub()
    {
      return $this->belongsTo('App\WinnersClub','winners_club_id','id');
    }
    
    public function haveTodayRef()
    {
        return $this->hasOne('App\ReferenceLead','user_key','user_key')->where('date',date('Y-m-d'));
    }
    public function haveProperty()
    {
        return $this->belongsTo('App\PropertyAllotment','user_key','user_key');
    }
    public function myProperty()
    {
        return $this->hasOne('App\PropertyAllotment','user_key','user_key');
    }

}
