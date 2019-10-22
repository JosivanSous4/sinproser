<?php

namespace App\Repository\Site;

use Illuminate\Support\Facades\DB;
use App\Repository\ReciboRepository;
use App\Repository\GenericRepository;
use App\Models\Site\Parceiro;
use App\Models\Endereco;
use App\Models\Log;

class ParceiroRepository extends GenericRepository
{
    public function createOrUpdate($request)
    {
        try {
            DB::transaction(function () use ($request){
                $dadosEndereco = json_decode($request->endereco);
                $dadosContatos = json_decode($request->contatos);

                $endereco = Endereco::updateOrCreate(['endereco_id' => $dadosEndereco->endereco_id], (array)$dadosEndereco);

                $formParceiro = [
                    'nome'          => $request->nome,
                    'parceiro_id'   => $request->parceiro_id,
                    'endereco_id'   => $endereco->endereco_id,
                    'descricao'     => $request->descricao
                ];

                if(!is_null($request->file('foto'))){
                    $formParceiro['foto'] = self::upload($request->file('foto'));
                }

                $parceiro = Parceiro::updateOrCreate(['parceiro_id' => $request->parceiro_id], $formParceiro);

                self::salvarVariosContatos($parceiro, $dadosContatos);

                $dados = json_encode($request->all());

                if($request->parceiro_id){
                    Log::sucesso('parceiro', 'Josivan alterou dados de <b>' . $parceiro->nome . '-</b>', $dados, 1);
                } else {
                    Log::sucesso('parceiro', 'Josivan registrou <b>' . $parceiro->nome . '-</b> como associado', $dados, 1);
                }
            });

            if ($request->parceiro_id) {
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
