<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Site\Parceiro;
use Illuminate\Http\Request;
use App\Repository\Site\ParceiroRepository;
use Validator;

class ParceiroController extends Controller
{
    public function index()
    {
        return view('site.parceiro.listar-parceiros');
    }

    public function getFormParceiro($parceiro_id="")
    {
        $parceiro = null;
        if ($parceiro_id != "") {
            $parceiro = Parceiro::with('hasEndereco.hasCidade', 'hasContatos')->find($parceiro_id);
        }

        return view('configuracoes.site.parceiro.form-parceiros', compact('parceiro'));
    }

    public function postSalvarParceiro(Request $request)
    {
        try {
            $errors = $this->validarDados($request);
            if($errors){
                return response()->json($errors, 422);
            }

            $parceiroRepository = new ParceiroRepository();

            $salvar = $parceiroRepository->createOrUpdate($request);

            if ($salvar['status'] == 1) {
                return [
                    'status'  => 'success',
                    'msg'     => $salvar['msg']
                ];
            } else {
                return [
                    'status'  => 'error',
                    'msg'     => 'Erro ao processar! ' . $salvar['msg']
                ];
            }
        } catch (\Exception $e) {
            return [
                'status'  => 'error',
                'msg'     => 'Erro ao processar! ' . $e->getMessage()
            ];
        }
    }

    public function validarDados($request)
    {

        $rules = [
            'nome' => 'required'
        ];
        $rules += $this->getRulesEndereco();
        $rules += $this->getRulesContatos();

        $messages = [
            'nome.required'    => 'Digite o nome do parceiro',
        ];

        $messages += $this->getMessagesEndereco();
        $messages += $this->getMessagesContatos();

        $dados = $request->except('endereco');
        $dados += (array)json_decode($request->endereco);
        $dados += (array)json_decode($request->contatos);

        $validatedData = Validator::make($dados, $rules, $messages);
        if($validatedData->fails()){
            return [
                'errors' => $validatedData->errors(),
                'message' => 'erros no formulário'
            ];
        }

        return null;
    }

    public function postExcluirParceiro(Request $request)
    {
        try {
            $parceiro = Parceiro::find($request->parceiro_id);
            $parceiro->deleted_at = date('Y-m-d H:i:s');
            $parceiro->save();

            return [
                'status' => 'success',
                'msg'    => 'Parceiro excluída com sucesso!'
            ];
        } catch (\Exception $e) {
            return [
                'status'  => 'error',
                'msg'     => 'Erro ao processar! ' . $e->getMessage()
            ];
        }
    }

}
