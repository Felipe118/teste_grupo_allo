<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
    public function rules() :array
    {
        return [
            'name' => ['required'],
            'email' => ['required'],
            'password' => ['required']
        ];
    }

    public function messages() :array
    {
        return [
            'required' => 'O campo :attribute é obrigatório'
        ];
    }
}
