<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;
use App\Models\Bem;
use App\Models\Produto;
use App\Models\Status;
use DateTime;

class BemRepository
{
    use \App\Http\Traits\Message;

    public static function readAll() 
    {
        $query = Bem::where('status_id', Status::DISPONIVEL);

        return $query;
    }

    public function updateOrCreate($request) 
    {
        $dados = $request->all();

        $dados['status_id'] = Status::DISPONIVEL;
        $dados['data_aquisicao'] = DateTime::createFromFormat('d/m/Y', $dados['data_aquisicao'])->format('Y-m-d');

        try {
            DB::transaction(function() use($dados) {
                $produto = Produto::updateOrCreate(['produto_id' => $dados['produto_id']], $dados);

                $dados['produto_id'] = $produto->id;
                
                for ($i=0; $i < $dados['qtde_bem']; $i++) {
                    Bem::updateOrCreate(['bem_id' => $dados['bem_id']], $dados);
                }
            });

            if ($request->bem_id) {
                $message = 'Editado com Sucesso!';
            } else {
                $message = 'Salvo com Sucesso!';
            }

            return self::message('Bem' , $message);
        }  catch (\Exception $ex) {
            return self::message('Bem', 'Erro ao salvar bem', $ex->getMessage());
        }
    }
}
