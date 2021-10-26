<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banking extends Model
{
    protected $fillable = [
	'company_name','bank_name','account_number','branch_name','ifsc'
	];
}
