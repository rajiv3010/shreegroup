<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomValidationRule extends Model
{
    protected $allowed_countries = ['CH','DE'];

    /**
     * @param $attribute
     * @param $value
     * @param $parameters
     * @param Validator $validator
     * @return bool
     */
    public function verfiyPin($attribute, $value, $parameters,Validator $validator){
        /* validate */
                $count =  Pin::where('package_id',$this->request->get('package_id'))
                    ->where('pin_number',$this->request->get('pin'))
                    ->where('status',1)
                    ->count();

    }
}
