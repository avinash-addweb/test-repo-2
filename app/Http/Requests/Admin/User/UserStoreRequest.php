<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;
class UserStoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'                  => 'required|min:3|max:50|regex:/^[a-zA-Z0-9 -]+$/u',
            'email'                 => 'required|email:rfc|unique:users,email',
            'password'              => 'required|confirmed|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?& ]{8,}$/u',
            'password_confirmation' => 'required',
            //'status'                => 'required',
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
            'name.regex' => __('custom.:attribute can only contain alphanumeric characters.',['attribute'=>__('Name')]),
            'name.min' => __('custom.:attribute should contain atleast :minCount alphanumeric characters.',['attribute'=>__('Name'),'minCount'=>'3']),
            'name.max' => __('custom.:attribute should not contain more than :maxCount alphanumeric characters.',['attribute'=>__('Name'),'maxCount'=>'50']),
            'email.required' => __('custom.:attribute is required.',['attribute'=>__('Email')]),
            'email.regex' => __('custom.:attribute can only contain alphanumeric characters.',['attribute'=>__('Email')]),
            'email.unique' => __('custom.:attribute must be unique.',['attribute'=>__('Email')]),
            'password.required' => __('custom.:attribute is required.',['attribute'=>__('Password')]),
            'password.confirmed'  => __('custom.:attribute & :attribute2 must be same',['attribute'=>__('Password'),'attribute2'=>__('Confirm Password')]),
            'password.min'  => __('custom.:attribute must have at least :minCount characters',['attribute'=>__('Password'),'minCount'=>'8']),
            'password.regex' => __('custom.:attribute must consist of minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character.',['attribute'=>__('Password')]),
            //'password_confirmation.required' => __('custom.:attribute is required.',['attribute'=>__('Confirm Password')]),

        ];
    }
}