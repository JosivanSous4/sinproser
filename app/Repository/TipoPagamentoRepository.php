<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;
use App\Models\TipoPagamento;

class TipoPagamentoRepository {
	
	public function getTiposDePagamento()
	{
		return TipoPagamento::all();
	}

	public function getTipoDePagamento($tipoPagamento_id)
	{
		return TipoPagamento::find($tipoPagamento_id);
	}

	public function salvar($request)
	{
        try {
            DB::transaction(function () use ($request){
                TipoPagamento::updateOrCreate(['tipo_pagamento_id' => $request['tipo_pagamento_id']], $request->all());
            });

			return true;
        }  catch (\Exception $ex) {
            return false;
        }
	}

	public function excluir($tipo_pagamento_id)
	{
        try {
            DB::transaction(function () use ($tipo_pagamento_id){
                $tipoPagamento = TipoPagamento::find($tipo_pagamento_id);
                $tipoPagamento->delete();
            });

			return true;
        }  catch (\Exception $ex) {
            return false;
        }
	}
}