<?php

namespace App\Http\Controllers\Relatorio;

use Illuminate\Http\Request;
use App\Models\Entrada;
use App\Models\Saida;
use App\Models\Status;
use App\Models\AssociadoHasEntrada;
use App\Http\Requests\EntradaFormRequest;
use App\Repository\EntradaRepository;
use App\Http\Controllers\Controller;

class FinanceiroController extends Controller
{
    public function formEntrada()
    {
    	return view('relatorio.financeiro.entrada.form_entrada');
    }

    public function buscarEntrada(Request $request)
    {
        // dd($request->all());
        try {
            $query = Entrada::with('hasTipoEntrada', 'hasAssociadosEntradas.hasAssociados.hasDadosPessoais', 'hasStatus')
                        ->where('deleted_at', null);
            if ($request->status_id) {
                // echo "status_id";
                $query->where('status_id', $request->status_id);
            }

            if ($request->competenciaInicio) {
                // echo "competencia";
                $competenciaInicio = date('Y-m-d', strtotime($request->competenciaInicio));
                $competenciaFim = date('Y-m-d', strtotime($request->competenciaFim));

                $query->whereBetween('competencia', [$competenciaInicio,$competenciaFim]);
            }

            if ($request->tipo_entrada_id) {
                // echo "tipo_entrada_id";
                $query->where('tipo_entrada_id', $request->tipo_entrada_id);
            }

            if ($request->tipo_pagador == 2) {
                // echo "tipo_pagador";
                $query->where('pagador', $request->pagador);
            }

            if ($request->tipo_pagador == 1) {
                $associado_id = $request->associado_id;
                $entradas_id  = [];
                $entradaAssociado = AssociadoHasEntrada::where('associado_id', $request->associado_id)->get();

                foreach ($entradaAssociado as $ent) {
                    $entradas_id[] = $ent->entrada_id;
                }

                $query->whereIn('entrada_id', $entradas_id);
            }

            $entradas = $query->orderBy('competencia','desc')->orderBy('pagador')->get();

            return view('relatorio.financeiro.entrada.print_relatorio', compact('entradas'));
        } catch (\Exception $e) {
            return [
                'status'  => 'error',
                'msg'     => 'Ocorreu um erro! '.$e->getMessage()
            ];
        }
    }


    public function formSaida()
    {
        return view('relatorio.financeiro.saida.form_saida');
    }

    public function buscarSaida(Request $request)
    {
        // dd($request->all());
        try {
            $query = Saida::with('hasTipoSaida')->where('deleted_at', null);

            // if ($request->status_id) {
            //     // return 1;
            //     $query->where('status_id', $request->status_id);
            // }

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

            $saidas = $query->orderBy('saida_id', 'desc')->get();

            // dd($saidas);
            return view('relatorio.financeiro.saida.print_relatorio', compact('saidas'));
        } catch (\Exception $e) {
            return [
                'status'  => 'error',
                'msg'     => 'Ocorreu um erro! '.$e->getMessage()
            ];
        }
    }

}
