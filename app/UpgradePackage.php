<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Payment;
use App\User;
use App\Payout;
use DB,Log;

class UpgradePackage extends Model
{
	public $user_data=array();
	public $parent=   array();
	public $pleg='';

     public function binaryPayment($user_key,$leg,$current_user_pv,$current_user_leg ,$TDMCharges,$current_user)
      {
          if ($user_key) {
                $parent_key = DB::table('users')->where('user_key',$user_key)->first();
            if (isset($parent_key->parent_key)) {
                   $this->parent[] .= $parent_key->parent_key;
                   $this->parent[] .=$user_key;
                   $this->user_data[]=array('user_key'=>$user_key,
                                        'winner_club_id'=>$parent_key->winner_club_id,
                                        'leg'=>$parent_key->leg,
                                        'child_leg'=>$this->pleg
                                      );
               $this->pleg= $parent_key->leg;
               $this->parent_key = $this->binaryPayment($parent_key->parent_key,$leg,$current_user_pv,$current_user_leg,$TDMCharges,$current_user);
                }
            }else{
                unset($this->user_data[0]);
                $i = 1;

             foreach ($this->user_data as $key => $value) {
                      if($value['winner_club_id']==0){
                          $this->getBadge($value['user_key']);
                      }
                      $this->BP($value,$current_user_pv,$current_user_leg,$i,$this->user_data,$TDMCharges,$current_user);

              $i++;
             }
            }

    }


         public function getBadge($user_key)
    {

        $userData =   User::select(DB::raw('count("id") as count'),'leg','_lft','_rgt','winners_club_id','user_key')->where('parent_key',$user_key)->groupby('leg')->get();
      if (count($userData)==2) {
        $winnerClubCount  =2;
        $childRightCount = $childLeftCount = 0;
            foreach ($userData as $key => $value) {
                          if($value->leg){
                                  $childRight = DB::table('users')
                                  ->whereBetween('_lft', [$value->_lft, $value->_rgt])
                                  ->where('date', date('Y-m-d'))
                                  ->count();
                                  $childRightCount= $childRight;
                          }else{
                                  $childLeft = DB::table('users')
                                  ->whereBetween('_lft', [$value->_lft, $value->_rgt])
                                  ->where('date', date('Y-m-d'))
                                  ->count();
                                  $childLeftCount= $childLeft;
                          }

                        
                       }   
                  if ($childRightCount ==$winnerClubCount && $childLeftCount ==$winnerClubCount) {
                          User::where('user_key',$user_key)->update(['winner_club_id'=>1]); 
                          UserWinnersClub::create([
                          'user_key'=>$user_key,
                          'winners_club_id'=>1,
                          'date'=>date('Y-m-d'),
                          'status'=>0,
                          'amount'=>0
                          ]);
                  }
      }
   }

      function BP($user_key,$current_user_pv,$current_user_leg,$i,$array,$TDMCharges,$current_user)
    {
            $user = User::where('user_key',$user_key['user_key'])->first();         
              /*2:1*/
             Log::info('User Pay Mode',['payment Mode'=>'2:1','user_key'=>$user_key['user_key'],'user type'=>$user->pay_type]);
              $this->logic1($user_key,$current_user_pv,$current_user_leg,$i,$array,$TDMCharges,$user->pay_type,$current_user);
     }


      public function logic1($user_key,$current_user_pv,$current_leg,$i,$array,$TDMCharges,$count,$current_user)
     {


        $fleftamount = $frightamount = $isPayment = $isLeftPayment =  0;
        if ($user_key['child_leg']) {
              $p = 0;
               User::where('user_key',$user_key['user_key'])->increment('balance_pv_right',$current_user_pv);
              $user =  User::where('user_key',$user_key['user_key'])->first();
              $max = 0.50; 
              $min = 0.50;
              $totalPVRight = $user->balance_pv_right;
              $loopLeft = $user->balance_pv_left/$max;
              $loopRight = $totalPVRight/$min;
                if ($loopRight > $loopLeft) {
                  for ($i=1; $i<=$loopLeft ; $i++) { 
                  for ($l=1; $l <=$loopRight-$l; $l++) { 
                            if ($i == $l) {
                                $totalPVRightBalance = $loopRight -$l-$l;
                                $totalPVLEftBalance = $loopLeft-$i;
                                $totalPVRight1 = $totalPVRightBalance*$max;
                                $totalPVLeft1 = $totalPVLEftBalance*$max;
                                $isPayment = 1;
                                $amount  = 625;
                                $totalPVRight1 = $totalPVRightBalance*$min;
                                $totalPVLeft1 = $totalPVLEftBalance*$max;
                                $frightamount+=$amount;
                             
                            }

                      }
              }
                }else{
                   for ($i=1; $i<=$loopLeft-$i ; $i++) { 
                  for ($l=1; $l <=$loopRight; $l++) { 
                            if ($i == $l) {
                            $totalPVRightBalance = $loopRight -$l;
                            $totalPVLEftBalance = $loopLeft-$i-$i;
                            $totalPVRight1 = $totalPVRightBalance*$max;
                            $totalPVLeft1 = $totalPVLEftBalance*$max;
                            $isPayment = 1;
                            $amount  = 625;
                            $totalPVRight1 = $totalPVRightBalance*$min;
                            $totalPVLeft1 = $totalPVLEftBalance*$max;
                            $frightamount+=$amount;
                             
                            }

                      }
              }
                }
              
              if ($isPayment) {
                  $this->logic21payment($totalPVRight1,$totalPVLeft1,0,$current_user_pv,$frightamount,$user_key['user_key'],$TDMCharges,$current_user);
              }else{
                  DB::table('user_point_values')->insert(
                            [
                            'user_key'=>$user_key['user_key'],
                            'user_by'=>$current_user,
                            'blpv'=>0,
                            'brpv'=>$current_user_pv,
                            'amount'=>0,
                            'bpv'=>$user->balance_pv_left.':'.$user->balance_pv_right,
                            'created_at'=>date('Y-m-d')
                          ]);

              }

      }else{
        $p = 0;
                User::where('user_key',$user_key['user_key'])->increment('balance_pv_left',$current_user_pv);
                $user =  User::where('user_key',$user_key['user_key'])->first();
                $max = 0.50; 
                $min = 0.50;
                $loopRight = $user->balance_pv_right/$min;
                $totalPVLeft = $user->balance_pv_left;
               $loopLeft = $totalPVLeft/$min;
              if ($loopLeft > $loopRight) {
               for ($i=1; $i <=$loopRight ; $i++) { 
                      for ($l=1; $l <=$loopLeft-$i ; $l++) { 
                            if ($i == $l) {
                              $userPaytype =   User::where('user_key',$user_key['user_key'])->first();
                                   $isLeftPayment = 1;
                                    $amount  =  625;
                                    $totalPVRightBalance = $loopRight-$i;
                                    $totalPVLEftBalance = $loopLeft -$l-$l;
                                    $newtotalPVRight = $totalPVRightBalance*$min;
                                    $newtotalPVLeft = $totalPVLEftBalance*$min;
                                    $fleftamount +=$amount;

                          }

                      }
              }
              }else{
                for ($i=1; $i <=$loopRight-$i ; $i++) { 
                      $loopLeft = $totalPVLeft/$min;
                      for ($l=1; $l <=$loopLeft ; $l++) { 
                            if ($i == $l) {
                                   $isLeftPayment = 1;
                                    $amount  =  625;
                                    $totalPVRightBalance = $loopRight-$i-$i;
                                    $totalPVLEftBalance = $loopLeft -$l;
                                    $newtotalPVRight = $totalPVRightBalance*$min;
                                    $newtotalPVLeft = $totalPVLEftBalance*$min;
                                    $fleftamount +=$amount;                              
                          }

                      }
                   }
              }
              
              if ($isLeftPayment) {  
                  $this->logic21payment($newtotalPVRight,$newtotalPVLeft,$current_user_pv,0,$fleftamount,$user_key['user_key'],$TDMCharges,$current_user);
              }else{
                  DB::table('user_point_values')->insert(
                            [
                            'user_key'=>$user_key['user_key'],
                            'user_by'=>$current_user,
                            'blpv'=>$current_user_pv,
                            'brpv'=>0,
                            'amount'=>0,
                            'bpv'=>$user->balance_pv_left.':'.$user->balance_pv_right,
                            'created_at'=>date('Y-m-d')
                          ]);  
              }
      }
          

     }







      public function logic1Old($user_key,$current_user_pv,$current_leg,$i,$array,$TDMCharges,$count)
      	{
		       $fleftamount = $frightamount = $isPayment = $isLeftPayment =  0;
        
      if ($user_key['child_leg']) {
              $p = 0;
              User::where('user_key',$user_key['user_key'])->increment('balance_pv_right',$current_user_pv);
              $user =  User::where('user_key',$user_key['user_key'])->first();
              $loopLeft = $user->balance_pv_left;
              $loopRight = $user->balance_pv_right;


              if ($loopLeft==0){
                   Log::info('Log-1',['loopLeft'=>$loopLeft,'user_key'=>$user_key['user_key']]);
                   DB::table('user_point_values')->insert(
                            [
                            'user_key'=>$user_key['user_key'],
                            'blpv'=>$user->balance_pv_left,
                            'brpv'=>$current_user_pv,
                            'amount'=>0,
                            'bpv'=>$user->balance_pv_left.':'.$user->balance_pv_right,
                            'created_at'=>date('Y-m-d')
                          ]);


              }else{
                  
                    if ($loopLeft >=$loopRight) {

                            for ($i=1; $i <=$loopLeft ; $i++) { 
                                
                                  for ($l=1; $l <=$loopRight ; $l++) { 
                                      if ($i/2 == $l/1) {
                                          $userPaytype =   User::where('user_key',$user_key['user_key'])->first();
                                          $isPayment = 1;
                                          $amount  =  2000;
                                          $totalPVRightBalance = $loopRight -$l;
                                          $totalPVLEftBalance = $loopLeft -$i;
                                          $totalPVRight1 = $totalPVRightBalance;
                                          $totalPVLeft1 = $totalPVLEftBalance;
                                          $frightamount+=$amount;

                                      }

                                  }
                            }

              
                      
                    }else{
                            for ($i=1; $i <=$loopRight ; $i++) { 
                                for ($l=1; $l <=$loopLeft ; $l++) { 
                                      if ($i/2 == $l/1) {
                                          Log::info('Log-2',['loopLeft'=>$loopLeft,'loopRight'=>$loopRight,'user_key'=>$user_key['user_key']]);
                                          $userPaytype =   User::where('user_key',$user_key['user_key'])->first();
                                          $isPayment = 1;
                                          $amount  =  2000;
                                          $totalPVRightBalance = $loopRight -$i;
                                          $totalPVLEftBalance = $loopLeft -$l;
                                          $totalPVRight1 = $totalPVRightBalance;
                                          $totalPVLeft1 = $totalPVLEftBalance;
                                          $frightamount+=$amount;

                                      }

                                }
                            }
                    }


              if ($isPayment) {
               $this->logic21payment($totalPVRight1,$totalPVLeft1,0,$current_user_pv,$frightamount,$user_key['user_key'],$TDMCharges);
              }

              }



             

      }else{
        $p = 0;
                User::where('user_key',$user_key['user_key'])->increment('balance_pv_left',$current_user_pv);
                $user =  User::where('user_key',$user_key['user_key'])->first();
                $loopRight = $user->balance_pv_right;
                $loopLeft = $user->balance_pv_left;

              if ($loopRight < 1 ) {
                    Log::info('left insertion',['loopRight'=>$user->balance_pv_right,'user_key'=>$user_key['user_key'],'current_user_pv'=>$current_user_pv]);
                    DB::table('user_point_values')->insert(
                    [
                    'user_key'=>$user_key['user_key'],
                    'blpv'=>$current_user_pv,
                    'brpv'=>$user->balance_pv_right,
                    'amount'=>0,
                    'bpv'=>$user->balance_pv_left.':'.$user->balance_pv_right,
                    'created_at'=>date('Y-m-d')
                    ]);                
              }else{
                   if ($loopRight >=$loopLeft) {

                      for ($i=1; $i <=$loopRight ; $i++) { 
                            for ($l=1; $l <=$loopLeft ; $l++) { 
                                  if ($i/2 == $l/1) {
                                      $userPaytype =   User::where('user_key',$user_key['user_key'])->first();
                                      $isPayment = 1;
                                      $amount  =  2000;
                                      $totalPVRightBalance = $loopRight -$i;
                                      $totalPVLEftBalance = $loopLeft -$l;
                                      $totalPVRight1 = $totalPVRightBalance;
                                      $totalPVLeft1 = $totalPVLEftBalance;
                                      $frightamount+=$amount;

                                  }

                            }
                      }

              
                      
                    }else{
                            for ($i=1; $i <=$loopLeft ; $i++) { 
                                  for ($l=1; $l <=$loopRight ; $l++) { 
                                          if ($i/2 == $l/1) {
                                              $userPaytype =   User::where('user_key',$user_key['user_key'])->first();
                                              $isPayment = 1;
                                              $amount  =  2000;
                                              $totalPVRightBalance = $loopRight -$l;
                                              $totalPVLEftBalance = $loopLeft -$i;
                                              $totalPVRight1 = $totalPVRightBalance;
                                              $totalPVLeft1 = $totalPVLEftBalance;
                                              $frightamount+=$amount;

                                          }

                                  }
                            }
                    }
              }

        
               if ($isPayment) {
               $this->logic21payment($totalPVRight1,$totalPVLeft1,$current_user_pv,0,$frightamount,$user_key['user_key'],$TDMCharges);
              }
      }


		    
		    }


        public function logic21payment($totalPVRight1,$totalPVLeft1,$loopLeft,$loopRight,$amount,$user_key,$TDMCharges,$current_user)
     {
       $user =   User::where('user_key',$user_key)->first();
       if ($user->package_id) {
          $earning = $amount;
          $adminamount = $earning*$TDMCharges[1]/100; /*Admin Charge %*/
          $TDS =  $earning*$TDMCharges[2]/100; /*TDS %*/
          $deduction = $TDS+$adminamount;
          $amountToBepaid = $earning-$deduction;
          DB::table('user_point_values')->insert(
          [
          'user_key'=>$user_key,
          'user_by'=>$current_user,
          'blpv'=>$loopLeft,
          'brpv'=>$loopRight,
          'amount'=>$amountToBepaid,
          'bpv'=>$totalPVLeft1.':'.$totalPVRight1,
          'created_at'=>date('Y-m-d')
          ]);

         
          $user->balance_pv_right=$totalPVRight1;
          $user->balance_pv_left=$totalPVLeft1;
          $user->save();

        if (isset($user->package->daily_caping)) {
          $amountCap=$user->package->daily_caping;
          $resp =  Payment::paymentCaping($user_key,1,$amountCap,$amount);
          Log::info('user caping info',['respCap'=>$resp,'user_key'=>$user_key,'amountCap'=>$amountCap,'New AMount'=>$amount]);
          if ($resp=='yes'){
              Payout::pay($user_key,$amount,$TDMCharges[1],$TDMCharges[2],1,$status=1,'Team Bonus Income',$current_user);
          }elseif ($resp=='no') {
        
          }else{
          Payout::pay($user_key,$resp,$TDMCharges[1],$TDMCharges[2],1,$status=1,'Team Bonus Income, Remaing amount washed',$current_user);
          }

        }
      }



     }

}
