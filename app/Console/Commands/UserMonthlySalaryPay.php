<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\UserMonthlySalary;
use App\Payout;
class UserMonthlySalaryPay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'UserMonthlySalaryPay';

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
        $month = date('m');
       $userMonthlySalaries =  UserMonthlySalary::where('status',0)->whereMonth('date',$month)->get();
       $payBulk=$bulkUpdate = [];
       foreach($userMonthlySalaries as $userMonthlySalary):    
                    $message = "Montly salary";
                    $payBulk[] = [
                        'user_key'=>$userMonthlySalary->user_key,
                        'activity_id'=>session('activity_id'),
                        'amount'=>$userMonthlySalary->amount,
                        'percentage'=>0,
                        'business_area_id'=> 4,
                        'earning'=>$userMonthlySalary->amount,
                        'tds'=>0,
                        'message'=>$message,
                        'admin_charges'=>10,
                        'earning_by'=>0,
                        'status'=>0,
                        'user_type_id'=>1,
                    ];
                   $bulkUpdate[]=$userMonthlySalary->id;
            endforeach;
            UserMonthlySalary::wherein('id',$bulkUpdate)->update(['status'=>1]);
            Payout::insert($payBulk);
    }
}
