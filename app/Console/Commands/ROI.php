<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\UpgradeHistory;
use App\Payout;
use App\GenerationIncome;
use App\Charge;
use DB;
class ROI extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'roi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $charges = Charge::all();
            $adminCharges =  $charges[0]->percentage;
            $TDSpercent =  $charges[1]->percentage;

       $roi_conditions = DB::table('roi_conditions')->where('status',0)->get()->toarray();
       $upgradeHistories =  UpgradeHistory::with(['user','package','package.levelLimit'])->where('status',1)->get();
       $saveBulk = $payBulk= $userGeneration= [];
       foreach($upgradeHistories as $upgradeHistory):    
                $count  = $upgradeHistory->paid_month;
                $month = ($count)?$count+1:1;
                $percentage  = $this->getCurrentMonthPercentage($roi_conditions,$month);
                $amount = $upgradeHistory->package->amount*$percentage/100;
                if(!$count):
                 $amount =    $this->checkDayDiff($upgradeHistory,$amount);
                endif;
                if($percentage):
                

                    $userGeneration[] = [
                        'user_key'=>$upgradeHistory->user_key,
                        'user'=>$upgradeHistory,
                        'amount'=>$amount,
                 ];
                 $saveBulk[] = [
                        'user_key'=>$upgradeHistory->user_key,
                        'package_id'=>$upgradeHistory->package_id,
                        'percentage'=>$percentage,
                        'month'=>$month,
                        'amount'=>$amount,
                        'status'=>0,
                 ];
                    $upgradeHistory->paid_month = $month;
                    $upgradeHistory->save();
                    $message = "ROI for month  " . $month;
                    $adminChargesAmount = $amount * $adminCharges / 100;
                    $tdsAmount = $amount * $TDSpercent / 100;
                    $payBulk[] = [
                        'user_key'=>$upgradeHistory->user_key,
                        'activity_id'=>session('activity_id'),
                        'amount'=>$amount,
                        'percentage'=>0,
                        'business_area_id'=> 4,
                        'earning'=>$amount,
                        'tds'=>$tdsAmount,
                        'message'=>$message,
                        'admin_charges'=>$adminChargesAmount,
                        'earning_by'=>$upgradeHistory->user_key,
                        'status'=>0,
                        'user_type_id'=>1,
                    ];
                endif;
            endforeach;
            DB::table('roi_user_achievements')->insert($saveBulk);
            Payout::insert($payBulk);

            $this->generationIncome($userGeneration);
    }

    public function checkDayDiff($upgradeHistoryData,$amount)
    {          
              $satrtdate   =  date('Y-m-d', strtotime('+5 day', strtotime($upgradeHistoryData->created_at)));
              $to = \Carbon\Carbon::createFromFormat('Y-m-d', $satrtdate);
              $from = \Carbon\Carbon::createFromFormat('Y-m-d',date('Y-m-19'));  //Month end date
              $diff_in_days = $to->diffInDays($from);
              $amount  = $amount/30;
              return $amount*$diff_in_days;
 }

    public function getCurrentMonthPercentage($records,$month)
    {
        foreach($records as $record):
            if($record->month == $month):
                    return $record->percentage;
                endif;

            endforeach;
    }


    public function generationIncome($achivers)
    {
            $charges = Charge::all();
            $GenerationIncome = new GenerationIncome();
            $adminCharges =  $charges[0]->percentage;
            $TDSpercent =  $charges[1]->percentage;
            foreach($achivers as $achiver){
                 $levelLimit = $achiver['user']->package->levelLimit;
                 $GenerationIncome->DirectLevelWise($achiver['user_key'],$levelLimit,3,$achiver['amount'],$adminCharges,$TDSpercent,$achiver['user_key']);           
            }
    }




}
