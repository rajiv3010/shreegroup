<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\UserBankDetail;
use App\Tree;
use App\Pin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use File;
use DB;
class ADMINRegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    public $pid;
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
       

        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            $error ="";
            foreach(json_decode(trim($validator->messages())) as $key=> $val){
                $error .= $val[0];
                $error .="<br>";
            }
            echo $error;
            exit();
        }else{
            return $validator;
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        
        $user_key = rand(100000,999999);
        //if generated key is already exist in the DB then again re-generate key
        do
        {
          $check = User::where('user_key',$user_key)->count();
          $flag = 1;
          if($check == 1)
          {
            $user_key = rand(100000,999999);
            $flag = 0;
          }
        }
        while($flag==0);
       
        //if generated key is already exist in the DB then again re-generate key
        // 
        $sponsor = $data['sponsor_key'];
        $sponsor1 = $sponsor;
    
        do
        {
        $spon =  User::select('user_key')->where('parent_key',$sponsor1)->where('banned',0)->where('leg',$data['placement'])->first();
        $num = count($spon);
    
        if($num)
        {             
          $sponsor1 = $spon->user_key;
        }

        }while($num==1);
          $parent_key = $sponsor1;

      $user =   User::create([
            'user_key' => $user_key,
            'parent_key' => $parent_key,
            'sponsor_key' => $sponsor,
            'package_id' => $data['package_id'],
            'leg' => $data['placement'],
            'pin_number' => $data['pin_number'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'mobile' => $data['mobile'],
            'mobile1' => $data['mobile1'],
            'occupation' => $data['occupation'],
            'pan' => $data['panno'],
            'dob' => $data['dob'],
            'gender' => $data['gender'],
            'address1' => $data['address1'],
            'address2' => $data['address2'],
            'address3' => $data['address3'],
            'state' => $data['state'],
            'city' => $data['city'],
        ]);


        // if all data successfully inserted
        if($user->id)
        { //begin most inner if condition
          //entry on Left and Right Leg tables
          if($data['placement']==0)
          {
            DB::table('leftleg')->insert(['pkey'=>$parent_key,'ukey'=>$user_key]);
          }else
          {
            DB::table('rightleg')->insert(['pkey'=>$parent_key,'ukey'=>$user_key]);
          }



          //begin while loop
          while($parent_key!='0')
          {
            $result=User::select('parent_key','leg')->where('user_key',$parent_key)->where('banned',0)->first();
            if(count($result)==1)
            {
              if($result->parent_key!='0')
              {
                if($result->leg==1)
                {
                        DB::table('rightleg')->insert(['pkey'=>$result->parent_key,'ukey'=>$user_key]);
                }
                else
                {
                         DB::table('leftleg')->insert(['pkey'=>$result->parent_key,'ukey'=>$user_key]);
                }
              }
              $parent_key = $result->parent_key;
            }
            else
            {
              $parent_key = '0';
            }
          }//end while loop

        }// if all data successfully inserted END


          $parent =  User::where('user_key',$sponsor)->first();
          $user_placement = $this->getExtremePlacementId($parent->id,$data['placement']);
          if ($user_placement){
                $user_placement_id =  $user_placement;
            }else{
               $user_placement_id =  $parent->id;
          }
        Tree::create([
            'user_id'=>$user->id,
            'user_placement_id'=>$user_placement_id,/*Jiske niche ye user place ho raha he uski user id jo tree table me he*/
            'user_reference_id'=>$parent->id,/*Jisne is user ko create kara he ya refer kara he*/
            'placement'=>$data['placement']
        ]);

        UserBankDetail::create([
            'user_id'=>$user->id,
            'account_no'=>$data['account_no'],
            'name'=>$data['bank_name'],
            'branch'=>$data['branch_name'],
            'ifsc'=>$data['ifsc'],
            'city'=>$data['branch_city'],
            ]);

      

      Pin::where('package_id',$data['package_id'])->where('pin_number',$data['pin_number'])->update(['status' => 0]);

  $pathP = public_path() . 'assets/user/' . $user->id.'/documents';
      if (!file_exists($pathP)) {
      File::makeDirectory($pathP, $mode = 0777, true, true);
    }
      return $user;  
    }//Create funtion end
    


    function getExtremePlacementId($parent_id,$placement){

    

      $user_placement = Tree::where('user_placement_id',$parent_id)
      ->select('user_id')
      ->where('placement',$placement)
      ->orderby('created_at','desc')->first();
      if(is_object($user_placement)){
          $this->pid=$user_placement->user_id;
          return $this->getExtremePlacementId($user_placement->user_id,$placement);
      }else{
          return $this->pid;
      }

    }



}




