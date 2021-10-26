<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class UserBankDetail extends Model
{
 protected $fillable = [
        'user_key', 'account_no', 'name','branch','ifsc','city','kyc_document','is_kyc_document'
    ];

}
