<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserWalletLog extends Model
{
	protected $fillable = ['user_key', 'old_wallet', 'add_amount', 'new_wallet', 'admin_id','user_type'];


	public function admin()
	{
		return $this->belongsTo('App\Admin','admin_id','user_key');
	}
 }
