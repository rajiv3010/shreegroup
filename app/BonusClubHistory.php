<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BonusClubHistory extends Model
{
   protected $fillable = ['bonus_club_id','date','sell','actual_amount','modified_amount','achievers','distributed'];
}
