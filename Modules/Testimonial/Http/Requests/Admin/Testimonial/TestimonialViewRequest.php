<?php

namespace Modules\Testimonial\Http\Requests\Admin\Testimonial;

use Illuminate\Foundation\Http\FormRequest;
class TestimonialViewRequest extends FormRequest
{
    public mixed $id;

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
            // 'id'    => 'required|regex:/^[0-9 -]+$/u',
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
            'id.required'   => __('testimonial::custom.:attribute is required.',['attribute'=>__('Id')]),
            'id.regex'      => __('testimonial::custom.:attribute can only contain numeric characters.',['attribute'=>__('Id')]),
        ];
    }
}