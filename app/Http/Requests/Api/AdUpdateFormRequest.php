<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class AdUpdateFormRequest extends FormRequest
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
            'title' => "required|unique:ads,title,{$this->ad->id}",
            'category_id' => 'required',
            'subcategory_id' => 'sometimes',
            'brand_id' => 'required',
            'city_id' => 'required',
            'town_id' => 'required',
            'price' => 'required|numeric',
            'phone' => 'required',
            'description' => 'required',
        ];
    }
}
