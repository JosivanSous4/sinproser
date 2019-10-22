<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LocalTrabalhoFormRequest;
use App\Repository\LocalTrabalhoRepository;
use \Exception;

class LocalTrabalhoController extends Controller
{

    public function getLocaisDeTrabalho() 
    {

        $localTrabalhoRepo = new LocalTrabalhoRepository();

        $locaisDeTrabalho = $localTrabalhoRepo->getLocaisDeTrabalho();

    	return view('configuracoes.cadastro.locais_de_trabalho', compact('locaisDeTrabalho'));
    }

    public function getCadastroDeLocalDeTrabalho()
    {
    	return view('configuracoes.cadastro.cadastro_de_local_de_trabalho');
    }

    public function getEditarLocalDeTrabalho($local_de_trabalho_id)
    {
        $localTrabalhoRepo = new LocalTrabalhoRepository();
        $localDeTrabalho = $localTrabalhoRepo->getLocalDeTrabalho($local_de_trabalho_id);

        return view('configuracoes.cadastro.editar_local_de_trabalho', compact('localDeTrabalho'));
    }

    public function postCadastroDeLocalDeTrabalho(LocalTrabalhoFormRequest $request)
    {
        // dd($request->all());
        $repLocalTrabalho = new LocalTrabalhoRepository();
    	try {
    		$repLocalTrabalho->updateOrCreateOne($request);

            if(!empty($request->local_de_trabalho_id)){
			    return ['status' => 'success', 'msg' => 'Sucesso ao editar local de trabalho'];
            }

            return ['status' => 'success', 'msg' => 'Sucesso ao salvar local de trabalho'];

    	} catch (Exception $ex) {
    		return ['status' => 'error', 'msg' => "Erro ao salvar local de trabalho $ex"];
    	}
    }

    public function getExcluirLocalDeTrabalho(Request $request)
    {
        $localTrabalhoRepo = new LocalTrabalhoRepository();
        $localTrabalhoRepo->excluirLocalDeTrabalho($request->local_de_trabalho_id);

        return ['status' => 'success', 'msg' => 'Sucesso ao excluir local de trabalho'];
    }
}
