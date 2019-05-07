<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class anonymouseValid extends FormRequest
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
    public function rules()
    {
        return [
            'device_token' => 'required|unique:un_register_user',
//            'device_type' => 'required|in:ios,android',
        ];
    }
}
