<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AreaAtuacao;
use App\Repository\AreaAtuacaoRepository;

class AreasAtuacaoController extends Controller
{
    public function getIndex()
    {
    	return view('configuracoes.cadastro.areas_atuacao');
    }

    public function getCadastrarAreaAtuacao()
    {
    	return view('configuracoes.cadastro.cadastro_area_atuacao');
    }

    public function getEditarAreaAtuacao($areaAtuacao_id)
    {
    	$areaAtuacaoRepo = new AreaAtuacaoRepository();
    	$areaAruacao = $areaAtuacaoRepo->getAreaAtuacao($areaAtuacao_id);

    	return view('configuracoes.cadastro.editar_area_atuacao', compact('areaAruacao'));
    }

    public function postCadastrarAreaAtuacao(Request $request)
    {

    	$areaAtuacaoRepo = new AreaAtuacaoRepository();
    	
		if($areaAtuacaoRepo->salvar($request)){
	        if ($request['area_atuacao_id']) {
	            $message = 'Atualizado com Sucesso!';
	        } else {
	            $message = 'Salvo com Sucesso!';
	        }

			$status = 'success';
		} else{
	        if ($request['area_atuacao_id']) {
	            $message = 'Erro ao editar. Recarregue a página e tente novamente!';
	        } else {
	            $message = 'Erro ao salvar. Recarregue a página e tente novamente!';
	        }

			$status = 'error';
		}

		return ['status' => $status, 'msg' => $message];
    }

    public function postExcluirAreaAtuacao(Request $request)
    {
		$areaAtuacaoRepo = new AreaAtuacaoRepository();
		if($areaAtuacaoRepo->excluir($request->area_atuacao_id)){
			return ['status' => 'success', 'msg' => 'Excluído com sucesso'];
		}

		return ['status' => 'error', 'msg' => 'Erro ao excluir'];
    }
}
