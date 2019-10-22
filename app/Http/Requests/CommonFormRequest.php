<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CommonFormRequest extends FormRequest
{
    protected function getEnderecoRules()
    {
        return [
            'endereco.estado_id'         =>      'required',
            'endereco.cidade_id'         =>      'required',
            'endereco.bairro'            =>      'required',
            'endereco.rua'               =>      'required',
            'endereco.zona'              =>      'required',
            'endereco.numero_residencia' =>      'required',
        ];
    }

    protected function getEnderecoMessages()
    {
        return [
            'endereco.estado_id.required'         =>      'Selecione um Estado.',
            'endereco.cidade_id.required'         =>      'Selecione uma Cidade.',
            'endereco.bairro.required'            =>      'Informe o Bairro.',
            'endereco.rua.required'               =>      'Informe a Rua.',
            'endereco.zona.required'              =>      'Selecione a Zona.',
            'endereco.numero_residencia.required' =>      'Informe o Numero de Residência.',
        ];
    }



    protected function getContatoRules()
    {
        return [
            'contatos.*.tipo'    =>      'required',
            'contatos.*.contato' =>      'required',
        ];
    }

    protected function getContatoMessages()
    {
        return [
            'contatos.*.contato.required'  =>      'Preencha o Contato.',
            'contatos.*.tipo.required'     =>      'Selecione o Tipo de Contato.',
        ];
    }


    protected function getDadosPessoaisRules()
    {
        return [
            'dados_pessoais.nome'               => 'required',
            'dados_pessoais.sexo'               => 'required',
            'dados_pessoais.estado_civil'       => 'required',
            'dados_pessoais.cpf'                => 'required',
            'dados_pessoais.data_nascimento'    => 'required',
            'dados_pessoais.rg'                 => 'required',
            'dados_pessoais.data_emissao_rg'    => 'required',
            'dados_pessoais.ssp_rg'             => 'required',
        ];
    }

    protected function getDadosPessoaisMessages()
    {
        return [
            'dados_pessoais.nome.required' => 'Preencha o nome',
            'dados_pessoais.sexo.required'=> 'Selecione o sexo',
            'dados_pessoais.estado_civil.required' => 'Selecione o estado civil',
            'dados_pessoais.cpf.required' => 'Informe o cpf',
            'dados_pessoais.data_nascimento.required' => 'Informe a data de nascimento',
            'dados_pessoais.rg.required' => 'Informe o RG',
            'dados_pessoais.data_emissao_rg.required' => 'Informe a data de emissão do RG',
            'dados_pessoais.ssp_rg.required' => 'Informe o SSP do RG',
        ];
    }
}
