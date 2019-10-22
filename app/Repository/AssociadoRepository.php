<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;
use App\Models\Associado;
use App\Models\Formacao;
use App\Models\DadosPessoais;
use App\Models\DadosFuncionais;
use App\Models\Endereco;
use App\Models\Status;
use App\Repository\LocalTrabalhoRepository;
use App\Models\AssociadoHasLocalTrabalho;
use App\Models\Log;
use \Auth;

class AssociadoRepository extends GenericRepository
{
	static public function updateOrCreateOne($request)
    {
        try {
            DB::transaction(function () use ($request){

		        $dadosEndereco = json_decode($request->endereco);
		        $dadosDadosPessoais = json_decode($request->dados_pessoais);
		        $dadosContatos = json_decode($request->contatos);
		        $dadosFormacoes = json_decode($request->formacoes);
		        $dadosDadosFuncionais = json_decode($request->dados_funcionais);
		        $dadosLocaisTrabalho = json_decode($request->locais_de_trabalho);

                $dadosDadosPessoais->cpf = str_replace(['.', '-'], '', $dadosDadosPessoais->cpf);
                
		    	$dadosPessoais = DadosPessoais::updateOrCreate(['dados_pessoais_id' => $dadosDadosPessoais->dados_pessoais_id], (array)$dadosDadosPessoais);
		    	$dadosFuncionais = DadosFuncionais::updateOrCreate(['dado_funcional_id' => $dadosDadosFuncionais->dado_funcional_id], (array)$dadosDadosFuncionais);
		    	$endereco = Endereco::updateOrCreate(['endereco_id' => $dadosEndereco->endereco_id], (array)$dadosEndereco);

		    	$associado = [
		    		'data_associacao' => $request->data_associacao,
                    'bol_presidente' => false,
		    		'bool_professor' => $request->bool_professor,
		    		'bol_inadimplente' => false,
		    		'grau_instrucao_id' => $request->grau_instrucao_id,
                    'salario' => str_replace(['.',','], ['', '.'], $request->salario),
		    		'dados_funcionais_id' => $dadosFuncionais->dado_funcional_id,
		    		'tipo_pagamento_id' => $request->tipo_pagamento_id,
		    		'endereco_id'  => $endereco->endereco_id,
		    		'area_atuacao_id'  => $request->area_atuacao_id,
		    		'dados_pessoais_id'  => $dadosPessoais->dados_pessoais_id,
		    		'status_id'  => Status::ATIVO,
		    		'usuario_criador_id' => Auth::user()->user_id,
		    	];

                if(!is_null($request->file('foto'))){
                    $associado['foto'] = self::upload($request->file('foto'));
                }

		    	$associado = Associado::updateOrCreate(['associado_id' => $request->associado_id], $associado);

		    	self::salvarVariosContatos($associado, $dadosContatos);
		    	self::salvarVariasFormacoes($associado, $dadosFormacoes);
	            self::salvarVariosLocaisTrabalhoParaAssociado($associado, $dadosLocaisTrabalho);

                $dados = json_encode($request->all());

                if($request->associado_id){
                    Log::sucesso('associados', 'Jesonilton alterou dados de <b>' . $dadosPessoais->nome . '-' . $dadosPessoais->cpf. '</b>', $dados, 1);
                } else {
                    Log::sucesso('associados', 'Jesonilton registrou <b>' . $dadosPessoais->nome . '-' . $dadosPessoais->cpf. '</b> como associado', $dados, 1);
                }

            });

            if($request->associado_id){
            	return [
	            	'status' 	=> 'success',
	            	'msg'		=> 'Editado com sucesso!'
	            ];
            } else {
            	return [
	            	'status' 	=> 'success',
	            	'msg'		=> 'Salvo com sucesso!'
	            ];
            }

        }  catch (\Exception $ex) {
            if($request->associado_id){
            	return [
	            	'status' 	=> 'error',
	            	'msg'		=> 'Houve um erro ao editar associado! : '.$ex
	            ];
            } else {
            	return [
	            	'status' 	=> 'error',
	            	'msg'		=> 'Houve um erro ao salvar associado : '.$ex
	            ];
            }
        }
    }

    public function getQueryAssociado()
    {
    	return Associado::with(['hasEndereco' => function($query){ return $query->with(['hasCidade' => function($query){ return $query->with('hasEstado'); }]); }, 'hasContatos', 'hasFormacoes' => function($query){ return $query->with('hasTipoFormacao'); }, 'hasGrauInstrucao', 'hasDadosFuncionais', 'hasTipoPagamento', 'hasAreaAtuacao', 'hasDadosPessoais', 'hasCarteirinha', 'hasStatus', 'hasUsuarioCriador', 'hasLocalTrabalho' => function($query){ return $query->with('hasEndereco', 'hasContatos'); }]);
    }

    public function getAssociadosComCarteirinha()
    {
        $associados = Associado::with(['hasDadosPessoais', 'hasCarteirinha'])->whereHas('hasCarteirinha', function($query){return $query->where('carteirinha_id', '>', 0);})->get();
        return $this->extrairDados($associados);
    }

    public function getAssociadosSemCarteirinha()
    {
        $associados = Associado::with(['hasDadosPessoais', 'hasCarteirinha'])->whereNull('carteirinha_id')->get();
        return $this->extrairDados($associados);
    }

    private function extrairDados($associados)
    {
        $associados = $associados->map(function($associado){
            return (object)[
                'associado_id' => $associado->associado_id,
                'nome' => $associado->hasDadosPessoais->nome,
                'data_associacao' => $associado->data_associacao,
                'carteinha_id' => $associado->carteirinha_id,
                'bol_carteinha_impressa' => $associado->hasCarteirinha? $associado->hasCarteirinha->bol_impresso : false
            ];
        });

        return (object)$associados;
    }

    public function restaurarAssociado($associado_id)
    {
        try {
            $associado = Associado::onlyTrashed()->find($associado_id);
            $associado->restore();

            return [
                'status'    => 'success',
                'msg'       => 'Associado restaurado com sucesso!'
            ];
        } catch (\Exception $e) {
            return [
                'status'    => 'error',
                'msg'       => 'Falha ao restaurar associado!'
            ];          
        }
    }

    private static function salvarVariosLocaisTrabalhoParaAssociado($associado, $locaisTrabalho)
    {
        $idsLocaisTrabalho = [];
        foreach ($locaisTrabalho as $key => $localTrabalho) {
            $idsLocaisTrabalho[] = $localTrabalho->associado_local_de_trabalho_id? $localTrabalho->associado_local_de_trabalho_id: '';
        }

        $idsLocaisTrabalho = array_filter($idsLocaisTrabalho);
        $locaisTrabalhoR = [];
        if(count($idsLocaisTrabalho)){
            $locaisTrabalhoR = AssociadoHasLocalTrabalho::where('associado_id', $associado->associado_id)->whereNotIn('associado_local_de_trabalho_id', $idsLocaisTrabalho)->get();
        } else {
        	$locaisTrabalhoR = AssociadoHasLocalTrabalho::where('associado_id', $associado->associado_id)->get();
        }

        if(count($locaisTrabalhoR)){
            foreach ($locaisTrabalhoR as $key => $localTrabalho) {
               $localTrabalho->delete();
            }
        }

        foreach ($locaisTrabalho as $key => $localTrabalho) {
            $localTrabalho = (array)$localTrabalho;
            $localTrabalho['associado_id'] = $associado->associado_id;
            $localTrabalho['data_vinculacao'] = date('Y-m-d', strtotime($localTrabalho['data_vinculacao']));

            unset($localTrabalho['strLocalTrabalho']);

            AssociadoHasLocalTrabalho::updateOrCreate(['associado_local_de_trabalho_id' => $localTrabalho['associado_local_de_trabalho_id']], $localTrabalho);
        }
    }

    private static function salvarVariasFormacoes($associado, $formacoes)
    {
        $idsFormacoes = [];
        foreach ($formacoes as $key => $formacao) {
            $idsFormacoes[] = $formacao->formacao_id? $formacao->formacao_id: '';
        }

        $idsFormacoes = array_filter($idsFormacoes);
        $formacoesR = [];
        if(count($idsFormacoes)){
            $formacoesR = $associado->hasFormacoes()->whereNotIn('formacao_id', $idsFormacoes)->get();
        } else {
            $formacoesR = $associado->hasFormacoes()->get();
        }

        if(count($formacoesR)){
            foreach ($formacoesR as $key => $formacao) {
               $formacao->delete();
            }
        }

        foreach ($formacoes as $key => $formacao) {
            $formacao = (array)$formacao;
            $formacao['associado_id'] = $associado->associado_id;
            Formacao::updateOrCreate(['formacao_id' => $formacao['formacao_id']], $formacao);
        };
    }

    public function excluirAssociado($associado_id)
    {
        DB::transaction(function () use ($associado_id){
            $associado = Associado::find($associado_id);

            if($associado) {
                $associado->status_id = Status::INATIVO;
                $associado->save();

                $associado->delete();
            }
        });

        return [
            'status'    => 'success',
            'msg'       => 'Associado desativado com sucesso!'
        ];
    }

    public function existeAssociado($associado_id)
    {
        if(Associado::find($associado_id)){
            return true;
        }

        return false;
    }

    public function getTotalDeAssociados()
    {
        return Associado::count();
    }

    public function getTotalDeAssociadosProfessores()
    {
        return Associado::where('bool_professor', true)->count();
    }

    public function getTotalDeAssociadosNaoProfessores()
    {
        return Associado::where('bool_professor', false)->count();
    }

    public function getAniversariantes($mes)
    {
        return \DB::table('dados_pessoais')
                ->join('associados', 'dados_pessoais.dados_pessoais_id', '=', 'associados.dados_pessoais_id')
                ->selectRaw("associados.associado_id, associados.foto, nome, DATE_FORMAT(data_nascimento, '%d/%m') as data_aniversario")
                ->orderBy(\DB::raw(' EXTRACT(MONTH FROM data_nascimento), EXTRACT(DAY FROM data_nascimento)'))
                ->whereMonth('data_nascimento', $mes)
                ->get();
    }

    public function getAssociado($associado_id)
    {

        $associado = Associado::with(['hasContatos','hasDadosPessoais'])
                        ->where('associado_id', $associado_id)
                        ->first();

        $endereco = $associado->hasEndereco()->first();
        $cidade = $endereco->hasCidade()->with('hasEstado')->first();

        $endereco['cidade_id'] =  $cidade->cidade_id;
        $endereco['estado_id'] =  $cidade->estado_id;

        $associado['has_endereco'] = $endereco;
        return $associado;
    }
}
