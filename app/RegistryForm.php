<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistryForm extends Model
{
    protected $fillable = [
        'user_key',
        'property_allotment_id',
        'purchasers_name',
        'fathers_name',
        'address',
        'state',
        'pincode',
        'dob',
        'age',
        'phone',
        'alt_phone',
        'aadhaar_number',
        'pan',
        'occupation',
        'religion',
        'customer_bank_name',
        'company_bank_name',
        'paid_amount',
        'cheque_utr_no',
        'date_of_payment',
        'pay_mode',
        'project_name',
        'phase_no',
        'unit_no',
        'plot_1',
        'plot_2',
        'plot_size',
        'rate',
        'tnc_checked',
        'transaction_proof',
        'doc1',
        'doc2',
        'doc3',
        'doc4',
        'doc5',
        'pan_documents',
        'adhaar_front',
        'adhaar_back'
    ];


    public function user()
    {
        return $this->belongsTo('App\User','user_key','user_key');
    }
}
