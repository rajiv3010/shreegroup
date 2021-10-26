<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Package;
use App\AssignPin;
use Auth;

class Pin extends Model
{

     protected $fillable = ['user_key','created_by','package_id', 'pin_number'];

     public function getAvailablePin()
     {
        return Pin::whereNotIn('id', function($query){
                $query->select('pin_id')
                ->from('assign_pins');
        })
        ->orderby('created_at','DESC')
        ->paginate(15);
     }


    public function usedBy()
    {
        return $this->belongsTo('App\User','pin_number','pin_number');
    }
   public function allottedPinTo()
    {
        return $this->belongsTo('App\User','pin_owner','user_key');
    }

    public function pinSent()
    {
     return   $this->hasOne('App\AssignPin');
    } 


    public function package()
    {
        return $this->belongsTo('App\Package');
    }
    public function pinassign()
    {
    	return $this->hasMany('App\AssignPin');
    }
    public function dpcPinCreation($data)
    {
      $dpcwallet = Auth::guard('dpc')->user()->wallet;
      $package=  Package::where('id',$data['package_id'])->first();
      $purchasingamount = $data['qty']*$package->amount;
      if($dpcwallet < $purchasingamount){
          return 1;
      }else{
  

      for ($i=1; $i <= $data['qty'] ; $i++) {


        $resArray[] = Pin::create([
                    'package_id'=>$data['package_id'],
                    'user_key'=>Auth::guard('dpc')->user()->dpc_key,
                    'created_by'=>3,
                    'pin_number'=>'dpc'.date('YmdHis').rand(1, 1000),
        ]);
        }
         $dpcwallet =$dpcwallet-$purchasingamount;
          DPC::where('id',Auth::guard('dpc')->user()->id)->where('dpc_key',Auth::guard('dpc')->user()->dpc_key)
                  ->update(['wallet'=>$dpcwallet]);
        return 0;
      }
    }
    public function savePin($data,$user_key,$created_by)
    {
    	for ($i=1; $i <= $data->qty ; $i++) {
               Pin::create([
                    'package_id'=>$data['package_id'],
                    'user_key'=>$user_key,
				          	'created_by'=>$created_by,
          					'pin_number'=>rand(1, 1000).date('YmdHis'),
				]);
    		}
    	return $data->qty;
    }
        public function createTraningPin()
        {
          $resArray = [];
            for ($i=1; $i <=Auth::user()->package->traning_package_count ; $i++) {

                $resArray[] = Pin::create([
                    'package_id'=>5,
                    'user_key'=>Auth::user()->user_key,
                    'created_by'=>2,
                    'pin_number'=>'T'.rand(1, 1000).'P'.date('YmdHis'),
                ]);
            }
            if (count($resArray)) {
              User::where('user_key',Auth::user()->user_key)->update(['traning_package_create'=>1]);
             return count($resArray);
            }
           return count($resArray);
        }

        public function createPin($user_key,$count,$package_id,$created_by)
        {
          for ($i=1; $i <=$count; $i++) {
                  Pin::create([
                     'package_id'=>$package_id,
                     'user_key'=>$user_key,
                     'created_by'=>$created_by,
                     'pin_number'=>'T'.rand(1, 1000).'P'.date('YmdHis'),
                 ]);
              }
              return true;

        }


     public function createPinRequest($user_key,$count,$package_id,$created_by)
        {
          for ($i=1; $i <=$count; $i++) {
                $pin =   Pin::create([
                     'package_id'=>$package_id,
                     'user_key'=>$user_key,
                     'created_by'=>$created_by,
                     'pin_number'=>'T'.rand(1, 1000).'P'.date('YmdHis'),
                 ]);
            Pin::where('id',$pin->id)->update(['pin_owner'=>$user_key,'status'=>2]);
            AssignPin::create([
            'user_key'=>$user_key,
            'pin_id'=>$pin->id,
            'assign_by'=>'admin',
            'status'=>1,
            'pin_owner'=>$user_key,
            'assign_by_user_key'=>1,
              ]);

              
        }
        return true;

  }



}
