<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Saida;
use App\Http\Requests\SaidaRequest;
use App\Repository\SaidaRepository;
use App\Repository\ReciboRepository;

class SaidaController extends Controller
{
    public function buscarSaida(Request $request)
    {
        try {
            $query = Saida::with('hasTipoSaida')->where('deleted_at', null);

            if ($request->status_id) {
                // return 1;
                $query->where('status_id', $request->status_id);
            }

            if ($request->tipo_saida_id) {
                // return 2;
                $query->where('tipo_saida_id', $request->tipo_saida_id);
            }

            if ($request->beneficiario) {
                // return 3;
                $query->where('beneficiario', $request->beneficiario);
            }

            if ($request->dtainicial) {
                // return 4;
                $dtafinal = ($request->dtafinal ? $request->dtafinal : $request->dtainicial);
                $query->whereBetween('data_saida', [$request->dtainicial, $dtafinal]);
            }

            $saidas = $query->orderBy('saida_id', 'desc')->paginate(20);

            return $saidas;
        } catch (\Exception $e) {
            return [
                'status'  => 'error',
                'msg'     => 'Ocorreu um erro! '.$e->getMessage()
            ];
        }
    }

    public function getSaida()
    {
        return view('financeiro.saida.listar_saida');
    }

    public function form($id = "")
    {
        $saida = ($id=="" ? new Saida() : Saida::find($id));

    	return view('financeiro.saida.form_saida', compact('saida'));
    }

	public function salvar(Request $request)
    {
        // dd($request->all());
    	try {
            // $recibo = ReciboRepository::updateOrCreateOne($dadosRecibo);

            // $request['recibo_id'] = $recibo->recibo_id;
            // $request['usuario_criador_id'] = 1;

            $salvar = SaidaRepository::updateOrCreateOne($request->all());

            if ($salvar['status'] == 1) {
                return [
                    'status'  => 'success',
                    'msg'     => 'Saída registrada com sucesso!'
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

    public function excluirSaida(Request $request)
    {
        try {
            $saida = Saida::find($request->saida_id);

            $saida->deleted_at = date('Y-m-d H:i:s');
            $saida->save();

            return [
                'status' => 'success',
                'msg'    => 'Saida excluída com sucesso!'
            ];
        } catch (\Exception $e) {
            return [
                'status'  => 'error',
                'msg'     => 'Erro ao processar!'
            ];
        }
    }

}
