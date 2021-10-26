<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdvertisementReportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
 
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    // public function messages() {
    //     return [
    //         'lat.required' => 'A latitide is required',
    //         'lng.required' => 'A longitude is required',
    //         'name.required' => 'Restaurant name is required',
    //     ];
    // }
    public function rules()
    {
         return [
            'report_date' => 'required',
            'report_time' => 'required',
            'category' => 'required',
            'company' => 'required',
            'type' => 'required',
            'offer_name' => 'required',
            'ip' => 'required',
            'user_id' => 'required',
            'user_name' => 'required',
            'state' => 'required',
            'city' => 'required',
            'email' => 'required',
            'status' => 'required',
            'point' => 'required',
        ];
    }
}
