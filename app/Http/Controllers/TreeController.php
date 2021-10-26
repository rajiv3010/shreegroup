<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Package;
use App\UserPointValue;
use App\Tree;
use App\Club;
use App\ClubUser;
use Auth;
use DB;
use Log;
use Session;
class TreeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
      public $p=1;
      public $user_in_downline=[];
      public $user_data=   array();
      public $pv=0;

      public function __construct()
      {   
          $this->middleware('auth');
          $this->tree  = new Tree();
      }

    public function index()
    { 
        return view('admin.tree.show')
                ->with('myLeft',$this->tree->myFiveLeftLegUsers(Auth::user()->user_key))
                ->with('myRight',$this->tree->myFiveRightLegUsers(Auth::user()->user_key))
                ->with('leftCount',$this->tree->totalLeftLegUsers(Auth::user()->user_key))
                ->with('rightCount',$this->tree->totalRightLegUsers(Auth::user()->user_key));
    }

    public function clubWiseTeam()
    {

    $mys = User::where('parent_key',auth::user()->user_key)->wherein('leg',[0,1])->get();
      $clubs =   Club::all();
      foreach ($clubs as $key => $club) {

          foreach ($mys as $key => $value) {
          if ($value->leg) {
           $club->right = DB::table('users')->select('*')
                                            ->whereBetween('_lft', [$value->_lft,$value->_rgt])
                                            ->where('club_id',$club->id)
                                            ->count();
          }else{
           $club->left = DB::table('users')->select('*')
                                            ->whereBetween('_lft', [$value->_lft,$value->_rgt])
                                            ->where('club_id',$club->id)
                                            ->count();
            }
          }

      }
      return view('users.club.clubWiseList',compact('clubs'));
    }

    public function generationLevel()
    {
      return view('admin.tree.generationLevel');
    }

    public function getGenerationLevel($id,$level)
    {
                $totlaDownLine = [];
                $downlines = $this->getLevel($id,$level);
                foreach ($downlines as $key => $downline) {
                   $user = User::where('user_key',$downline['level_user_id'])->first();
                   $user->level =$downline['level'];
                   $totlaDownLine[] = $user;
        }

            $view = view('admin.tree.generationLevelData', [
            'data' => $totlaDownLine,
            'level' => $level,
            ]);
            $html = $view->render();
            print_r($html);

    }

public function getLevel($id,$cl)
    {
 
          if(is_array($id)){
                 $parents = DB::table('users')->whereIn('sponsor_key',$id)->get();
          }else{
             $array =array($id);
             $parents = DB::table('users')->whereIn('sponsor_key',$array)->get();
          }
          $users =  array();
          if ($parents->count()) {
               $level = $this->p++;
               foreach ($parents as $key => $value) {
                   $users[] =$value->user_key; 
                   if ($level==$cl) {
                       $this->user_in_downline[]=  array('level_user_id'=>$value->user_key, 'level'=>$level);
                   }
              }
              $this->getLevel($users,$cl);
          }
        return $this->user_in_downline;
    }



 public function MyTeam()
  {
    $totlaDownLine = [];
        $downlines = $this->getMyTeam(Auth::user()->user_key);
        foreach ($downlines as $key => $downline) {
            $user = User::where('user_key', $downline['level_user_id'])->first();
            $user->level = $downline['level'];
            $totlaDownLine[] = $user;
        }

      

    return view('users/associatemodule/MyTeam',compact('totlaDownLine'));
  }



    public function getMyTeam($id)
    {

        if (is_array($id)) {
            $parents = DB::table('users')->whereIn('sponsor_key', $id)->get();
        } else {
            $array = array($id);
            $parents = DB::table('users')->whereIn('sponsor_key', $array)->get();
        }
        $users =  array();
        if ($parents->count()) {
            $level = $this->p++;
            foreach ($parents as $key => $value) {
                $users[] = $value->user_key;
                
                    $this->user_in_downline[] =  array('level_user_id' => $value->user_key, 'level' => $level);
                
            }
            $this->getMyTeam($users);
        }
        return $this->user_in_downline;
    }

    
    public function getUserTreeInfo($user_key)
    {
        $package->directRight =  User::where('sponsor_key',Auth::user()->user_key)->where('package_id',$package->id)->where('leg',1)->count();
        $package->directLeft =  User::where('sponsor_key',Auth::user()->user_key)->where('package_id',$package->id)->where('leg',0)->count();

    }

public function getLeftRightCount($id,$leg)
    {
 
          if(is_array($id)){
                 $parents = User::whereIn('parent_key',$id)->get();
          }else{
             $array =array($id);
             $parents = User::whereIn('parent_key',$array)->where('leg',$leg)->get();

          }

          if ($parents->count()) {
            $users = [];
               foreach ($parents as $key => $value) {
                      if (isset($value->package->amount))
                              {
                                $amount = $value->package->amount; 
                              }else{
                                $amount = 0; 
                              }
                       $users[]=  $value->user_key;
                       $this->user_data[]=  $value->user_key;
                       $this->pv +=  $amount;
                       

              }
              $this->getLeftRightCount($users,$leg);
          }
          return  array('count' =>count($this->user_data),'pv'=>$this->pv);
    }
    public function tree(Request $request)
    {
        if ($request->search==null) {


             $user_key = Auth::user()->user_key;
             $cc = User::where('user_key',$user_key)->first();
             $user_name = Auth::user()->name;
              if(Auth::user()->profile_photo){
              $cc['image'] = env('base_url').'assets/user/'.Auth::user()->id.'/profile/'.Auth::user()->profile_photo;
              }else{
              if(Auth::user()->gender == "m"){
              $cc['image'] =  env('base_url').'dist/img/avatar5.png';
              }else{
              $cc['image'] =   env('base_url').'dist/img/avatar3.png';
              }        
              }
        }else{
              $user_key = $request->search;
              $notInTeam = $this->allowSearch($user_key);
              if ($notInTeam) {
                    session::flash("message","Sorry this user not in your team");
                    return redirect()->back();
              }
              $cc = User::where('user_key',$request->search)->first();
              if (isset($cc->id)) {
                  $user_name = $cc->name;            
                  if($cc->profile_photo){
                  $cc['image'] = env('base_url').'assets/user/'.$cc->id.'/profile/'.$cc->profile_photo;
                  }else{
                  if($cc->gender == "m"){
                  $cc['image'] =  env('base_url').'dist/img/avatar5.png';
                  }else{
                  $cc['image'] =   env('base_url').'dist/img/avatar3.png';
                  }        
                  }
              }else{
                session::flash("message","User id not valid");
                return redirect()->back();
              }
        }


        $cc['name']=$user_name;
        $cc['user_key']=$user_key;
        




        $l = User::where('parent_key',$user_key)->where('leg',0)->first();
        if (isset($l->id)) {
            if(isset($l->package->amount)) { $lamount = $l->package->amount;$classl="green";}else{ $lamount = 0;$classl = "red";}
               $l['name']=$l->name;
               $l['user_key']=$l->user_key;
               $l['image']=$this->getUserImage($l);
               $l['package']=$lamount.'<br>( ₹ '. $lamount.')';
               $l['class']=$classl;
               $l['dob']=$l->created_at;
               $l['sponsor_key']=$l->sponsor_key;
               $l['city']='NA';
         
              $ll = User::where('parent_key',$l->user_key)->where('leg',0)->first();
              if ($ll==null) {
                  $ll['name']="Empty";
                  $ll['user_key']="";
                  $ll['image']=env('base_url').'dist/img/avatar5.png';
                 
              }else{
                if(isset($ll->package->amount)) { $llamount = $ll->package->amount;$classll="green"; }else{ $llamount = 0 ; $classll="red"; }
                  $ll['name']=$ll->name;
                  $ll['user_key']=$ll->user_key;
                  $ll['image']=$this->getUserImage($ll);
                  $ll['package']=$llamount.'<br>( ₹ '.$llamount.')';
                  $ll['dob']=$ll->created_at;
                  $ll['class']=$classll;
                  $ll['sponsor_key']=$ll->sponsor_key;
                  $ll['city']='NA';
              }
              $lr = User::where('parent_key',$l->user_key)->where('leg',1)->first();
              if ($lr==null) {
                  $lr['name']="Empty";
                  $lr['user_key']="";
                  $lr['image']=env('base_url').'dist/img/avatar5.png';
                  $lr['parent_key']=$l['user_key'];
                
              }else{
                  if(isset($lr->package->amount)) { $lramount = $lr->package->amount;$classlr="green";}else{ $lramount = 0;$classlr="red";}
                  $lr['name']=$lr->name;
                  $lr['user_key']=$lr->user_key;
                  $lr['image']=$this->getUserImage($lr);
                  $lr['class']=$classlr;
                  $lr['package']=$lramount.'<br>( ₹ '.$lramount.')';
                  $lr['dob']=$lr->created_at;
                  $lr['sponsor_key']=$lr->sponsor_key;
                  $lr['city']='NA';
       
              }
        }else{
            $l['name']="Empty";
            $l['user_key']="";
            $l['image']=env('base_url').'dist/img/avatar5.png';
            $l['parent_key']=$cc['user_key'];

            $ll['name']="Empty";
            $ll['user_key']="";
            $ll['image']=env('base_url').'dist/img/avatar5.png';
            $ll['parent_key']="";

            $lr['name']="Empty";
            $lr['user_key']="";
            $lr['image']=env('base_url').'dist/img/avatar5.png';
            $lr['parent_key']="";

        }



        $r = User::where('parent_key',$user_key)->where('leg',1)->first();
        if (isset($r->id)) {
             if(isset($r->package->amount)) { $ramount = $r->package->amount;$classr ="green";}else{ $ramount = 0; $classr = "red";}

              $r['name']=$r->name;
              $r['user_key']=$r->user_key;
              $r['image']=$this->getUserImage($r);

              $r['package']=$ramount.'<br>( ₹ '.$ramount.')';
              $r['class']=$classr;
               $r['dob']=$r->created_at;
               $r['sponsor_key']=$r->sponsor_key;
               $r['city']='NA';

              $rl = User::where('parent_key',$r->user_key)->where('leg',0)->first();
              if ($rl==null) {
                  $rl['name']="Empty";
                  $rl['user_key']="";
                  $rl['image']=env('base_url').'dist/img/avatar5.png';
                  $rl['parent_key']=$r['user_key'];

                
              }else{
                if(isset($rl->package->amount)) { $rlamount = $rl->package->amount;$classrl="green";}else{ $rlamount = 0;$classrl="red";}
                  $rl['name']=$rl->name;
                  $rl['user_key']=$rl->user_key;
                  $rl['image']=$this->getUserImage($rl);
                  $rl['parent_key']="";
                  $rl['package']=$rlamount.'<br>( ₹ '.$rlamount.')';
                  $rl['class']=$classrl;
               $rl['dob']=$rl->created_at;
               $rl['sponsor_key']=$rl->sponsor_key;
               $rl['city']='NA';



              }
              $rr = User::where('parent_key',$r->user_key)->where('leg',1)->first();
              if ($rr==null) {
                  $rr['name']="Empty";
                  $rr['user_key']="";
                  $rr['image']=env('base_url').'dist/img/avatar5.png';
                  $rr['parent_key']="";

                
              }else{
                 if(isset($rr->package->amount)) { 
                            $rramount = $rr->package->amount;$classrr="green";
                           }else{ $rramount = 0;$classrr="red";
                          }
               
                  $rr['name']=$rr->name;
                  $rr['user_key']=$rr->user_key;
                  $rr['image']=$this->getUserImage($rr);
                  $rr['package']=$rramount.'<br>( ₹ '.$rramount.')';
                  $rr['class']=$classrr;
                   $rr['dob']=$rr->created_at;
                   $rr['sponsor_key']=$rr->sponsor_key;
                   $rr['city']='NA';
            


              }
        }else{
                  $r['name']="Empty";
                  $r['user_key']="";
                  $r['image']=env('base_url').'dist/img/avatar5.png';
                  $r['parent_key']=$r['user_key'];

                  $rl['name']="Empty";
                  $rl['user_key']="";
                  $rl['image']=env('base_url').'dist/img/avatar5.png';
            
                  $rr['name']="Empty";
                  $rr['user_key']="";
                  $rr['image']=env('base_url').'dist/img/avatar5.png';

        }
          $packages =  Package::orderby('order','ASC')->get();
          foreach ($packages as $key => $package) {    
                      $left  =  $this->getLeftRightCountPackageWise($package->id,0,$user_key);
                      $right =  $this->getLeftRightCountPackageWise($package->id,1,$user_key);
                      $sumCount  = $left['count']+ $right['count'];
                      $sumPV  = $left['point_value']+ $right['point_value'];
                      $package->total =  array('team' =>$sumCount,'totalPV'=>$sumPV );                   
                      $package->left  =  $left;
                      $package->right  = $right;
                     }

        return view('users.tree.binary',compact('cc','r','l','ll','lr','rl','rr','packages'));
    }
    public function getLeftRightCountPackageWise($package_id,$leg,$user_key)
    {
      
       $child =   User::where('parent_key',$user_key)->where('leg',$leg)->first();

        if (isset($child->id)) {

           $data =   DB::table('users')
                    ->select('packages.name as package_name',DB::raw('sum(point_value) as point_value'),DB::raw('count(user_key) as count'))
                    ->join('packages','packages.id','=','users.package_id')
                    ->where('users.package_id',$package_id)
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

 public function allowSearch($user_key)
    {
      
      $child =   User::find(auth::user()->id);
      $data =   DB::table('users')
      ->whereBetween('_lft', [$child->_lft, $child->_rgt])
      ->get()->pluck('user_key')->toArray();
      $myteam = implode(' ', $data);
      $pos = strpos($myteam, $user_key);

      // Note our use of ===.  Simply == would not work as expected
      // because the position of 'a' was the 0th (first) character.
      if ($pos === false) {
      return 1;
      } else {
      return 0;

      }
    }

    public function getUserImage($user)
    {

        if($user->profile_photo)
        {
             return  env('base_url').'assets/user/'.$user->id.'/profile/'.$user->profile_photo;
        }else
        {
              if($user->gender == "m")
              {
                  return   env('base_url').'dist/img/avatar5.png';
              }else
              {
                    return    env('base_url').'dist/img/avatar3.png';
              }        
        }
    }
 public function treeChild($user_key)
    {
$l = User::where('parent_key',$user_key)->where('leg',0)->first();
        if (count($l)) {
              $ll = User::where('parent_key',$l->user_key)->where('leg',0)->first();
              if ($ll==null) {
                  $ll['name']="Add New";
                  $ll['user_key']="";
              }else{
                  $ll['name']=$ll->name;
                  $ll['user_key']=$ll->user_key;

              }
              $lr = User::where('parent_key',$l->user_key)->where('leg',1)->first();
              if ($lr==null) {
                  $lr['name']="Add New";
                  $lr['user_key']="";
                
              }else{
                  $lr['name']=$lr->name;
                  $lr['user_key']=$lr->user_key;

              }
        }else{
            $ll['name']="Add New";
            $ll['user_key']="";
            $lr['name']="Add New";
            $lr['user_key']="";
        }



        $r = User::where('parent_key',$user_key)->where('leg',1)->first();
        if (count($r)) {
              $rl = User::where('parent_key',$r->user_key)->where('leg',0)->first();
              if ($rl==null) {
                  $rl['name']="Add New";
                  $rl['user_key']="";
                
              }else{
                  $rl['name']=$rl->name;
                  $rl['user_key']=$rl->user_key;

              }
              $rr = User::where('parent_key',$r->user_key)->where('leg',1)->first();
              if ($rr==null) {
                  $rr['name']="Add New";
                  $rr['user_key']="";
                
              }else{
                  $rr['name']=$rr->name;
                  $rr['user_key']=$rr->user_key;

              }
        }else{
                  $rl['name']="Add New";
                  $rl['user_key']="";
                  $rr['name']="Add New";
                  $rr['user_key']="";
        }








        return view('admin.tree.binary',compact('cc','r','l','ll','lr','rl','rr'));


    }


    public function generationChart()
    {

            $mygenerations=Tree::get();
            return view('admin.tree.generationChart')->with('trees',$this->generatePageTree($mygenerations));

    }

  public function binaryStatus()
  {
      $binary_payouts = UserPointValue::where('user_key',Auth::user()->user_key)->orderby('id','DESC')->get();
      return view('users/referl/list',compact('binary_payouts'));
  }



  public  function generatePageTree($datas, $parent = 0, $limit=0,$k=1){
     

      if($limit > 999) return ''; // Make sure not to have an endless recursion
      
      $tree = '<ul class="'.$k.'">';
      for($i=0, $ni=count($datas); $i < $ni; $i++){
        if($datas[$i]['user_reference_id'] == $parent){
             $tree .= '<li>
                            <div class="">
                                     <a href="/tree/create/'.$datas[$i]['id'].'">
                                <input type="checkbox">'.$datas[$i]->user->name.'</div>';
          $tree .= $this->generatePageTree($datas, $datas[$i]['user_id'], $limit++,$ni   );
          $tree .= '</a></li>';
        }
        
      }
      $tree .= '</ul>';
      return $tree;
    }
}
