<?php

namespace App\Http\Controllers\Site;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\InformacoesSindicatoRepository;
use App\Http\Requests\InformacoesSindicatoFormRequest;

class InformacoesSindicatoController extends Controller
{
    public function cadastrarEditarInformacoesGet()
    {
        $informacoesSindicatoRepository = new InformacoesSindicatoRepository();

        $dados = $informacoesSindicatoRepository->getInformacoesSindicato();

        if ($dados) {
            return view('configuracoes.site.informacoes-sindicato.form-informacoes-sindicato', compact('dados'));
        } else {
            return view('configuracoes.site.informacoes-sindicato.form-informacoes-sindicato');
        }
    }

    public function cadastrarEditarInformacoesPost(Request $request)
    {
        $informacoesSindicatoRepository = new InformacoesSindicatoRepository();

        $errors = $this->validarDados($request);

        if($errors){
            return response()->json($errors, 422);
        }

        return $informacoesSindicatoRepository->updateOrCreate($request);
    }

    private function validarDados($request)
    {
        $rules = [
            'nome'      => 'required',
            'descricao' => 'required',
        ];

        $rules += $this->getRulesEndereco();
        $rules += $this->getRulesContatos();

        $messages = [
            'nome.required'      => 'Digite o nome do sindicato!',
            'descricao.required' => 'Digite uma descrição sobre o sindicato!',
        ];

        $messages += $this->getMessagesEndereco();
        $messages += $this->getMessagesContatos();


        $dados = $request->except(['tipo_contato', "complemento", "cep", ]);
        $endereco  = (array) json_decode($request->endereco);
        $contatos  = (array) json_decode($request->contatos);

        $dados = [
            "nome"      => $request->nome,
            "foto"      => $request->foto,
            "descricao" => $request->descricao,

            'estado_id'         => $endereco['estado_id'],
            'cidade_id'         => $endereco['cidade_id'],
            'rua'               => $endereco['rua'],
            'bairro'            => $endereco['bairro'],
            'numero_residencia' => $endereco['numero_residencia'],
            'cep'               => $endereco['cep'],
            'zona'              => $endereco['zona'],

            "contatos"  => (array) json_decode($request->contatos)
        ];

        $validatedData = Validator::make($dados, $rules, $messages);

        if($validatedData->fails()){
            return [
                'errors' => $validatedData->errors(),
                'message' => 'erros no formulário'
            ];
        }

        return null;
    }
}
