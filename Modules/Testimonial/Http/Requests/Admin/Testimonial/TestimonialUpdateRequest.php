<?php

namespace Modules\Testimonial\Http\Requests\Admin\Testimonial;

use Illuminate\Foundation\Http\FormRequest;
class TestimonialUpdateRequest extends FormRequest
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
            'lang_code'  => 'required',
            'name'   => 'required|min:3|max:50|string',
            'email'     => 'required|email:rfc',
            'contents'     => 'required|min:10',
            'designation'  => 'required|min:2|string',
            'image'        => [
                'nullable',
                //custom validation for file manager media uploads
                function ($attribute, $value, $fail) {
                    if (!empty($value)) {
                        $value = \strtolower(\str_replace(\Illuminate\Support\Facades\URL::to('/').DIRECTORY_SEPARATOR,"",$value));
                        $media_type = @\File::mimeType(public_path('storage'.DIRECTORY_SEPARATOR.$value));
                        $media_ext = @\File::extension(public_path('storage'.DIRECTORY_SEPARATOR.$value));
                        $media_size = (int)@\File::size(public_path('storage'.DIRECTORY_SEPARATOR.$value))??0;
                        $media_size = \number_format($media_size / 1048576, 2);//file size convert in mb
                        if (!empty($media_ext) && !in_array($media_ext,['jpg','png','jpeg']) && !in_array($media_type,['image/png','image/jpeg'])) {
                            $fail(__('testimonial::custom.:attribute file format is not allowed. (Allowed formats : :allowedFormat).',['attribute'=>__($attribute),'allowedFormat'=>'jpeg,png,jpg']));
                        }
                        if ($media_size>1) {
                            $fail(__('testimonial::custom.:attribute size should not exceed the from :maxSize mb.',['attribute'=>__($attribute),'maxSize'=>'1']));
                        }
                    }
                },
            ],
            //'image'        => 'nullable|mimes:jpeg,png,jpg|max:1024'
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
            'lang_code.required' => __('testimonial::custom.:attribute is required.',['attribute'=>__('Language')]),
            'name.required' => __('testimonial::custom.:attribute is required.',['attribute'=>__('Name')]),
            'name.string' => __('testimonial::custom.:attribute can only contain alphanumeric characters.',['attribute'=>__('Name')]),
            'name.min' => __('testimonial::custom.:attribute should contain atleast :minCount alphanumeric characters.',['attribute'=>__('Name'),'minCount'=>'3']),
            'name.max' => __('testimonial::custom.:attribute should not contain more than :maxCount alphanumeric characters.',['attribute'=>__('Name'),'maxCount'=>'50']),
            'contents.required' => __('testimonial::custom.:attribute is required.',['attribute'=>__('Contents')]),
            'contents.min' => __('testimonial::custom.:attribute should contain atleast :minCount alphanumeric characters.',['attribute'=>__('Contents'),'minCount'=>'10']),
            'designation.required' => __('testimonial::custom.:attribute is required.',['attribute'=>__('Designation')]),
            'designation.string' => __('testimonial::custom.:attribute can only contain alphanumeric characters.',['attribute'=>__('Designation')]),
            'designation.min' => __('testimonial::custom.:attribute should contain atleast :minCount alphanumeric characters.',['attribute'=>__('Designation'),'minCount'=>'2']),
            //'image.required' => __('testimonial::custom.:attribute is required.',['attribute'=>__('Image')]),
            // 'image.mimes' => __('testimonial::custom.:attribute file format is not allowed. (Allowed formats : :allowedFormat).',['attribute'=>__('Image'),'allowedFormat'=>'jpeg,png,jpg']),
            // 'image.max' => __('testimonial::custom.:attribute size should not exceed the from :maxSize mb.',['attribute'=>__('Image'),'maxSize'=>'1']),
        ];
    }
}