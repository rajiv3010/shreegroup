<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\LevelIncomeCondition;
use App\UpgradeHistory;
use App\Achievement;
use App\UserMonthlySalary;
use App\User;
use DB, Log;

class GenerationIncome extends Model
{
  public $parent =   array();
  public $user_in_downline =   array();
  public $user_keys =   array();
  public $p = 1;

  // New Logic20000

  public function generationPayment($user_key)
  {
    $sponsors  =  $this->directUpperLevel($user_key, $user_key);
    foreach ($sponsors as $sponsor) :
      $currentSponsor = User::where('user_key', $sponsor['uid'])->first();
      $top_levels  =  User::with(['package'])->select('user_key', 'achievement_id')->where('parent_key', $sponsor['uid'])->get();
      $grand_total_income = 0;
      foreach ($top_levels as $top_level) :
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

            $cu_achi = ($sponsor['achievement_id'])?$sponsor['achievement_id']+1:1;
        //$achievment = Achievement::whereRaw('? between min and max', [$grand_total_income])->first();
        $achievment = Achievement::find($cu_achi);
                Log::info('Check diffAmount',['achievment'=>$achievment,'grand_total_income'=>$grand_total_income,'UK'=>$sponsor['uid']]);
      // CheckAchievmet:if
      if ($achievment != null) :
       $is_eligible_for_payment =  $this->checkBinaryEligibility($top_levels,$achievment->min);
       //is_eligible_for_payment:if
       if($is_eligible_for_payment):
        $diffAmount = 0;
        $monthlySalaryAmount = round(($achievment->min * $achievment->percentage / 100) / 12, 2);
        if (!$sponsor['achievement_id']):
          Log::info('Amount checking',['monthlySalaryAmount'=>$monthlySalaryAmount,'user_key'=>$sponsor['uid']]);
          $diffAmount  =   $this->checkDayDiff($currentSponsor, $monthlySalaryAmount);
        endif;

        $myMonthlySalary = [];
        $is_record =  UserMonthlySalary::where('user_key', $sponsor['uid'])
          ->where('achievement_id', $achievment->id)->count();
       //is_record:if
        if (!$is_record) :       

          $current_month_count =1;
          for ($ms = 1; $ms <= 12; $ms++) :
          Log::info('Check diffAmount',['diffAmount'=>$diffAmount,'ms'=>$ms,'current_month_count'=>$current_month_count,'user_key'=>$sponsor['uid']]);
            if ($diffAmount && $ms == 1) :
              $exactAmount = $diffAmount;
              $current_month_count =   (date('d') < 14)?0:1;
            else :
              $exactAmount = $monthlySalaryAmount;
            endif;
              
              $date = date('Y-m-19', strtotime("+" . $current_month_count . " month"));
            $myMonthlySalary[]  = [
              'user_key' => $sponsor['uid'],
              'achievement_id' => $achievment->id,
              'amount' => $exactAmount,
              'status' => 0,
              'date' => $date,
              'created_at'=>now()
            ];
            $current_month_count++;
          endfor;
          $currentSponsor->achievement_id  = $achievment->id;
          $currentSponsor->save();
          UserMonthlySalary::where('user_key', $sponsor['uid'])
            ->where('status', 0)
            ->update(['status' => 2, 'washed_date' => date('Y-m-d')]);
          UserMonthlySalary::insert($myMonthlySalary);
          endif;//is_record:endif
      endif;//is_eligible_for_payment:endif
    endif; //CheckAchievmet:endif
endforeach;
  }

  public function checkBinaryEligibility($topTeams,$min)
  {

//     $topTeams = $topTeams->sortByDesc(function($item){
//     return $item->total_income;
// })->values();
    $group_a = $topTeams->splice(0,2);
    $group_a_total_income = $group_a->sum('total_income');
    $group_b_total_income = $topTeams->sum('total_income');
    
    if($group_a_total_income >= $min && $group_b_total_income >= $min):
        return 1;
    endif;
    return 0;
  }
  public function checkDayDiff($upgradeHistoryData, $amount)
  {
    $satrtdate   =  date('Y-m-d', strtotime('+5 day', strtotime($upgradeHistoryData->created_at)));
    $to = \Carbon\Carbon::createFromFormat('Y-m-d', $satrtdate);
    $from = \Carbon\Carbon::createFromFormat('Y-m-d', date('Y-m-19'));  //Month end date
    $diff_in_days = $to->diffInDays($from);
    Log::info('Amount checking',['diff_in_days'=>$diff_in_days,'amount'=>$amount]);
    $amount  = $amount / 30;
    Log::info('Amount checking',['amount'=>$amount,'final'=>$amount*$diff_in_days]);
    return round($amount * $diff_in_days,2);
  }

  public function directUpperLevel($user_key, $current_user)
  {
    if ($user_key) {

      $sUser = DB::table('users')->where('user_key', $user_key)->select('parent_key', 'package_id', 'achievement_id')->first();

      $this->parent[] = ['uid' => $user_key, 'achievement_id' => $sUser->achievement_id];
      //   $this->parent .=',';
      $this->parent_key = $this->directUpperLevel($sUser->parent_key, $current_user);
      if (isset($sUser->parent_key)) {
        $this->parent[] = ['uid' => $sUser->parent_key, 'achievement_id' => $sUser->achievement_id];
      }
    } else {
      unset($this->parent[0]);
      if (count($this->parent) > 0) {
        $this->user_keys =    $this->parent;
      }
    }
    return $this->user_keys;
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
  // New Logic


  /****************************************************************************
   **********************Advertisment  Payment**************************
   *****************************************************************************/

  //    public function directUpperLevel($user_key,$current_user)
  //    {
  //      if ($user_key) {

  //    $sUser = DB::table('users')->where('user_key',$user_key)->select('sponsor_key','package_id')->first();

  //     $this->parent[] .=$user_key;
  // //   $this->parent .=',';
  //    $this->parent_key = $this->directUpperLevel($sUser->sponsor_key,$current_user);
  //    if (isset($sUser->sponsor_key)) {
  //    $this->parent[] .= $sUser->sponsor_key;
  //    }

  //      }else{
  //           unset($this->parent[0]);
  //          if (count($this->parent) > 0) {
  //                  $this->user_keys =    $this->parent;
  //          }
  //      }
  //          return $this->user_keys;

  //  }




  public function DirectLevelWise($user_key, $adverLvel, $business_area_id, $amount, $adminCharges, $tds, $current_user)
  {
    if ($user_key) {

      $sUser = DB::table('users')->where('user_key', $user_key)->select('sponsor_key', 'package_id')->first();

      $this->parent[] .= $user_key;
      //   $this->parent .=',';
      $this->parent_key = $this->DirectLevelWise($sUser->sponsor_key, $adverLvel, $business_area_id, $amount, $adminCharges, $tds, $current_user);
      if (isset($sUser->sponsor_key)) {
        $this->parent[] .= $sUser->sponsor_key;
      }
    } else {
      unset($this->parent[0]);
      if (count($this->parent) > 0) {
        $this->DirectLevelWiseMadePayment($this->parent, $adverLvel, $business_area_id, $amount, $adminCharges, $tds, $current_user);
      }
    }
    $this->parent = [];
    return true;
  }
  public  function DirectLevelWiseMadePayment($users, $adverLvel, $business_area_id, $amount, $adminCharges, $tds, $current_user)
  {
    if (count($users) > count($adverLvel)) {
      $loop = count($adverLvel);
      $loopFor = "Advertisment Count";
    } elseif (count($users) < count($adverLvel)) {
      $loopFor = "users Count";
      $loop = count($users);
    } else {
      $loop = count($adverLvel);
      $loopFor = "Advertisment Count 3rd loop";
    }
   
    for ($i = 1; $i <= $loop; $i++) {
      $percentage = $adverLvel[$i - 1]->percentage;
      $earning = $amount * $percentage / 100;
      $adminChargesAmount = $earning * $adminCharges / 100;
      $tdsAmount = $earning * $tds / 100;
      $deduction = $tdsAmount + $adminChargesAmount;
      $amount_new = $earning - $deduction;
      $message = 'Level Income From user :' . $current_user . ' in level: ' . $i . ' ';

      $userSponsor = User::where('user_key', $users[$i])->first();

      if (isset($userSponsor->package_id)) {
        # code...                   

        if ($userSponsor->is_allowed_for_level_income) {
          if ($i <= $userSponsor->allowed_limit) {
            DB::table('payouts')->insert(['user_key' => $users[$i], 'activity_id' => session('activity_id'), 'amount' => $amount_new, 'earning' => $earning, 'percentage' => $percentage, 'business_area_id' => $business_area_id, 'tds' => $tdsAmount, 'admin_charges' => $adminChargesAmount, 'type' => 'g', 'earning_by' => $current_user, 'status' => 0, 'message' => $message, 'created_at' => date('Y-m-d')]);
          } else {
            // DB::table('payouts')->insert(['user_key'=>$users[$i], 'activity_id'=>session('activity_id'), 'amount'=>$amount_new, 'earning'=>$earning, 'percentage'=>$percentage, 'business_area_id'=>$business_area_id, 'tds'=>$tdsAmount, 'admin_charges'=>$adminChargesAmount, 'type'=>'g', 'earning_by'=>$current_user, 'status'=>0, 'message'=>'By Pass User - '.$message, 'created_at'=>date('Y-m-d') ]);
          }
        } else {


          $count = User::where('sponsor_key', $users[$i])->where('package_type_id', '!=', 3)->count();
          // $level = DB::table('binary_levels')->where('level',$i)->first();
          $direct = $adverLvel[$i - 1]->direct;
          if ($count >= $direct) {
            if ($userSponsor->package_id) {

              DB::table('payouts')->insert(['user_key' => $users[$i], 'activity_id' => session('activity_id'), 'amount' => $amount_new, 'earning' => $earning, 'percentage' => $percentage, 'business_area_id' => $business_area_id, 'tds' => $tdsAmount, 'admin_charges' => $adminChargesAmount, 'type' => 'g', 'earning_by' => $current_user, 'status' => 0, 'message' => $message, 'created_at' => date('Y-m-d')]);
            }/*package Check*/
          } else {
            // DB::table('payouts')->insert(['user_key'=>$users[$i], 'activity_id'=>session('activity_id'), 'amount'=>$amount_new, 'earning'=>$earning, 'percentage'=>$percentage, 'business_area_id'=>$business_area_id, 'tds'=>$tdsAmount, 'admin_charges'=>$adminChargesAmount, 'type'=>'g', 'earning_by'=>$current_user, 'status'=>0, 'message'=>'Test / '.$message, 'created_at'=>date('Y-m-d') ]);
          }
        }
      }
    }
    return true;
  }
}
