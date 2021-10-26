<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WinnersClubHistory extends Model
{
   protected $fillable = ['winners_club_id','date','sell','actual_amount','modified_amount','achievers','distributed'];
}
