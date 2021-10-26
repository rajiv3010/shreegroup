<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddManagementRequest extends FormRequest
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
            'category' => 'required',
            'company' => 'required',
            'offer_id' => 'required',
            'offer_name' => 'required',
            'link' => 'required',
            'description' => 'required',
            'point' => 'required',
            'publisher_date' => 'required',
            'expiry_date' => 'required',
        ];
    }
}
