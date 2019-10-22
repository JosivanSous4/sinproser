<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;
use App\Models\Recibo;

class ReciboRepository
{
    static public function updateOrCreateOne($request) 
    {
        try {

            $recibo = DB::transaction(function () use ($request){
                return Recibo::updateOrCreate(['recibo_id' => $request['recibo_id']], $request);
            });

            return $recibo;
        }  catch (\Exception $ex) {
            return 'Erro ao salvar bem' . '' . $ex;
        }
    }
}
