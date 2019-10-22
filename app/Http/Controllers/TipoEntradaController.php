<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoEntrada;
use App\Http\Requests\TipoEntradaRequest;
use App\Repository\TipoEntradaRepository;

class TipoEntradaController extends Controller
{
    public function index()
    {

        return view('financeiro.config.tipo-entrada.listar-tipo-entrada');
    }

    public function form($id = "")
    {
        $tiposEntrada = ($id=="" ? new TipoEntrada() : TipoEntrada::find($id));

    	return view('financeiro.config.tipo-entrada.form-tipo-entrada', compact('tiposEntrada'));
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

	public function salvar(TipoEntradaRequest $request)
    {
        // dd($request->all());
    	try {
            $salvar = TipoEntradaRepository::updateOrCreateOne($request->all());
	    	// $tipoEntrada = ($request['tipo_entrada_id'] ? TipoEntrada::find($request['tipo_entrada_id']) : new TipoEntrada());

	    	// $tipoEntrada->nome = $request['nome'];
	    	// $tipoEntrada->descricao = $request['descricao'];
	    	// $tipoEntrada->save();
            if ($salvar['status'] == 1) {
                return [
                    'status'  => 'success',
                    'msg'     => 'Tipo de entrada salvo com sucesso!'
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
