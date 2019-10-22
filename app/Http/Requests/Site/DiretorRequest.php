<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class DiretorRequest extends FormRequest
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
            'nome'  => "required",
            'cargo' => "required"
        ];
    }

    public function messages()
    {
        return [
           'nome.required'  => "Digite o nome do diretor!",
           'cargo.required' => "Digite o cargo!"
        ];
    }
}
