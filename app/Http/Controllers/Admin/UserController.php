<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\User;
use Hash;
use App\UserBankDetail;
use App\GenerationIncome;
use App\Package;
use App\Pin;
use App\Payout;
use App\Activity;
use App\UserDocuments;
use App\Charge;
use App\UserBankDetailHistory;
use App\BusinessArea;
use App\Tree;
use App\AssociateModule;
use App\Document;
use App\UpgradePackage;
use App\UserAutoPool;
use App\UserAchievement;
use App\UpgradeHistory;

use Session,DB;
class UserController extends Controller
{
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
public function __construct()
{   
  $this->middleware('auth:admin');
$this->tree  = new Tree();
$this->user  = new User();
$this->associateModule  = new AssociateModule();
 $this->UpgradePackage  = new UpgradePackage();
}
public function index(Request $request)
{
      $packages  = Package::all();
  if ($request->start==null || $request->end==null) {
    # code...


      if($request->package_id==null || $request->package_id==0){
         $package_id = 0;
          if ($request->user_key==null) {
                     $users = User::orderBy('id', 'DESC')->paginate(50);

          }else{
                       $users = User::where('user_key', $request->user_key)
                                      ->orWhere('mobile',$request->user_key) //Copy past this line
                                      ->orWhere('name','LIKE','%'.$request->user_key.'%') //Copy past this line
                                      ->paginate();

          }

        


      }else{
        $package_id = $request->package_id;
        $users = User::orderBy('id', 'DESC')->where('package_id',$request->package_id)->paginate(50);
      }
  }else{
    $package_id = 0;
    $users = User::whereBetween('created_at', [$request->start, $request->end])->paginate(50);

  }
    	return view('admin/user/list',compact('packages','users','package_id'));

}


public function active(Request $request)
{
      $packages  = Package::all();
  if ($request->start==null || $request->end==null) {
    # code...


      if($request->package_id==null || $request->package_id==0){
         $package_id = 0;
          if ($request->user_key==null) {
                     $users = User::orderBy('id', 'DESC')->where('package_id','>=',1)->paginate(50);

          }else{
                       $users = User::where('user_key', $request->user_key)
                                      ->where('package_id','>=',1)
                                      ->orWhere('mobile',$request->user_key) //Copy past this line
                                      ->orWhere('name','LIKE','%'.$request->user_key.'%') //Copy past this line
                                      ->paginate();

          }

        


      }else{
        $package_id = $request->package_id;
        $users = User::orderBy('id', 'DESC')->where('package_id',$request->package_id)->paginate(50);
      }
  }else{
    $package_id = 0;
    $users = User::whereBetween('created_at', [$request->start, $request->end])->paginate(50);

  }
      return view('admin/user/list',compact('packages','users','package_id'));

}




public function userListSearch(Request $request,$package_id)
{
if ($request->ajax()) {
            $totalUser = User::count();
            $limit = $request->input('length');
            $start = $request->input('start');
            $search = $request['search']['value'];
            $orderby = $request['order']['0']['column'];
            $order = $orderby != "" ? $request['order']['0']['dir'] : "";
            $draw = $request['draw'];
            $response = $this->user->getUsersSearch($limit, $start, $search, $orderby ,$order,$package_id);
            $rowData= $this->getUserCompactData($response);
             return  [
                "draw" => intval($draw),
                "recordsFiltered" =>count($rowData),
                "recordsTotal" => count($rowData),
                "data" => $rowData
            ];

 }  
}
public function userList()
{
          
              return  $data;
	

}


public function CashBackUserList()
{
    $packages = Package::with("genUsers")->whereNotIn('package_type_id',['3','4'])->get();
    return view('admin/user/cashBackAchievers/list',compact('packages'));
}


public function CashBackUserListDetails()
{
    return view('admin/user/cashBackAchievers/details');
}



public function getUserUpperLevel($user_key)
{
    $GenerationIncome = new GenerationIncome();
    $user_keys = $GenerationIncome->directUpperLevel($user_key,$user_key);
    $users = User::wherein('user_key',$user_keys)->orderby('created_at','DESC')->get();
    return view('admin/user/cashBackAchievers/upperList',compact('users'));
}




public function CashBackUserSave()
{
   $packages = Package::with(["genUsers","levelLimit"])->whereNotIn('package_type_id',['3','4'])->get();
    
      $GenerationIncome = new GenerationIncome();
      // $levels = DB::table('binary_levels')->get();
      //    $adverLevelNew = [];
      //             foreach ($levels as $key => $level) {
      //             $adverLevelNew[] = $level->percentage;
      //             }

      $charges = Charge::all();
      $adminCharges =  $charges[0]->percentage;
      $TDSpercent =  $charges[1]->percentage;
            foreach($packages as $key=>$value){
                foreach($value->genUsers as $key=>$user)
                {
                      $isPay=1;
                      $earning =$user->package->amount*$user->package->instant_cash_back/100;
                      if ($user->paid_month==0) {
                      
                      $satrtdate   =  date('Y-m-d',  strtotime($user->created_at));
                      $to = \Carbon\Carbon::createFromFormat('Y-m-d', $satrtdate);
                      $from = \Carbon\Carbon::createFromFormat('Y-m-d',date('Y-m-t'));
                      $diff_in_days = $to->diffInDays($from);
                      $amount  = $user->package->amount/30;
                      $Namount=$amount*$diff_in_days;
                      $earning= $Namount* $user->package->instant_cash_back/100;
                          if ($to > $from) {
                            $isPay=0;
                          }

                      }
                      if ($isPay) { 
                          $message = "instant_cash_back  " . $user->user_key;
                          Payout::pay($user->user_key, $earning, 4, 0, $message, 1);
                          if ($user->package->package_type_id==1) {
                          $levelLimit = $value->levelLimit;
                          $GenerationIncome->DirectLevelWise($user->user_key,$levelLimit,3,$earning,$adminCharges,$TDSpercent,$user->user_key);
                          }
                          $user->paid_month   =  date('m');
                          $user->save();
                      }
                }

            }
          
    session::flash("message","Done");
    return redirect()->back();
}

public function getUserCompactData($response)
{
   $i = 1;
            $rowData = [];
            foreach ($response as $keyUser =>$row) {
                $payoutSum = 0;
                if($row->signed_invoice==0){
                    $invoice_status ="<small class='label label-primary'>Yet to upload</small>"; 
                }elseif($row->signed_invoice==1){
                     $invoice_status ="<small class='label label-info'>Pending Review</small>"; 
                }
                elseif($row->signed_invoice==2){
                $invoice_status ="<small class='label label-success'> Verified</small>  ".'<br>'.date('d-m-Y H:i:s',strtotime($row->invoice_verified_at)).'<br>'.'<a  href="'.env('base_url').'assets/documents/'.$row->signed_invoice_doc.'" >View</a>'; 
                }elseif($row->signed_invoice==3){
                $invoice_status ="<small class='label label-danger'> Not Verified</small> at ".$row->invoice_verified_at.'<br>'.'<a href="'.env('base_url').'assets/documents/'.$row->signed_invoice_doc.'">View</a>'; 
                }

                $dataTeam = $this->getPVDetails($row->user_key);
                foreach ($row->payout as $key => $payout) {
                  $payoutSum += $payout->amount;
                }
            $u['id']=$keyUser+1;
            $u['user_key']=$row->user_key;
            $u['name']=$row->name;
            $u['package_name']=$row->package->name;
            $u['total_team']=$dataTeam['total_team'];
            $u['sponsor_key']=$row->SponsorDetails($row->sponsor_key)->user_key.' / '.$row->SponsorDetails($row->sponsor_key)->name;
            $u['admin_password']=$row->admin_password;
            $u['mobile']=$row->mobile;
            $u['payoutSum']=$payoutSum;
            $u['invoice_status']=$invoice_status;
            $u['created_at']= date('d-m-Y',strtotime($row->created_at));
            $actions = view('admin/user/userAction', ['row'=>$row]);
            $u['actions'] = $actions->render();
            $rowData[] = $u;
                }

            
            return $rowData;  
}

public function getPVDetails($user_key)
{
			 	      $left  =  $this->getLeftRightCountPackageWise(0,$user_key);
                      $right =  $this->getLeftRightCountPackageWise(1,$user_key);
                      $sumCount  = $left['count']+ $right['count'];
                      $sumPV  = $left['point_value']+ $right['point_value'];


                      return  array(
                      				   'leftTeamCount'=> $left['count'],
                      				   'rightTeamCount'=> $right['count'],
                      				   'rightPV'=> $right['point_value'],
                      				   'leftPV'=>$left['point_value'],
                      				   'total_team' =>$sumCount,
                      				   'total_PV'=> $sumPV 
                      			    ); 
}
 public function getLeftRightCountPackageWise($leg,$user_key)
    {
      
        $child =   User::where('parent_key',$user_key)->where('leg',$leg)->first();
        if (isset($child->id)) {
           $data = DB::table('users')
                   ->select('packages.name as package_name',DB::raw('sum(point_value) as point_value'),DB::raw('count(user_key) as count'))
                    ->join('packages','packages.id','=','users.package_id')
                    ->whereBetween('_lft', [$child->_lft, $child->_rgt])
                    ->first();       
            if (isset($data->point_value)) {
            	 return   array('point_value'=>$data->point_value,'count'=>$data->count);
           }else{
             	return   array('point_value'=>0,'count'=>0); 
           }


        }else{
             return   array('point_value'=>0,'count'=>0); 
        }
    }
public function Package1()
{
return view('admin/user/list')->with('users',User::orderby('created_at','DESC')->where('package_id','1')->paginate(15));
}
public function Package2()
{
return view('admin/user/list')->with('users',User::orderby('created_at','DESC')->where('package_id','2')->paginate(15));
}
public function Package3()
{
return view('admin/user/list')->with('users',User::orderby('created_at','DESC')->where('package_id','3')->paginate(15));
}

/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
public function latestPayout()
{
$users =  Payout::orderby('created_at','DESC')->groupby('user_key')->get();
return view('admin/user/latest_payout',compact('users'));
}
public function userActivity()
{
$activities =  Activity::all();
return view('admin/user/activity/list',compact('activities'));
}
public function approveKYC($status=1)
{
  $users =   User::where('is_pan_verified',$status)->orWhere('is_adhaar_verified',$status)->orderby('created_at','DESC')->get();
  return view('admin/user/approveKYC',compact('users'));
}
public function approveBankKyc($status=1)
{
	  $users =   User::where('is_bank_details_update',$status)->orderby('created_at','DESC')->get();
	  return view('admin/user/approveBankKYC',compact('users'));
}

public function approveInvoice($status=1)
{
  $users =   User::where('signed_invoice',$status)->orderby('created_at','DESC')->get();
return view('admin/user/approveInvoice',compact('users'));
}

public function getUserBankUpdateHistories($user_key,$user_id)
{
  $users =   UserBankDetailHistory::where('user_key',$user_key)->orderby('created_at','DESC')->get();
  return view('admin/user/userUpdateBankHistory',compact('users','user_id'));
}



public function lifeTimeAchievers()
{
  $lifeTimeAchievers = UserAchievement::groupby('achievement_id')->get();
  return view('admin/user/lifeTimeAchievers/list',compact('lifeTimeAchievers'));
}

public function lifeTimeAchieversUsers($achievement_id)
{
  $lifeTimeAchieversUsers = UserAchievement::where('achievement_id',$achievement_id)->orderby('achievement_date','DESC')->get();
  return view('admin/user/lifeTimeAchievers/details',compact('lifeTimeAchieversUsers'));
}

public function lifeTimeAchieversUsersPayout($user_key,$business_area_id)
{
  $lifeTimeAchieversUsersPayout = Payout::where('business_area_id',$business_area_id)->where('user_key',$user_key)->get();
  return view('admin/user/lifeTimeAchievers/payout',compact('lifeTimeAchieversUsersPayout'));
}



public function cashBackAchievers()
{
  return view('admin/user/cashBackAchievers/list');
}


public function AllLeads()
{
  return view('admin/user/AllLeads');
}

public function ReferenceLeadsAll(Request $request, $status=0)
{
  
  $status = $request->status;
  $ReferenceLeadsByUsers= ReferenceLead::where('status',$status)->get();
  
  return view('admin/user/ReferenceLeadsByUsers/listAll',compact('ReferenceLeadsByUsers','status'));
}

public function ReferenceLeadsByUsers(Request $request ,$user_key)
{
  if ($request->status==null) {
    $status = 'all';
    $ReferenceLeadsByUsers= ReferenceLead::where('user_key',$user_key)->get();
  }else{
  $status = $request->status;
  $ReferenceLeadsByUsers= ReferenceLead::where('user_key',$user_key)->where('status',$status)->get();
  }
  return view('admin/user/ReferenceLeadsByUsers/list',compact('ReferenceLeadsByUsers','status','user_key'));
}

public function ReferenceLeadsChangeStatus($user_key,$reference_lead_id,$status)
{
$user = User::where('user_key',$user_key)->first();

  $ReferenceLeadsByUsers= ReferenceLead::where('user_key',$user_key)->where('id',$reference_lead_id)->first();
  $ReferenceLeadsByUsers->status = $status;
  $ReferenceLeadsByUsers->accepted_at = date('Y-m-d');
  $ReferenceLeadsByUsers->save();
$charges = Charge::all();
// 0 = admin Charges,1=TDS,2= Binary,4=PST
$TDMCharges = [$charges[0]->percentage,$charges[0]->percentage,$charges[1]->percentage,$charges[3]->percentage];
$message = "For lead ".$ReferenceLeadsByUsers->name." ".$ReferenceLeadsByUsers->phone.' request accepted';

$amount=$user->package->cost_per_lead;
Activity::lock($message,$user_key,3,1000);

Payout::pay($user_key,$amount,$TDMCharges[0],$TDMCharges[1],$TDMCharges[3],3,$status=1,$message);
return redirect()->back();
}
public function rejectRefLead(Request $request)
{
  $ReferenceLeadsByUsers= ReferenceLead::where('user_key',$request->user_key)->where('id',$request->id)->first();
  $ReferenceLeadsByUsers->status = 2;
  $ReferenceLeadsByUsers->message = $request->message;
  $ReferenceLeadsByUsers->save();
  return redirect()->back();
}


// Follow Up

public function FollowUpLeadsAll(Request $request, $status=0)
{
  
  $status = $request->status;
  $FollowupLeadsByUsers= FollowupLead::where('status',$status)->get();
  
  return view('admin/user/FollowupLeadsByUsers/listAll',compact('FollowupLeadsByUsers','status'));
}

public function FollowUpByUsers(Request $request ,$user_key)
{
  if ($request->status==null) {
    $status = 'all';
    $FollowupLeadsByUsers= FollowupLead::where('user_key',$user_key)->get();
  }else{
  $status = $request->status;
  $FollowupLeadsByUsers= FollowupLead::where('user_key',$user_key)->where('status',$status)->get();
  }
  return view('admin/user/FollowupLeadsByUsers/list',compact('FollowupLeadsByUsers','status','user_key'));
}

public function FollowUpChangeStatus($user_key,$reference_lead_id,$status)
{
  $FollowupLeadsByUsers= FollowupLead::where('user_key',$user_key)->where('id',$reference_lead_id)->first();
  $FollowupLeadsByUsers->status = $status;
  $FollowupLeadsByUsers->accepted_at = date('Y-m-d');
  $FollowupLeadsByUsers->save();

return redirect()->back();
}
public function rejectFollowupLead(Request $request)
{
  $FollowupLeadsByUsers= FollowupLead::where('user_key',$request->user_key)->where('id',$request->id)->first();
  $FollowupLeadsByUsers->status = 2;
  $FollowupLeadsByUsers->message = $request->message;
  $FollowupLeadsByUsers->save();
  return redirect()->back();
}


// Follow Up



// Seminar Up

public function SeminarLeadsAll(Request $request, $status=0)
{
  
  $status = $request->status;
  $SeminarLeadsByUsers= SeminarLead::where('status',$status)->get();
  
  return view('admin/user/SeminarLeadsByUsers/listAll',compact('SeminarLeadsByUsers','status'));
}

public function SeminarByUsers(Request $request ,$user_key)
{
  if ($request->status==null) {
    $status = 'all';
    $SeminarLeadsByUsers= SeminarLead::where('user_key',$user_key)->get();
  }else{
  $status = $request->status;
  $SeminarLeadsByUsers= SeminarLead::where('user_key',$user_key)->where('status',$status)->get();
  }
  return view('admin/user/SeminarLeadsByUsers/list',compact('SeminarLeadsByUsers','status','user_key'));
}

public function SeminarChangeStatus($user_key,$reference_lead_id,$status)
{
  $SeminarLeadsByUsers= SeminarLead::where('user_key',$user_key)->where('id',$reference_lead_id)->first();
  $SeminarLeadsByUsers->status = $status;
  $SeminarLeadsByUsers->accepted_at = date('Y-m-d');
  $SeminarLeadsByUsers->save();

  return redirect()->back();
}
public function rejectSeminarLead(Request $request)
{
  $SeminarLeadsByUsers= SeminarLead::where('user_key',$request->user_key)->where('id',$request->id)->first();
  $SeminarLeadsByUsers->status = 2;
  $SeminarLeadsByUsers->message = $request->message;
  $SeminarLeadsByUsers->save();
  return redirect()->back();
}


// Seminar Up



// Digital Lead

public function DigitalLeadsAll(Request $request, $status=0)
{
  
  $status = $request->status;
  $DigitalLeadByUsers= DigitalLead::where('status',$status)->get();
  
  return view('admin/user/DigitalLeadByUsers/listAll',compact('DigitalLeadByUsers','status'));
}

public function DigitalLeadsByUsers(Request $request ,$user_key)
{
  dd();
  if ($request->status==null) {
    $status = 'all';
    $DigitalLeadByUsers= DigitalLead::where('user_key',$user_key)->get();
  }else{
  $status = $request->status;
  $DigitalLeadByUsers= DigitalLead::where('user_key',$user_key)->where('status',$status)->get();
  }
  return view('admin/user/DigitalLeadByUsers/list',compact('DigitalLeadByUsers','status','user_key'));
}

public function DigitalLeadsChangeStatus($user_key,$reference_lead_id,$status)
{
  $DigitalLeadByUsers= DigitalLead::where('user_key',$user_key)->where('id',$reference_lead_id)->first();
  $DigitalLeadByUsers->status = $status;
  $DigitalLeadByUsers->accepted_at = date('Y-m-d');
  $DigitalLeadByUsers->save();

return redirect()->back();
}
public function DigitalLead(Request $request)
{
  $DigitalLeadByUsers= DigitalLead::where('user_key',$request->user_key)->where('id',$request->id)->first();
  $DigitalLeadByUsers->status = 2;
  $DigitalLeadByUsers->message = $request->message;
  $DigitalLeadByUsers->save();
  return redirect()->back();
}


public function rejectDigitalLead(Request $request)
{
  $DigitalLeadByUsers= DigitalLead::where('user_key',$request->user_key)->where('id',$request->id)->first();
  $DigitalLeadByUsers->status = 2;
  $DigitalLeadByUsers->message = $request->message;
  $DigitalLeadByUsers->save();
  return redirect()->back();
}


// Digital Lead



// Visit Lead

public function VisitLeadsAll(Request $request, $status=0)
{
  
  $status = $request->status;
  $VisitLeadByUsers= VisitLead::where('status',$status)->get();
  
  return view('admin/user/VisitLeadByUsers/listAll',compact('VisitLeadByUsers','status'));
}

public function VisitLeadsByUsers(Request $request ,$user_key)
{
  if ($request->status==null) {
    $status = 'all';
    $VisitLeadByUsers= VisitLead::where('user_key',$user_key)->get();
  }else{
  $status = $request->status;
  $VisitLeadByUsers= VisitLead::where('user_key',$user_key)->where('status',$status)->get();
  }
  return view('admin/user/VisitLeadByUsers/list',compact('VisitLeadByUsers','status','user_key'));
}

public function VisitLeadsChangeStatus($user_key,$reference_lead_id,$status)
{
  $VisitLeadByUsers= VisitLead::where('user_key',$user_key)->where('id',$reference_lead_id)->first();
  $VisitLeadByUsers->status = $status;
  $VisitLeadByUsers->accepted_at = date('Y-m-d');
  $VisitLeadByUsers->save();

return redirect()->back();
}
public function rejectVisitLead(Request $request)
{
  $VisitLeadByUsers= VisitLead::where('user_key',$request->user_key)->where('id',$request->id)->first();
  $VisitLeadByUsers->status = 2;
  $VisitLeadByUsers->message = $request->message;
  $VisitLeadByUsers->save();
  return redirect()->back();
}


// Visit Lead


// Registry Forms

public function registryFormsAll(Request $request, $status=0)
{
  if($request->status){
  $status = $request->status;
  }
else
{
  $status = 0;
}
  $RegistryFormByUsers= RegistryForm::where('status',$status)->get();
  
  return view('admin/user/RegistryFormByUsers/listAll',compact('RegistryFormByUsers','status'));
}

public function registryFormsByUsers(Request $request ,$user_key)
{
  if ($request->status==null) {
    $status = 'all';
    $RegistryFormByUsers= RegistryForm::where('user_key',$user_key)->get();
  }else{
  $status = $request->status;
  $RegistryFormByUsers= RegistryForm::where('user_key',$user_key)->where('status',$status)->get();
  }
  return view('admin/user/RegistryFormByUsers/list',compact('RegistryFormByUsers','status','user_key'));
}

public function registryFormsChangeStatus($user_key,$reference_lead_id,$status)
{
  $RegistryFormByUsers= RegistryForm::where('user_key',$user_key)->where('id',$reference_lead_id)->first();
  $RegistryFormByUsers->status = $status;
  $RegistryFormByUsers->accepted_at = date('Y-m-d');
  $RegistryFormByUsers->save();

return redirect()->back();
}
public function registryFormsReject(Request $request)
{
  $RegistryFormByUsers= RegistryForm::where('user_key',$request->user_key)->where('id',$request->id)->first();
  $RegistryFormByUsers->status = 2;
  $RegistryFormByUsers->message = $request->message;
  $RegistryFormByUsers->save();
  return redirect()->back();
}


public function registryFormsAccept(Request $request)
{

  $folderPath = 'assets/user/'. Auth::user()->id.'/documents';
  $RegistryFormByUsers= RegistryForm::where('user_key',$request->user_key)->where('id',$request->id)->first();

  if ($request->hasFile('doc1')) {
            $file = $request->file('doc1');
            $doc1 = rand() . $file->getClientOriginalName();
            $file->move($folderPath, $doc1);
            $RegistryFormByUsers->doc1 = $doc1;
        }

        if ($request->hasFile('doc2')) {
            $file = $request->file('doc2');
            $doc2 = rand() . $file->getClientOriginalName();
            $file->move($folderPath, $doc2);
            $RegistryFormByUsers->doc2 = $doc2;
        }
        
        if ($request->hasFile('doc3')) {
            $file = $request->file('doc3');
            $doc3 = rand() . $file->getClientOriginalName();
            $file->move($folderPath, $doc3);
            $RegistryFormByUsers->doc3 = $doc3;
        }
        if ($request->hasFile('doc4')) {
            $file = $request->file('doc4');
            $doc4 = rand() . $file->getClientOriginalName();
            $file->move($folderPath, $doc4);
            $RegistryFormByUsers->doc4 = $doc4;
        }
        
        if ($request->hasFile('doc5')) {
            $file = $request->file('doc5');
            $doc5 = rand() . $file->getClientOriginalName();
            $file->move($folderPath, $doc5);
            $RegistryFormByUsers->doc5 = $doc5;
        }
        
        
  $RegistryFormByUsers->status = 1;


  $RegistryFormByUsers->save();

  Session::flash('message','Accepted and document uploaded');
  return redirect()->back();
}



public function registryFormsedit($id)
    {
        $RegistryForm = RegistryForm::find($id);
        return view('admin/user/RegistryFormByUsers/edit',compact('RegistryForm'));

    }


    public function registryFormsupdate(Request $request)
    {
      $folderPath = 'assets/user/'. Auth::user()->id.'/documents';
         $RegistryForm = RegistryForm::find($request->id);
          $RegistryForm->user_key =     $request->user_key;
          $RegistryForm->property_allotment_id =     $request->property_allotment_id;
          $RegistryForm->purchasers_name =     $request->purchasers_name;
          $RegistryForm->fathers_name =     $request->fathers_name;
          $RegistryForm->address =     $request->address;
          $RegistryForm->state =     $request->state;
          $RegistryForm->pincode =     $request->pincode;
          $RegistryForm->dob =     $request->dob;
          $RegistryForm->age =     $request->age;
          $RegistryForm->phone =     $request->phone;
          $RegistryForm->alt_phone =     $request->alt_phone;
          $RegistryForm->aadhaar_number =     $request->aadhaar_number;
          $RegistryForm->pan =     $request->pan;
          $RegistryForm->occupation =     $request->occupation;
          $RegistryForm->religion =     $request->religion;
          $RegistryForm->customer_bank_name =     $request->customer_bank_name;
          $RegistryForm->company_bank_name =     $request->company_bank_name;
          $RegistryForm->paid_amount =     $request->paid_amount;
          $RegistryForm->cheque_utr_no =     $request->cheque_utr_no;
          $RegistryForm->date_of_payment =     $request->date_of_payment;
          $RegistryForm->pay_mode =     $request->pay_mode;
          $RegistryForm->project_name =     $request->project_name;
          $RegistryForm->phase_no =     $request->phase_no;
          $RegistryForm->unit_no =     $request->unit_no;
          $RegistryForm->plot_1 =     $request->plot_1;
          $RegistryForm->plot_2 =     $request->plot_2;
          $RegistryForm->plot_size =     $request->plot_size;
          $RegistryForm->rate =     $request->rate;
          $RegistryForm->tnc_checked =     $request->tnc_checked;
          $RegistryForm->status =     0;

        if($request->hasFile('transaction_proof')){
            $file=$request->file('transaction_proof');
            $transaction_proof = Auth::user()->id.'_'.rand().'_'.$file->getClientOriginalName();
            $file->move($folderPath, $transaction_proof);
            $RegistryForm->transaction_proof  =  $transaction_proof;
        }

        if ($request->hasFile('pan_documents')) {
            $file = $request->file('pan_documents');
            $pan_documents = rand() . $file->getClientOriginalName();
            $file->move($folderPath, $pan_documents);
            $RegistryForm->pan_document = $pan_documents;
        }
        if ($request->hasFile('adhaar_front')) {
            $file = $request->file('adhaar_front');
            $adhaar_front = rand() . $file->getClientOriginalName();
            $file->move($folderPath, $adhaar_front);
            $RegistryForm->adhaar_front = $adhaar_front;
        }
        if ($request->hasFile('adhaar_back')) {
            $file = $request->file('adhaar_back');
            $adhaar_back = rand() . $file->getClientOriginalName();
            $file->move($folderPath, $adhaar_back);
            $RegistryForm->adhaar_back = $adhaar_back;
        }


        $RegistryForm->save();  
      
      Session::flash('message','Registry Form Updated');
        return redirect('/admin/user/registry-forms?status=0');
    }


// Registry Forms

public function downPaymentUsers()
{
  $down_payment_user=DownPayment::select([DB::raw("SUM(amount) as total"), 'user_key'])
   ->groupBy('user_key')
   ->get();
  return view('/admin/user/downpayment/list',compact('down_payment_user'));
}

public function downPaymentUsersDetails($user_key)
{
 $down_payment_user_details = DownPayment::where('user_key',$user_key)->orderby('created_at','DESC')->get();
  return view('/admin/user/downpayment/dp_details',compact('down_payment_user_details'));
}

public function propertyAllotment($user_key)
{
  $propertyAllotment = PropertyAllotment::where('user_key',$user_key)->get();
  return view('/admin/user/property-allotment/add',compact('user_key','propertyAllotment'));
}

public function propertyAllotmentList($user_key)
{
  $propertyAllotment = PropertyAllotment::where('user_key',$user_key)->get();
  return view('/admin/user/property-allotment/list',compact('propertyAllotment'));
}


public function propertyAllotmentCreate(Request $request)
{

 PropertyAllotment::create([
                            'user_key'=>$request->user_key,
                            'upgrade_history_id'=>0,
                            'project_name'=>$request->project_name,
                            'phase_number'=>$request->phase_number,
                            'unit_no'=>$request->unit_no,
                            'plot_1'=>$request->plot_1,
                            'plot_2'=>$request->plot_2,
                            'plot_size'=>$request->plot_size,
                            'plot_rate'=>$request->plot_rate,
                          ]);


         Session::flash('message','Your request has been submited.');
         return redirect('/admin/user/property-allotment/user_key/'.$request->user_key); 
}







public function SignedInvoiceStatus($user_key,$status)
{

    $nextfriday =strtotime('next friday');
    $cron_job_date = date('Y-m-d',strtotime($nextfriday. ' + 7 days'));


		$status = decrypt($status);
		$user =   User::find($user_key);
		$user->signed_invoice = $status;
    $user->invoice_verified_at = now();
    $user->package_activate_date = now();
    $user->cron_job_date = $cron_job_date;
    $user->cron_job_count = 0;
		$user->save();
		if ($status==2) {
    $TDMCharges = ['',env('adminCharges'),env('TDSpercent')];
		$package = Package::find($user->package_id);
    $direct_income = $package->direct_income;
      /**********************User ko Direct PayOut******************************
      ******************************************************************/
      Payout::pay($user->sponsor_key,$direct_income,$TDMCharges[1],$TDMCharges[2],2,$status=1,"Income from Direct reference ".$user->user_key."");
      $parentSponsor = User::where('user_key',$user->sponsor_key)->first();

      // 2nd level sponsor income 250
      Payout::pay($parentSponsor->sponsor_key,250,$TDMCharges[1],$TDMCharges[2],2,$status=1,"2nd Level Income from Direct reference ".$user->user_key."");
      /**********************User ko Direct PayOut******************************
      ******************************************************************/

		$this->UpgradePackage->binaryPayment($user->user_key,$user->leg,$package->point_value,$user->leg ,$TDMCharges,$user->user_key);
			session::flash("message","Status has been changed, Payment proccess has been done");
		}else{
			session::flash("message","Status has been changed");
		}
	
		return redirect()->back();
}


public function AllPackages($user_key)
{

    $userAllPackages =   UpgradeHistory::where('user_key',$user_key)->get();
   
   
    return view('admin/user/AllPackageList',compact('user_key','userAllPackages'));
}


public function panStatus($user_key,$status)
{

		$user =   User::find($user_key);
		$user->is_pan_verified = $status;
		$user->save();
		session::flash("message","Status has been changed");
		return redirect()->back();
}

public function aadharStatus($user_key,$status)
{

		$user =   User::find($user_key);
		$user->is_adhaar_verified = $status;
		$user->save();
		session::flash("message","Status has been changed");
		return redirect()->back();
}


public function bankKYCStatus($user_key,$status)
{

		$user =   User::find($user_key);
		$user->is_bank_details_update = $status;
		$user->bank_kyc_status =$status;
		$user->save();
		session::flash("message","Status has been changed");
		return redirect()->back();
}

public function approvedKYC($user_key,$status)
{

		$user =   User::find($user_key);
		$user->is_adhaar_verified = $status;
		$user->is_pan_verified = $status;
		$user->save();
		session::flash("message","Status has been changed");
		return redirect()->back();
}






public function businessActivityPayout($user_key)
{
$BusinessAreas = BusinessArea::all();
foreach ($BusinessAreas as $key => $business) {
$business->PayoutAmount = $this->takePayouts($business->id,$user_key);    
}
return view('admin/user/businessActivityPayout',compact('BusinessAreas','user_key'));
}
public function takePayouts($business_id,$user_key)
{
return  Payout::where('business_area_id',$business_id)->where('user_key',$user_key)->sum('amount');
}
public function PayoutActivity($user_key)
{
$users =  Payout::where('earning_by',$user_key)->whereNotIn('user_key',[$user_key])->orderby('created_at','DESC')->get();
return view('admin/user/payout_activity',compact('users'));
}
/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
public function userDocuments($user_id)
{
$documents = Document::all();
foreach ($documents as $key => $document) {
$document->user_documents = UserDocuments::where('user_id',$user_id)->where('document_id',$document->id)->first();
}
return view('admin/user/document')->with('documents',$documents);
}
public function userEdit($user_id)
{
$user = User::find($user_id);
$cities =   DB::table('cities')->get();
$states =   DB::table('states')->get();
$packages =   Package::all();
$addedBy=   $this->user->infoGetAddedBy($user);
return view('admin/user/edit',compact('user','cities','states','packages','addedBy'));
}
public function generalDetails(Request $request)
{
$user = User::find($request->user_id);
if ($request->name) {
  $user->name    =$request->name;
  $user->is_pan_verified = 1;
  $user->bank_kyc_status = 1;
  $user->is_adhaar_verified = 1;
}
$user->email    =$request->email;
$user->mobile1    =$request->mobile1;
$user->mobile    =$request->mobile;
$user->pan    =$request->pan;
$user->gender    =$request->gender;
$user->dob    =$request->dob;
$user->occupation =$request->occupation;
$user->save();
session::flash("message","Profile has been updated");
return redirect()->back();
}
public function bankDetails(Request $request)
{
$user =   UserBankDetail::where('user_key',$request->user_key)->first();
if (count([$user])) {
UserBankDetail::where('user_key',$request->user_key)->update([
'account_no'=>$request->account_no,
'name' =>$request->name,
'branch' =>$request->branch,
'ifsc' =>$request->ifsc,
'city' =>$request->city
]);
}else{
UserBankDetail::create([
'user_key'=>$request->user_key,
'account_no'=>$request->account_no,
'name' =>$request->name,
'branch' =>$request->branch,
'ifsc' =>$request->ifsc,
'city' =>$request->city
]);
}
session::flash("message","Profile has been updated");
return redirect()->back();
}
public function address(Request $request)
{
# code...
}
public function changeProfile_photo(Request $request)
{
/*Create Folder for Client */
$folderPath = 'assets/user/'. $request->user_id.'/profile';
if (!file_exists($folderPath)) {
File::makeDirectory($folderPath, $mode = 0777, true, true);
}
if($request->hasFile('profile_photo')){
$file=$request->file('profile_photo');
$newImageName = rand().time('i').$file->getClientOriginalName();
$file->move($folderPath, $newImageName);
}
User::where('id',$request->user_id)->update(['profile_photo'=>$newImageName]);
session::flash('message','Your profile photo has been changed');
return redirect()->back();
}
public function updateAddress(Request $request)
{
$user =   User::find($request->user_id);
$user->address1 = $request->address1;
$user->address2 = $request->address2;
$user->address3 = $request->address3;
$user->state = $request->state_id;
$user->city = $request->city_id;
$user->pincode = $request->pincode;
$user->save();
session::flash("message","User Profile has been updated");
return redirect()->back();
}
public function updatePassword(Request $request)
{
$validator = Validator::make($request->all(), [
'password' => 'required|string|min:6|confirmed'
]);
if ($validator->fails()) {
return redirect('profile')
->withErrors($validator)
->withInput();
}
$user =   User::find($request->user_id);
$user->password = Hash::make($request->password);
$user->admin_password = $request->password;
$user->save();
session::flash("message","Password has been updated");
return redirect()->back();
}
public function transactionUpdate(Request $request)
{
$user =  User::find($request->user_id);
if ($request->new) {
$user->transaction_password=$request->new;
$user->save();
session::flash('message','Transaction password has been updated');
}else{
session::flash('message','There is no  change');
}
return redirect()->back();
}
public function userBanned($user_id,$status)
{
User::where('id',$user_id)->update(['banned'=>$status]);
session::flash('message','User status has been changed');
return redirect()->back();
}
public function getUserBanned()
{
return view('admin/user/list_banned')->with('users',User::where('banned',0)->get());
}
/**
* Store a newly created resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @return \Illuminate\Http\Response
*/
public function DocumentStatus($status,$user_id,$document_id)
{
UserDocuments::where('document_id',$document_id)->with('user_id',$user_id)->update(['status'=>$status]);
session::flash('message','Document status has been changed');
return redirect()->back();
}
/**
* Display the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function pins($user_key)
{
$pins =  Pin::where('user_key',$user_key)->get();
return view('admin/user/pins',compact('pins'));
}
public function direct($user_key)
{
$directs = User::where('sponsor_key',$user_key)->get();
return view('users/associatemodule/direct')->with('directs',$directs);
}
/**
* Store a newly created resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @return \Illuminate\Http\Response
*/
public function downline($user_key)
{
$myLeftLegUsers = $this->tree->myLeftLegUsers($user_key);
foreach ($myLeftLegUsers as $key => $myLeftLegUser) {
$myLeftLegUser->rightleg = DB::select("SELECT users.created_at,users.user_key,users.name,`users`.`sponsor_key`,users.parent_key,users.city,users.mobile,packages.name as package_name,packages.point_value as pv
FROM users
Join packages
ON packages.id = users.package_id
WHERE user_key IN
(
SELECT ukey
FROM rightleg
WHERE pkey = '".$myLeftLegUser->user_key."' 
ORDER BY id DESC
)
");
$myLeftLegUser->leftleg = DB::select("SELECT users.created_at,users.user_key,users.name,`users`.`sponsor_key`,users.parent_key,users.city,users.mobile,packages.name as package_name,packages.point_value as pv
FROM users
Join packages
ON packages.id = users.package_id
WHERE user_key IN
(
SELECT ukey
FROM leftleg
WHERE pkey = '".$myLeftLegUser->user_key."' 
ORDER BY id DESC
)
");
}
$myRightLegUsers= $this->tree->myRightLegUsers($user_key);
foreach ($myRightLegUsers as $key => $myRightLegUser) {
$myRightLegUser->rightleg = DB::select("SELECT users.created_at,users.user_key,users.name,`users`.`sponsor_key`,users.parent_key,users.city,users.mobile,packages.name as package_name,packages.point_value as pv
FROM users
Join packages
ON packages.id = users.package_id
WHERE user_key IN
(
SELECT ukey
FROM rightleg
WHERE pkey = '".$myRightLegUser->user_key."' 
ORDER BY id DESC
)
");
$myRightLegUser->leftleg = DB::select("SELECT users.created_at,users.user_key,users.name,`users`.`sponsor_key`,users.parent_key,users.city,users.mobile,packages.name as package_name,packages.point_value as pv
FROM users
Join packages
ON packages.id = users.package_id
WHERE user_key IN
(
SELECT ukey
FROM leftleg
WHERE pkey = '".$myRightLegUser->user_key."' 
ORDER BY id DESC
)
");
}
return view('users.associatemodule.downline')
->with('myLeftLegUsers',$myLeftLegUsers)
->with('myRightLegUsers',$myRightLegUsers);
}
/**
* Show the form for editing the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/

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