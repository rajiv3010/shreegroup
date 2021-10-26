<?php

namespace App;

use DB;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Notifications\ResetPasswordAdmin as ResetPasswordNotificationAdmin;
use Auth;
use App\Pin;
use App\Notification;
class Admin extends Authenticatable implements CanResetPassword {

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "admins";
    protected $fillable = [
        'user_key','is_merchant','merchant_id','name', 'email','mobile', 'password','master_password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function role(){
        return $this->belongsTo('App\AdminType','admin_type_id','id');
    }

    public function products()
    {
        return $this->hasMany("App\Mall\Product",'merchant_id','id');
    }
    public function getNotifications()
    {
        return ;
    }

    public function getTurnOver()
    {
      return   Pin::select('pins.status',DB::raw('count(pins.id) as total_Count'),DB::raw('sum(packages.amount) as amount'))
             ->join('packages','packages.id','=','pins.package_id')
             ->GROUPBY('pins.status')
             ->get();
    }
}
