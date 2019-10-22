<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssociadoFormRequest extends CommonFormRequest
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
            'contatos'                          => 'required',
            'grau_instrucao_id'                 => 'required',
            'dados_funcionais.data_admissao'    => 'required',
            'dados_funcionais.pis_pasep'        => 'required',
            'dados_funcionais.portaria'         => 'required',
            'locais_de_trabalho.local_de_trabalho_id' => 'required',
            'locais_de_trabalho.funcao'         => 'required',
            'locais_de_trabalho.matricula'      => 'required',
            'tipo_pagamento_id'                 => 'required',
            'area_atuacao_id'                   => 'required'
        ];

        $rules += $this->getDadosPessoaisRules();
        $rules += $this->getContatoRules();

        return $rules;
    }

    public function messages()
    {

        $messages = [
            'contatos.required'             => 'Por favor, informe pelo menos um contato!',
            'grau_instrucao_id.required'    => 'Selecione o grau de instrução',
            'tipo_pagamento_id.required'    => 'Selecione o tipo de pagamento',
            'area_atuacao_id.required'      => 'Selecione a área de atuação'
        ];

        $messages += $this->getDadosPessoaisMessages();
        $messages += $this->getContatoMessages();

        return $messages;
    }
}
