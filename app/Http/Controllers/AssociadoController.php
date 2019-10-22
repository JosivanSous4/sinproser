<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repository\AssociadoRepository;
use App\Http\Requests\AssociadoFormRequest;
use App\Models\Status;
use App\Models\Saida;
use App\Models\Entrada;
use Validator;

class AssociadoController extends Controller
{
    use \App\Models\Traits\HtmlToPdfTrait;

    private $repoAssociado;

    public function __construct(AssociadoRepository $associadoRepository)
    {
        $this->repoAssociado = $associadoRepository;
    }

    public function getListaDeAssociados($status = 'ativos')
    {
        $query = $this->repoAssociado->getQueryAssociado();
        
        if($status == 'inativos'){
            $associados = $query->onlyTrashed()->get();
        } else {
            $associados = $query->get();
        }
        $associados = $associados->map(function($associado){
            $data_associacao = date_create($associado->data_associacao);

            return (object)[
                'associado_id'  => $associado->associado_id,
                'nome' => $associado->hasDadosPessoais->nome,
                'nome_para_url' => $associado->hasDadosPessoais->getNomeParaUrl(),
                'area_atuacao' => $associado->hasAreaAtuacao->nome,
                'data_associacao' => date_format($data_associacao, 'd/m/Y')
            ];
        });

        return view('associado.lista_de_associados', compact('associados', 'status'));
    }

    public function getCadastroDeAssociado()
    {
        return view('associado.cadastro_de_associado');
    }

    public function postCadastroDeAssociado(Request $request)
    {
        
        $errors = $this->validarDados($request);

        if($errors){
            return response()->json($errors, 422);
        }

        return $this->repoAssociado->updateOrCreateOne($request);
    }

    public function getEditarAssociado($associado_id)
    {
        $associado = $this->repoAssociado->getQueryAssociado()->find($associado_id);
        foreach ($associado->hasLocalTrabalho as $key => $localTrabalho) {
            $strLocalTrabalho = $localTrabalho->getStrLocalTrabalho();
            $localTrabalho['strLocalTrabalho'] =  $strLocalTrabalho;
        }

        return view('associado.editar_associado', compact('associado'));
    }

    public function postEditarAssociado(Request $request)
    {
        $errors = $this->validarDados($request);
        if($errors){
            return response()->json($errors, 422);
        }

        return $this->repoAssociado->updateOrCreateOne($request);
    }

    public function postExcluirAssociado(Request $request)
    {
        return $this->repoAssociado->excluirAssociado($request->associado_id);
    }

    public function getPerfilAssociado($associado_id, $nome)
    {
        $associado = $this->repoAssociado->getQueryAssociado()
                                        ->with('hasEntradas')
                                        ->where('associado_id', $associado_id)
                                        ->whereHas('hasDadosPessoais', function($query) use($nome){
                                            $nome = str_replace("-", " ", $nome);
                                            return $query->where('nome', $nome);
                                        })->first();


        if(!is_null($associado)){
            if($associado->foto){
                $associado->foto = asset('/storage/uploads') .'/'. $associado->foto;
            }

            if($associado->hasLocalTrabalho){
                $associado->locais_de_trabalho = $associado->hasLocalTrabalho->map(function($localTrabalho){

                    $endereco = $localTrabalho->hasEndereco;
                    $strLocalTrabalho = $localTrabalho->getStrLocalTrabalho();
                    return (object)[
                        'local_de_trabalho_id' => $localTrabalho->local_de_trabalho_id,
                        'matricula'            => $localTrabalho->pivot->matricula,
                        'funcao'               => $localTrabalho->pivot->funcao,
                        'data_vinculacao'      => $localTrabalho->pivot->data_vinculacao,
                        'str_local_trabalho'     => $strLocalTrabalho
                    ];
                });
            }

            $idsEntradas = $associado->hasEntradas->map(function($entrada){
                return $entrada->entrada_id;
            });

            $totalContribuicoes = Entrada::whereIn('entrada_id', $idsEntradas)->where('status_id', Status::PAGO)->select(DB::raw('SUM(valor) as total'))->first();
            $mesesEmAberto = Entrada::whereIn('entrada_id', $idsEntradas)->where('status_id', Status::ABERTO)->get();
            $divida['meses'] = $mesesEmAberto->map(function($divida){
                return date('m/Y',strtotime($divida->competencia));
            });
            $divida['valor_total'] = number_format($mesesEmAberto->sum('valor'), 2, ',', '.');


            $associado['totalContribuicoes'] = number_format($totalContribuicoes->total, 2, ',', '.');
            $associado['saldoDevedor'] = $divida;

            return view('associado.perfil-associado', compact('associado', 'totalContribuicoes'));
        }

        return redirect('/associados/lista-de-associados')->withErrors(['error' => 'Associado não encontrado']);
    }

    public function getAssociado($associado_id)
    {
        $associado = json_encode($this->repoAssociado->getAssociado($associado_id));
        return $associado;
    }

    public function postRestaurarAssociado(Request $request)
    {
        if($request->associado_id){        
            return $this->repoAssociado->restaurarAssociado($request->associado_id);
        }
    }

    private function validarDados($request)
    {
        $rules = [
            'grau_instrucao_id' => 'required',
            'tipo_pagamento_id' => 'required',
            'area_atuacao_id'   => 'required',
            'salario'           => 'required'
        ];

        $rules += $this->getRulesEndereco();
        $rules += $this->getRulesDadosFuncionais();
        $rules += $this->getRulesDadosPessoais();
        $rules += $this->getRulesContatos();
        $rules += $this->getRulesLocaisDeTrabalho();

        $messages = [
            'grau_instrucao_id.required'    => 'Selecione o grau de instrução',
            'tipo_pagamento_id.required'    => 'Selecione o tipo de pagamento',
            'area_atuacao_id.required'      => 'Selecione a área de atuação',
            'salario.required'              => 'Informe o salário'
        ];

        $messages += $this->getMessagesEndereco();
        $messages += $this->getMessagesDadosFuncionais();
        $messages += $this->getMessagesDadosPessoais();
        $messages += $this->getMessagesContatos();
        $messages += $this->getMessagesLocaisDeTrabalho();

        $dados = $request->except('dados_pessoais','endereco','dados_funcionais');
        $dados += (array)json_decode($request->endereco);
        $dados += (array)json_decode($request->dados_funcionais);
        $dados += (array)json_decode($request->dados_pessoais);
        $dados += (array)json_decode($request->contatos);
        $dados += (array)json_decode($request->locais_de_trabalho);

        if(intval($dados['salario']) <= 0){
            $dados['salario'] = null;
        }

        $validatedData = Validator::make($dados, $rules, $messages);
        if($validatedData->fails()){
            return [
                'errors' => $validatedData->errors(),
                'message' => 'erros no formulário'
            ];
        }

        return null;
    }

    private function getRulesDadosFuncionais()
    {
        return [
            "pis_pasep" => "required",
            "portaria" => "required",
            "data_admissao" => "required"
        ];
    }

    private function getMessagesDadosFuncionais()
    {
        return [
          "pis_pasep.required" => "Informe o PIS/PASEP",
          "portaria.required" => "Informe a portaria",
          "data_admissao.required" => "Informe a data de admissao"
        ];
    }

    private function getRulesDadosPessoais()
    {
        return [
            "nome"              => "required",
            "sexo"              => "required",
            "estado_civil"      => "required",
            "cpf"               => "required",
            "data_nascimento"   => "required",
            "rg"                => "required",
            "data_emissao_rg"   => "required",
            "orgao_emissor_rg"  => "required",
        ];
    }

    private function getMessagesDadosPessoais()
    {
        return [
            'nome.required' => 'Preencha o nome',
            'sexo.required'=> 'Selecione o sexo',
            'estado_civil.required' => 'Selecione o estado civil',
            'cpf.required' => 'Informe o cpf',
            'data_nascimento.required' => 'Informe a data de nascimento',
            'rg.required' => 'Informe o RG',
            'data_emissao_rg.required' => 'Informe a data de emissão do RG',
            'orgao_emissor_rg.required' => 'Informe o órgão emissor do RG',
        ];
    }

    private function getRulesLocaisDeTrabalho()
    {
        return [
            'locais_de_trabalho' => 'required'
        ];
    }

    private function getMessagesLocaisDeTrabalho()
    {
        return [
            'locais_de_trabalho.required' => 'Registre pelo menos um local de trabalho.'
        ];
    }
}
