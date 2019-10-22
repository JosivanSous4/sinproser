<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;
use App\Models\LocalTrabalho;
use App\Models\Endereco;
use App\Models\Status;
use App\Models\Log;
use \Exception;
use \Auth;

class LocalTrabalhoRepository extends GenericRepository
{
    public function localTrabalho()
    {
        return new LocalTrabalho();
    }

    public function endereco()
    {
        return new Endereco();
    }

    public function updateOrCreateOne($request) 
    {
        DB::transaction(function () use($request) {

            if($request->has('local_de_trabalho_id')){
                $localTrabalhoAnt = $this->localTrabalho()->getQuery()->where('local_de_trabalho_id', $request->local_de_trabalho_id)->first(); 
            }

            $endereco = $this->endereco()->updateOrCreate(['enderecos.endereco_id' => $request->endereco['endereco_id']], $request->endereco);

            $localTrabalho = $request->all();
            $localTrabalho['endereco_id'] = $endereco->endereco_id;
            $localTrabalho['usuario_criador_id'] = Auth::user()->user_id;

            $localTrabalhoSalvo = $this->localTrabalho()
                                        ->updateOrCreate([
                                            'local_de_trabalho_id' => $request->local_de_trabalho_id
                                        ], $localTrabalho);  

            $this->salvarVariosContatos($localTrabalhoSalvo, $request->contatos);

            if($localTrabalhoAnt){
                $dados = json_encode($localTrabalhoAnt);
            } else {
                $dados = json_encode($request->all());
            }

            if($request->local_de_trabalho_id){
                Log::sucesso('configurações', 'Jesonilton alterou dados do local de trabalho: <b>' . $localTrabalhoAnt->getStrLocalTrabalho() . '</b>', $dados, 1);
            } else {
                Log::sucesso('associados', 'Jesonilton registrou o local de trabalho: <b>' . $localTrabalhoSalvo->getStrLocalTrabalho() . '</b>', $dados, 1);
            }
        });
    }

    public function getLocaisDeTrabalho()
    {
        $locaisDeTrabalho = LocalTrabalho::with(['hasEndereco'=>function($query){
            return $query->with('hasCidade');
        }])->get();

        $locaisDeTrabalho = $locaisDeTrabalho->map(function($localTrabalho){
                                $endereco = $localTrabalho->hasEndereco;
                                $strLocalTrabalho = $localTrabalho->getStrLocalTrabalho();

                                return [
                                    'local_de_trabalho_id' => $localTrabalho->local_de_trabalho_id,
                                    'strLocalTrabalho'     => $strLocalTrabalho
                                ];
                            });

        return $locaisDeTrabalho;
    }

    public function getLocalDeTrabalho($local_de_trabalho_id)
    {
        $localTrabalho = LocalTrabalho::with(['hasContatos', 'hasEndereco'=>function($query){
            return $query->with('hasCidade');
        }])->find($local_de_trabalho_id);

        return $localTrabalho;
    }

    public function excluirLocalDeTrabalho($local_de_trabalho_id)
    {
        $localTrabalho = LocalTrabalho::find($local_de_trabalho_id);
        $localTrabalho->delete();
    }
}
