<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReedeemForm extends FormRequest
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
            'order_long' => 'required',
            'order_lat' => 'required',
            'points' => 'required',
            'branch_id' => 'required',
            'meal_name_user' => 'required',
            'delivery_type' => 'required',

        ];
    }
}
