<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMonthlySalary extends Model
{
    protected $fillable = [
	'user_key','achievement_id','amount','date','status'
	];
}
