<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;
use App\Models\TipoFormacao;

class TipoFormacaoRepository {
	
	public function getTiposDeFormacoes()
	{
		return TipoFormacao::select('tipo_formacao_id', 'nome', 'descricao')->get();
	}

	public function getTipoDeFormacao($tipoFormacao_id)
	{
		return TipoFormacao::find($tipoFormacao_id);
	}

	public function salvar($request)
	{
        try {
            DB::transaction(function () use ($request){
                TipoFormacao::updateOrCreate(['tipo_formacao_id' => $request['tipo_formacao_id']], $request->all());
            });

			return true;
        }  catch (\Exception $ex) {
            return false;
        }
	}

	public function excluir($tipo_formacao_id)
	{
        try {
            DB::transaction(function () use ($tipo_formacao_id){
                $tipoFormacao = TipoFormacao::find($tipo_formacao_id);
                $tipoFormacao->delete();
            });

			return true;
        }  catch (\Exception $ex) {
            return false;
        }
	}
}