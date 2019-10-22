<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoSaida;
use App\Http\Requests\TipoSaidaRequest;
use App\Repository\TipoSaidaRepository;

class TipoSaidaController extends Controller
{
    public function index()
    {
        return view('financeiro.config.tipo-saida.listar-tipo-saida');
    }

    public function form($id = "")
    {
        $tiposSaida = ($id=="" ? new TipoSaida() : TipoSaida::find($id));

    	return view('financeiro.config.tipo-saida.form-tipo-saida', compact('tiposSaida'));
    }

    public function apiLista()
    {
        try {
            $tiposEntrada = TipoEntrada::orderBy('nome')->get();

            return response()->json($tiposEntrada,200);;
        } catch (\Exception $e) {
            return response()->json(
                [
                    'status'  => 'error',
                    'msg'     => 'Erro ao processar! ' . $e->getMessage()
                ], 200);
        }
    }

	public function salvar(TipoSaidaRequest $request)
    {
        // dd($request->all());
    	try {
            $salvar = TipoSaidaRepository::updateOrCreateOne($request->all());
            // dd($salvar);
	    	// $tipoEntrada = ($request['tipo_saida_id'] ? TipoEntrada::find($request['tipo_saida_id']) : new TipoEntrada());

	    	// $tipoEntrada->nome = $request['nome'];
	    	// $tipoEntrada->descricao = $request['descricao'];
	    	// $tipoEntrada->save();
            if ($salvar['status'] == 1) {
                return [
                    'status'  => 'success',
                    'msg'     => 'Tipo de saida salvo com sucesso!'
                ];
            }else{
                return [
                    'status'  => 'error',
                    'msg'     => 'Erro ao processar! '.$salvar['msg']
                ];
            }
       	} catch (\Exception $e) {
    		return [
    			'status'  => 'error',
				'msg'     => 'Erro ao processar! ' . $e->getMessage()
    		];
    	}
    }
}
