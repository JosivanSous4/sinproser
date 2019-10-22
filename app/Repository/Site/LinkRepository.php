<?php

namespace App\Repository\Site;

use Illuminate\Support\Facades\DB;
use App\Repository\ReciboRepository;
use App\Repository\GenericRepository;
use App\Models\Site\LinkUtil;
use App\Models\Log;

class LinkRepository extends GenericRepository
{
    public function createOrUpdate($request)
    {
        try {
            DB::transaction(function () use ($request){
                $formLink = [
                    'link_id'   => $request->link_id,
                    'link'      => $request->link,
                    'destino'   => $request->destino,
                    'descricao' => $request->descricao
                ];

                $link = LinkUtil::updateOrCreate(['link_id' => $formLink['link_id']], $formLink);

                $dados = json_encode($request->all());

                if($request->link_id){
                    Log::sucesso('parceiro', 'Josivan alterou dados de <b>' . $link->link . '-</b>', $dados, 1);
                } else {
                    Log::sucesso('parceiro', 'Josivan registrou <b>' . $link->link . '-</b> como associado', $dados, 1);
                }
            });

            if ($request->link_id) {
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
