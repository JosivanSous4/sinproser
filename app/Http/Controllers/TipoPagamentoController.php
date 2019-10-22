<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\TipoPagamentoRepository;

class TipoPagamentoController extends Controller
{

	public function getIndex()
	{
		$tipoPagamentoRepo = new TipoPagamentoRepository();
		$tiposDePagamento = $tipoPagamentoRepo->getTiposDePagamento();

		return view('configuracoes.cadastro.tipos_de_pagamento', compact('tiposDePagamento'));
	}

	public function getCadastrarTipoPagamento()
	{
		return view('configuracoes.cadastro.cadastro_tipos_de_pagamento');
	}

	public function postCadastrarTipoPagamento(Request $request)
	{
		$tipoPagamentoRepo = new TipoPagamentoRepository();

		if($tipoPagamentoRepo->salvar($request)){
	        if ($request['tipo_pagamento_id']) {
	            $message = 'Atualizado com Sucesso!';
	        } else {
	            $message = 'Salvo com Sucesso!';
	        }

			$status = 'success';
		} else{
	        if ($request['tipo_pagamento_id']) {
	            $message = 'Erro ao editar. Recarregue a página e tente novamente!';
	        } else {
	            $message = 'Erro ao salvar. Recarregue a página e tente novamente!';
	        }

			$status = 'error';
		}

		return ['status' => $status, 'msg' => $message];
	}

	public function getEditarTipoPagamento($tipoPagamento_id)
	{
		$tipoPagamentoRepo = new TipoPagamentoRepository();
		$tipoDePagamento = $tipoPagamentoRepo->getTipoDePagamento($tipoPagamento_id);

		return view('configuracoes.cadastro.editar_tipos_de_pagamento', compact('tipoDePagamento'));
	}

	public function postExcluirTipoPagamento(Request $request)
	{
		$tipoPagamentoRepo = new TipoPagamentoRepository();
		if($tipoPagamentoRepo->excluir($request->tipo_pagamento_id)){
			return ['status' => 'success', 'msg' => 'Excluído com sucesso'];
		}

		return ['status' => 'error', 'msg' => 'Erro ao excluir'];
	}
}
