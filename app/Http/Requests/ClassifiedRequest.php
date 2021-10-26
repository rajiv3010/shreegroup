<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class ClassifiedRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    public function messages() {
        return [
            'lat.required' => 'A latitide is required',
            'lng.required' => 'A longitude is required',
            'name.required' => 'Restaurant name is required',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        
        return [
            'name' => 'required',
            'user_name' => 'required',
            'email' => 'required|unique:admins',
            'password' => 'required',
            'address' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'status' => 'required',
            'image' => 'required',
        ];
    }

}

