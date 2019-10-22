<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;
use App\Models\TipoEntrada;

class TipoEntradaRepository
{
    static public function updateOrCreateOne($request)
    {
        try {
            DB::transaction(function () use ($request){
                TipoEntrada::updateOrCreate(['tipo_entrada_id' => $request['tipo_entrada_id']], $request);
            });

            if ($request['tipo_entrada_id']) {
                $message = 'Editado com Sucesso!';
            } else {
                $message = 'Salvo com Sucesso!';
            }

            return ['status' => 1, 'msg' => $message];
        }  catch (\Exception $ex) {
            return ['status' => 0, 'msg' => 'Erro ao salvar' . ' ' . $ex];
        }
    }
}
