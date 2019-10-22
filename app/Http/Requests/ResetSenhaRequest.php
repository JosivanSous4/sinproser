<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetSenhaRequest extends FormRequest
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
            'password'              => 'required|min:8|confirmed',
            'password_confirmation' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'password.required'              => 'Por favor, digite a senha',
            'password.min'                   => 'A sua nova senha deve ter no mínimo 8 caractéres.',
            'password.password'              => 'As senhas devem ter pelo menos oito caracteres e corresponder à confirmação.',
            'password.confirmed'             => 'As senha não correspondem.',
            'password_confirmation.required' => 'Por favor, digite a confirmação de senha'
        ];
    }
}
