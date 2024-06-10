<?php

namespace App\Http\Requests\Api\v1\User;

use Illuminate\Foundation\Http\FormRequest;
class UserLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email'                 => 'required|email:rfc',
            'password'              => 'required'
        ];
    }
    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
    */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
    */
    public function messages()
    {
        return [

            'name.required' => __('custom.:attribute is required.',['attribute'=>__('Name')]),
            'password.required' => __('custom.:attribute is required.',['attribute'=>__('Password')]),
            'email.email' => __('custom.:attribute is invalid.',['attribute'=>__('Email')]),
            
        ];
    }
}