<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
        $rules = [
            'name' => [
                'required',
                'min:3',
                'max:60'
            ],
            'surnames' => [
                'required',
                'min:3',
                'max:60'
            ],
            'email' => [
                'required',
                'email',
                'min:4',
                'max:200'
            ],
            'password' => [
                'required',
                'min:6',
                'max:20'
            ],
            'plan' => [
                'required'
            ]
        ];

        return $rules;
    }
}
