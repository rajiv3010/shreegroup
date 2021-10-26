<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageDescription extends Model
{
    protected $fillable = [
		'package_id','description','qty',
    ];

 public function package()
    {
    	return $this->belongsTo('App\Package');
    }

}
