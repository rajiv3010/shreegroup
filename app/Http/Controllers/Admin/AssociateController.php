<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tree;
use App\User;
use App\Package;
use DB,Auth;
class AssociateController extends Controller
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
      }


      public function addNew($value='')
      {
          echo "addNew";
      }

    
         public function getLeftRightCountPackageWise($package_id,$leg,$user_key)
    {
      
       $child =   User::where('parent_key',$user_key)->where('leg',$leg)->first();

        if (isset($child->id)) {

           $data =   DB::table('users')
                    ->select('packages.name as package_name',DB::raw('sum(amount) as amount'),DB::raw('count(user_key) as count'))
                    ->join('packages','packages.id','=','users.package_id')
                    ->where('users.package_id',$package_id)
                    ->whereBetween('_lft', [$child->_lft, $child->_rgt])
                    ->first();       
                     if (isset($data->amount)) {
             return   array('amount'=>$data->amount,'count'=>$data->count);
           }else{
             return   array('amount'=>0,'count'=>0); 
           }


        }else{
             return   array('amount'=>0,'count'=>0); 
        }
    }
   public function tree(Request $request)
    {
        if ($request->search==null) {
             $cc = User::find(1);
             $user_key = $cc->user_key;
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
              $user_key = $request->search;

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
          $packages =  Package::wherein('id',[1,2,3,4,5])->orderby('order','ASC')->get();
          foreach ($packages as $key => $package) {    
                      $left  =  $this->getLeftRightCountPackageWise($package->id,0,$user_key);
                      $right =  $this->getLeftRightCountPackageWise($package->id,1,$user_key);
                      $sumCount  = $left['count']+ $right['count'];
                      $sumPV  = $left['amount']+ $right['amount'];
                      $package->total =  array('team' =>$sumCount,'totalPV'=>$sumPV );                   
                      $package->left  =  $left;
                      $package->right  = $right;
                     }

        return view('admin.tree.binary',compact('cc','r','l','ll','lr','rl','rr','packages'));
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
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function treeChild($user_key)
    {
        $user = User::where('user_key',$user_key)->first();
        $currentUser = array('0' => array(
        "name" => $user->name,
        "user_key" => $user->user_key,
        "parent_key" => 0,
        "leg" => 0,
        "id" => $user->id,
        "payment_status" => "Not Active"
        )
        );
//        $trees = DB::select("SELECT name, payment_status,parent_key,user_key,leg,id FROM USERS");
        $trees      =    array_merge($this->tree->myFiveLeftLegUsers($user_key),$this->tree->myFiveRightLegUsers($user_key),$currentUser);
        $myLeft     =    $this->tree->myFiveLeftLegUsers($user_key);
        $myRight    =    $this->tree->myFiveRightLegUsers($user_key);
        //dd($trees);
        $treesF      =    $this->tree->associateTree($trees);
        $leftCount  =    $this->tree->totalLeftLegUsers($user_key);
        $rightCount  =    $this->tree->totalRightLegUsers($user_key);
        return view('admin.tree.binary')
                ->with('myLeft',$myLeft)
                ->with('myRight',$myRight)
                ->with('trees',$treesF)
                ->with('leftCount',$leftCount)
                ->with('rightCount',$rightCount);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
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
