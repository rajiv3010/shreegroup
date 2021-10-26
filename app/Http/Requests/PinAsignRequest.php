<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PinAsignRequest extends FormRequest
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
    public function messages()
    {
            return [
                 'required' => 'The :attribute field can not be blank.'
            ];
    }
    public function rules()
    {
        return [
             'user_key' => 'required',
             'pin_id' => 'required',
        ];
    }
}
