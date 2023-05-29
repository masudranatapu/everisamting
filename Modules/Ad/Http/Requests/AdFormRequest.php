<?php

namespace Modules\Ad\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->method() === 'POST') {
            return [
                'title' => 'required|unique:ads,title',
                'price' => 'required_unless:category_id,2,10',
                'category_id' => 'required',
                'description' => 'required',
                'thumbnail' => 'required',
                'user_id' => "required",
                'address' => "required",
            ];
        } else {
            return [
                'title' => "required|unique:ads,title,{$this->ad->id}",
                'price' => 'required_unless:category_id,2,10',
                'category_id' => 'required',
                'description' => 'required',
                'user_id' => "required",
                'address' => "required",
            ];
        }
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
