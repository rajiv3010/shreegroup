<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PinRequest extends FormRequest
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

    public function messages() {
        return [
            'package_id.required' => 'A Package name is required',
            'qty.required' => 'A Qty is required',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'package_id' => 'required',
            'qty' => 'required',
        ];
    }
}
