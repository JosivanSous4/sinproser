<?php

namespace App\Repository\Site;

use Illuminate\Support\Facades\DB;
use App\Repository\ReciboRepository;
use App\Repository\GenericRepository;
use App\Models\Site\Diretor;
use App\Models\Log;

class DiretorRepository extends GenericRepository
{
    public function createOrUpdate($request)
    {
        try {
            DB::transaction(function () use ($request){
                $formDiretor = [
                    'nome'          => $request->nome,
                    'diretor_id'    => $request->diretor_id,
                    'cargo'         => $request->cargo
                ];
                //
                if(!is_null($request->file('foto'))){
                    $formDiretor['foto'] = self::upload($request->file('foto'));
                }

                $diretor = Diretor::updateOrCreate(['diretor_id' => $formDiretor['diretor_id']], $formDiretor);

                $dados = json_encode($request->all());

                if($request->diretor_id){
                    Log::sucesso('parceiro', 'Josivan alterou dados de <b>' . $diretor->nome . '-</b>', $dados, 1);
                } else {
                    Log::sucesso('parceiro', 'Josivan registrou <b>' . $diretor->nome . '-</b> como associado', $dados, 1);
                }
            });

            if ($request->diretor_id) {
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
