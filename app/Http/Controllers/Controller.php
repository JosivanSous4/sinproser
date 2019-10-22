<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getRulesEndereco()
    {
        return [
            'estado_id'         =>      'required',
            'cidade_id'         =>      'required',
            'rua'               =>      'required',
            'bairro'            =>      'required',
            'numero_residencia' =>      'required',
            'cep'               =>      'required',
            'zona'              =>      'required',
        ];
    }

    public function getMessagesEndereco()
    {
        return [
            "estado_id.required" => "Selecione o estado",
            "cidade_id.required" => "Selecione a cidade",
            "rua.required"      => "Informe a rua",
            "bairro.required"   => "Informe o bairro",
            "numero_residencia.required" => "Informe o número de residência",
            "cep.required"      => "Informe o CEP",
            "zona.required"     => "Selecione a zona"
        ];
    }

    public function getRulesContatos()
    {
        return [
            'contatos' => 'required'
        ];
    }

    public function getMessagesContatos()
    {
        return [
            'contatos.required' => 'Registre pelo menos um contato.'
        ];
    }
}
