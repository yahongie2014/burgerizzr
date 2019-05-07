<?php

namespace App\Http\Requests;

use http\Env\Response;
use Illuminate\Foundation\Http\FormRequest;

class UserValdation extends FormRequest
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
//            'name' => 'required',
//            'avatar' => 'required',
//            'email' => 'required|string|email|unique:users',
            'phone' => 'required|min:6',
           // 'device_token' => 'required',
//            'longitude' => 'required',
//            'latitudes' => 'required',
//            'password' => 'required',
//            'city_id' => 'required|exists:cities,id',
        ];
    }

    public function forbiddenResponse()
    {
        return new Response(false, 403);
    }
}
