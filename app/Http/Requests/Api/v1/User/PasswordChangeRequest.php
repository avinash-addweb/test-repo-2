<?php

namespace App\Http\Requests\Api\v1\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\PasswordCheckRule;

class PasswordChangeRequest extends FormRequest
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
            'old_password'  => ['required',new PasswordCheckRule()],
            'new_password'  => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?& ]{8,}$/u',
            'confirm_password' => 'required|same:new_password'
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

            'old_password.required' => __('custom.:attribute is required.',['attribute'=>__('Old Password')]),
            'new_password.required' => __('custom.:attribute is required.',['attribute'=>__('New Password')]),
            'confirm_password.required' => __('custom.:attribute is required.',['attribute'=>__('Confirm Password')]),
            'new_password.confirmed'  => __('custom.:attribute & :attribute2 must be same',['attribute'=>__('New Password'),'attribute2'=>__('Confirm Password')]),
            'new_password.min'  => __('custom.:attribute must have at least :minCount characters',['attribute'=>__('Password'),'minCount'=>'8']),
            'new_password.regex' => __('custom.:attribute must consist of minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character.',['attribute'=>__('Password')]),
            'confirm_password.same'  => __('custom.:attribute & :attribute2 must be same',['attribute'=>__('New Password'),'attribute2'=>__('Confirm Password')]),

        ];
    }
}