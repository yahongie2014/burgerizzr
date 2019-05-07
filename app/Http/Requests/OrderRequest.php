<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'data' => 'required',
            'promo_id' => 'required|integer',
            'order_lat' => 'required',
            'order_long' => 'required',
            'points' => 'required',
            'meal_name_user' => 'required',
            'ingrediens' => 'required',
            'extra' => 'required',
            'branch_id' => 'required|integer',
            'total' => 'required',
            'delivery_type' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'branch_id.required' => __("general.branch_required"),
            'branch_id.integer' => __("general.branch_integer"),
        ];
    }
}
