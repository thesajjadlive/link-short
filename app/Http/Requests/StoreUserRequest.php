<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name'      =>'required',
            'email'     =>'required|string|email|max:255|unique:users',
            'password'  =>'required|confirmed|string|min:8',
            'roles'     => "required|array|min:1",
            "roles.*"   =>"required|distinct|min:1",
            'avatar'    =>'nullable|mimes:jpg,jpeg,png|max:1024',
        ];

    }
}
