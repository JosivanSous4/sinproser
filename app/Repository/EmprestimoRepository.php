<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;
use App\Models\EmprestimoBens;
use App\Models\EmprestimoHasBens;
use App\Models\Endereco;
use App\Models\Status;
use App\Models\Bem;
use App\Models\ResponsavelEmprestimo;

class EmprestimoRepository extends GenericRepository
{

    public function endereco()
    {
        return new Endereco();
    }

	public function getTiposDePagamento()
	{
		return TipoPagamento::all();
	}

	public function getTipoDePagamento($tipoPagamento_id)
	{
		return TipoPagamento::find($tipoPagamento_id);
	}

	public function registrarEmprestimo($request)
	{

        try {
            DB::transaction(function () use ($request){
            	$cpf = str_replace(['.', '-'], '', $request->dados_responsavel['cpf_responsavel']);
            	$responsavel = ResponsavelEmprestimo::where('cpf_responsavel', $cpf)->first();

            	if(!$responsavel){
	            	$endereco = $request->dados_responsavel['endereco'];
	                $endereco = $this->endereco()->updateOrCreate(['enderecos.endereco_id' => $endereco['endereco_id']], $endereco);

	                $responsavel = $request->dados_responsavel;
	                $responsavel['endereco_id'] = $endereco->endereco_id;
	                $responsavel['cpf_responsavel'] = $cpf;

	                $responsavel = ResponsavelEmprestimo::create($responsavel);
                }

                $emprestimo = [
                	'data_prevista_devolucao' => $request->data_prevista_devolucao,
                	'responsavel_id' => $responsavel->responsavel_id
                ];

                $emprestimo = EmprestimoBens::updateOrCreate(['emprestimo_bem_id' => $request['emprestimo_bem_id']], $emprestimo);
				$emprestimo->hasBens()->sync($request->bens_selecionados);

				Bem::whereIn('bem_id', $request->bens_selecionados)->update(['status_id'=> Status::INDISPONIVEL]);

                self::salvarVariosContatos($responsavel, $request->dados_responsavel['contatos']);
            });

			return true;
        }  catch (\Exception $ex) {
        	dd($ex->getMessage());
            return false;
        }
	}

	public function excluir($tipo_pagamento_id)
	{
        try {
            DB::transaction(function () use ($tipo_pagamento_id){
                $tipoPagamento = TipoPagamento::find($tipo_pagamento_id);
                $tipoPagamento->delete();
            });

			return true;
        }  catch (\Exception $ex) {
            return false;
        }
	}

	public function getResponsavel($responsavel_id)
	{

        $responsavel = ResponsavelEmprestimo::where('responsavel_id', $responsavel_id)->first();

        $endereco = $responsavel->hasEndereco()->first();
        $cidade = $endereco->hasCidade()->with('hasEstado')->first();

        $endereco['estado_id'] =  $cidade->estado_id;
        $endereco['cidade_id'] =  $cidade->cidade_id;

        $responsavel['has_endereco'] = $endereco;
        // dd($responsavel);
		return $responsavel;
	}

	public function getListaResponsaveis()
	{
		return ResponsavelEmprestimo::with(['hasEndereco' => function($query){
										return $query->with(['hasCidade' => function($query){
											return $query->with('hasEstado');
										}]);
									}])
									->get();
	}

	public function getEmprestimos()
	{
		$emprestimos = EmprestimoBens::with(['hasBens', 'hasResponsavel'])
								// ->whereNull('bol_devolvido')
								->get();
		$emprestimos = (Object)$emprestimos->map(function($emprestimo){

								$produto = $emprestimo->hasBens[0]->hasProduto()->first();

                                $data_devolucao = ($emprestimo->data_devolucao ? date('d/m/Y', strtotime($emprestimo->data_devolucao)):'');
                                $data_prevista_devolucao = ($emprestimo->data_prevista_devolucao ? date('d/m/Y', strtotime($emprestimo->data_prevista_devolucao)):'');

                                $dados = [
									'responsavel' => $emprestimo->hasResponsavel->toArray(),
									'produto' => $produto->toArray(),
                                    'qtdBens' => count($emprestimo->hasBens),
									'qtdBensDevolvidos' => $emprestimo->hasBens()->wherePivot('bol_devolvido', 1)->count(),
									'dataDevolucao' => $data_devolucao,
                                    'data_prevista_devolucao' => $data_prevista_devolucao,
									'dataEmprestimo' => date('d/m/Y', strtotime($emprestimo->created_at)),
                                    'emprestimo_bem_id' => $emprestimo->emprestimo_bem_id,
                                    'bol_devolvido' => $emprestimo->bol_devolvido
								];

								return $dados;
							});

                                
		return $emprestimos;
	}

    public function getEmprestimo($emprestimo_bem_id)
    {
        $emprestimo = EmprestimoBens::with(['hasBens' => function($query){
                            return $query->with('hasProduto');
                        }, 'hasResponsavel.hasEndereco.hasCidade.hasEstado', 'hasResponsavel.hasContatos'])
                        ->find($emprestimo_bem_id);
        ////////////////////////////////////////////////////////////
        $emprestimo = [
            'responsavel' => $emprestimo->hasResponsavel->toArray(),
            'bens' => $emprestimo->hasBens->toArray(),
            'qtdBens' => count($emprestimo->hasBens),
            'dataDevolucao' => date('d/m/Y', strtotime($emprestimo->data_devolucao)),
            'dataEmprestimo' => date('d/m/Y', strtotime($emprestimo->created_at)),
            'emprestimo_bem_id' => $emprestimo->emprestimo_bem_id
        ];

        // dd($emprestimo)
        return (Object) $emprestimo;
    }

    public function postDevolucao($request)
    {
        try {
            $data_devolucao     = $request->data_devolucao;
            $bens_selecionados               = $request->bens_selecionados;
            $emprestimo_bem_id  = $request->emprestimo_bem_id;

            $emprestimo = EmprestimoBens::find($emprestimo_bem_id);
            $bens = $emprestimo->hasBens()->get();

            foreach ($bens as $bem) {
                if (in_array($bem->bem_id, $bens_selecionados)) {

                    $pivot = $bem->pivot;

                    $pivot->bol_devolvido = 1;
                    $pivot->data_devolucao = $data_devolucao;

                    $pivot->save();

                    $bem->status_id = Status::DISPONIVEL;
                    $bem->save();
                }
            }

            $emprestimoCheck = EmprestimoBens::with(['hasBens' => function($query){
                        $query->whereNull('bol_devolvido');
                    }])->find($emprestimo_bem_id);

            if (count($emprestimoCheck->hasBens) == 0) {
                $emprestimoCheck->bol_devolvido = 1;
                $emprestimoCheck->data_devolucao = $data_devolucao;
                $emprestimoCheck->save();
            }

            return ['status' => 'success', 'msg' => "Devolução registrada com sucesso!"];
        } catch (\Exception $e) {
            return ['status' => 'error', 'msg' => 'Erro ao salvar' . ' ' . $ex];
        }

    }
}
