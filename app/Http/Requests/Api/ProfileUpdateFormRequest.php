<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateFormRequest extends FormRequest
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
        $user_id = auth('api')->id();

        return [
            'name' => "required",
            'email' => "required|email|unique:users,email,{$user_id}",
            'phone' => "sometimes|nullable",
            'web' => "sometimes|nullable|url",
            'image' => "sometimes|nullable|image|mimes:jpeg,png,jpg|max:2048",
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'image.max' => 'The image must be less than 2 MB.',
        ];
    }
}
