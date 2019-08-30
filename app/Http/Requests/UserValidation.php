<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserValidation extends FormRequest
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
            'name' => [

                Rule::unique('users')->ignore($this->user),
                'required',
                'max:25',
                'string',
            ],
            'email' => [

                Rule::unique('users')->ignore($this->user),
                'required', 'max:50', 'email',
            ],
            'password'  => [
                'sometimes', 'required', 'string', 'confirmed', 'min:8',
            ],
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email is required!',
            'name.required' => 'Name is required!',
            'password.required' => 'Password is required!'
        ];
    }
}
