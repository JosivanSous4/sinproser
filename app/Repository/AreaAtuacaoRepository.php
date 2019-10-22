<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;
use App\Models\Entrada;
use App\Models\Recibo;
use App\Models\Associado;
use App\Models\AreaAtuacao;
use App\Repository\ReciboRepository;
use \Auth;

class AreaAtuacaoRepository
{
    public function getAreasAtuacao()
    {
        return AreaAtuacao::select('area_atuacao_id', 'nome', 'descricao', 'dia_previsto_pagamento', 'usuario_criador_id')->with('hasUsuarioCriador')->get();
    }

    public function getAreaAtuacao($areaAtuacao_id)
    {
        return AreaAtuacao::find($areaAtuacao_id);
    }

    public function salvar($request)
    {
        try {
            DB::transaction(function () use ($request){
                $areaAtuacao = $request->all();
                $areaAtuacao['usuario_criador_id'] = Auth::user()->user_id;
                AreaAtuacao::updateOrCreate(['area_atuacao_id' => $request['area_atuacao_id']], $areaAtuacao);
            });

            return true;
        }  catch (\Exception $ex) {
            // dd($ex);
            return false;
        }
    }

    public function excluir($areaAtuacao_id)
    {
        try {
            DB::transaction(function () use ($areaAtuacao_id){
                $areaAtuacao = AreaAtuacao::find($areaAtuacao_id);
                $areaAtuacao->delete();
            });

            return true;
        }  catch (\Exception $ex) {
            return false;
        }
    }
}
