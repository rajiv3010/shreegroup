<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turnover extends Model
{
   protected $table = 'turnover';
   protected $fillable = ['year','month','manual_turnover','actual_turnover'];

}
