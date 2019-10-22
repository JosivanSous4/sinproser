<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;
use App\Models\TipoSaida;

class TipoSaidaRepository
{
    static public function updateOrCreateOne($request)
    {
        try {
            DB::transaction(function () use ($request){
                $tiposaida = TipoSaida::updateOrCreate(['tipo_saida_id' => $request['id']], $request);
            });

            if ($request['id']) {
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
