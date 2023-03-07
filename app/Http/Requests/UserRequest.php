<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        return $rules =  [
            'name' => ['required'],
            'email' =>  ['required','email','max:255','unique:users'],
            'password' => ['required']
        ];


        if ($this->method() === 'PATCH' || $this->method() === 'PUT' ) {
            $rules['email'] = [
                'required',
                'email',
                'max:255',
                // "unique:users,email,{$this->id},id"
                Rule::unique('users')->ignore($this->id),
            ];

            $rules['password'] = [
                'nullable',
                'min:6',
                'max:100',
            ];
        }

        return $rules;
    }

    public function messages() :array
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'email.max' => 'Só é permitido até 255 Caracteres',
            'email.unique' => 'E-mail já cadastrado',
            'email.email' => 'Digite um formato de email válido'
        ];
    }
}
