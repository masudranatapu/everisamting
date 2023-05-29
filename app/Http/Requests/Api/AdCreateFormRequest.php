<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class AdCreateFormRequest extends FormRequest
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
            'title' => 'required|unique:ads,title',
            'category_id' => 'required',
            'subcategory_id' => 'sometimes',
            'brand_id' => 'required',
            'city_id' => 'required',
            'town_id' => 'required',
            'price' => 'required|numeric',
            'phone' => 'required',
            'description' => 'required',
            'images.*' => 'required'
            // 'images.*' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ];
    }

    // public function messages()
    // {
    //     return [
    //         'images.*.image' => "The image is not valid",
    //         'images.*.mimes' => "The image must be a file of type: jpeg, png, jpg.",
    //         'images.*.max' => 'The image may not be greater than 2 MB.',
    //     ];
    // }
}
