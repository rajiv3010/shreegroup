<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Payout;
use DB,Log;
class WithdrawRequest extends Model
{
      protected $fillable = [
        'user_key','amount','status'
      ];


}
