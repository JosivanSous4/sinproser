<?php

namespace App\Repository;

use App\Models\Endereco;
use App\Models\Site\Sindicato;
use Illuminate\Support\Facades\DB;

class InformacoesSindicatoRepository extends GenericRepository
{
    use \App\Http\Traits\Message;

    public function getInformacoesSindicato()
    {
        $dados = Sindicato::with('hasEndereco.hasCidade', 'hasContatos')->first();

        return $dados;
    }

    public function updateOrCreate($request)
    {
        try {
            DB::transaction(function () use ($request) {
                $dadosEndereco = (array) json_decode($request->endereco);
                $dadosContatos = (array) json_decode($request->contatos);

                $endereco = Endereco::updateOrCreate(['endereco_id' => $dadosEndereco['endereco_id']], $dadosEndereco);

                $sindicato = [
                    'nome' => $request->nome,
                    'descricao' => $request->descricao,
                ];

                $sindicato['endereco_id'] = $endereco->endereco_id;

                if($request->file('foto')){
                    $sindicato['foto'] = self::upload($request->file('foto'));
                }

                $sindicato = Sindicato::updateOrCreate(['sindicato_id' => $request['sindicato_id']], $sindicato);

                self::salvarVariosContatos($sindicato, $dadosContatos);

                $dados = $request->all();
            });

            if($request->sindicato_id){
                return [
                    'status'    => 'success',
                    'msg'       => 'Editado com sucesso!'
                ];
            } else {
                return [
                    'status'    => 'success',
                    'msg'       => 'Salvo com sucesso!'
                ];
            }

        }  catch (\Exception $ex) {
            if($request->sindicato_id){
                return [
                    'status'    => 'error',
                    'msg'       => 'Houve um erro ao editar informamções do sindicato! : '.$ex
                ];
            } else {
                return [
                    'status'    => 'error',
                    'msg'       => 'Houve um erro ao salvar informações do sindicato! : '.$ex
                ];
            }
        }
    }
}
