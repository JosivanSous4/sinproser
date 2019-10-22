<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InformacoesSindicatoFormRequest extends CommonFormRequest
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
            'nome'      => 'v',
            'descricao' => 'required'
            'contatos'  => 'required',
        ];

        $rules += $this->getContatoRules();

        return $rules;
    }

    public function messages()
    {

        $messages = [
            'nome.required'      => 'Por favor, informe o nome do sindicato!',
            'descricao.required' => 'Por favor, informe a descricao!',
            'contatos.required'  => 'Por favor, informe pelo menos um contato!',
        ];

        $messages += $this->getContatoMessages();

        return $messages;
    }
}