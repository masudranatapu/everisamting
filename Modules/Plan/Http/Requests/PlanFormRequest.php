<?php

namespace Modules\Plan\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'price' =>  ['required', 'numeric',],
            'ad_limit' =>  ['required', 'numeric',],
            'featured_limit' =>  ['required', 'numeric',],
            'badge' =>  ['required', 'boolean',],
            'business_directory_limit' =>  ['required', 'numeric',],
        ];

        if ($this->method() == 'POST') {
            $rules['label'] =  ['required', 'string', 'unique:plans,label'];
        } else {
            $rules['label'] =  ['required', 'string',  "unique:plans,label,{$this->plan->id}"];
        }

        return $rules;
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
