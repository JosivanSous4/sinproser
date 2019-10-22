<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoFormacao;
use App\Repository\TipoFormacaoRepository;

class TipoFormacaoController extends Controller
{

	public function getIndex()
	{
		$tipoFormacaoRepo = new TipoFormacaoRepository();
		$tiposDeFormacoes = $tipoFormacaoRepo->getTiposDeFormacoes();

		return view('configuracoes.cadastro.tipos_de_formacao', compact('tiposDeFormacoes'));
	}

	public function getCadastrarTipoFormacao()
	{
		return view('configuracoes.cadastro.cadastro_tipos_de_formacao');
	}

	public function postCadastrarTipoFormacao(Request $request)
	{

		$tipoFormacaoRepo = new TipoFormacaoRepository();

		if($tipoFormacaoRepo->salvar($request)){
	        if ($request['tipo_formacao_id']) {
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

	public function getEditarTipoFormacao($tipoFormacao_id)
	{
		$tipoFormacaoRepo = new TipoFormacaoRepository();
		$tipoFormacao = $tipoFormacaoRepo->getTipoDeFormacao($tipoFormacao_id);

		return view('configuracoes.cadastro.editar_tipo_de_formacao', compact('tipoFormacao'));
	}

	public function postExcluirTipoFormacao(Request $request)
	{
		$tipoFormacaoRepo = new TipoFormacaoRepository();
		if($tipoFormacaoRepo->excluir($request->tipo_pagamento_id)){
			return ['status' => 'success', 'msg' => 'Excluído com sucesso'];
		}

		return ['status' => 'error', 'msg' => 'Erro ao excluir'];
	}
}
