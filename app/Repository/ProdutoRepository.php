<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;
use App\Models\Bem;
use App\Models\Produto;
use App\Models\Status;
use DateTime;

class ProdutoRepository
{
    use \App\Http\Traits\Message;

    public function updateOrCreate($request)
    {
        $dados = $request->all();

        $dados['status_id'] = Status::DISPONIVEL;
        try {
            DB::transaction(function() use($dados) {
                $produto = Produto::updateOrCreate(['produto_id' => $dados['produto_id']], $dados);

                if(isset($dados['bens_selecionados'])){
                    Bem::whereIn('bem_id', $dados['bens_selecionados'])->delete();
                }

                $dados['produto_id'] = $produto->produto_id;
                if($dados['qtde_bem'] > $produto->hasBens->count()){

                    $qtdBens = $dados['qtde_bem'] - $produto->hasBens->count();
                    for ($i=0; $i < $qtdBens; $i++) {
                        Bem::create($dados);
                    }
                }

            });

            if ($request->produto_id) {
                $message = 'Editado com Sucesso!';
            } else {
                $message = 'Salvo com Sucesso!';
            }

            return self::message('Bem' , $message);
        }  catch (\Exception $ex) {
            return self::message('Bem', 'Erro ao salvar bem', $ex->getMessage());
        }
    }

    public static function readAll()
    {
        // $produtos = Produto::with(['hasBens' => function($query){
        //                     return $query->where('status_id', Status::DISPONIVEL);
        //                 }])->get();
        $produtos = Produto::with(['hasBens'])->get();

        // dd($produtos);
        $prods = $produtos->map(function($produto){
                    $qtd = (object)self::getQuantidadeBens($produto);

                    return [
                        'produto_id'        => str_pad($produto->produto_id, 6, "0", STR_PAD_LEFT),
                        'nome'              => $produto->nome,
                        'descricao'         => $produto->descricao,
                        'valor_unitario'    => $produto->valor_unitario,
                        'valor_total'       => $produto->valor_unitario * count($produto->hasBens),
                        'data_aquisicao'    => date('d/m/Y', strtotime($produto->hasBens[0]->data_aquisicao)),
                        'qtde_bem'                  => $qtd->qtdBens,
                        'qtde_bens_disponiveis'     => $qtd->qtdBensDisponiveis,
                        'qtde_bens_indisponiveis'   => $qtd->qtdBensIndisponiveis,
                    ];
                });

        return $prods;
    }

    public static function getProduto($produto_id)
    {
        $produto = Produto::with(['hasBens.hasStatus'])->where('produto_id', intval($produto_id))->first();

        $qtd = (object)self::getQuantidadeBens($produto);

        $produto = [
                    'produto_id'        => str_pad($produto->produto_id, 6, "0", STR_PAD_LEFT),
                    'nome'              => $produto->nome,
                    'descricao'         => $produto->descricao,
                    'valor_unitario'    => $produto->valor_unitario,
                    'valor_total'       => $produto->valor_unitario * count($produto->hasBens),
                    'data_aquisicao'    => date('d/m/Y', strtotime($produto->hasBens[0]->data_aquisicao)),
                    'has_bens'           => $produto->hasBens,
                    'qtde_bem'                  => $qtd->qtdBens,
                    'qtde_bens_disponiveis'     => $qtd->qtdBensDisponiveis,
                    'qtde_bens_indisponiveis'   => $qtd->qtdBensIndisponiveis,
                ];

        return $produto;
    }

    public static function getEmprestarProduto($produto_id)
    {
        $produto = Produto::with(['hasBens' => function($query){
                        return $query->with('hasStatus')->where('status_id', Status::DISPONIVEL);
                    }])->where('produto_id', intval($produto_id))->first();

        $qtd = (object)self::getQuantidadeBens($produto);

        $produto = [
                    'produto_id'        => str_pad($produto->produto_id, 6, "0", STR_PAD_LEFT),
                    'nome'              => $produto->nome,
                    'descricao'         => $produto->descricao,
                    'valor_unitario'    => $produto->valor_unitario,
                    'valor_total'       => $produto->valor_unitario * count($produto->hasBens),
                    'data_aquisicao'    => date('d/m/Y', strtotime($produto->hasBens[0]->data_aquisicao)),
                    'has_bens'           => $produto->hasBens,
                    'qtde_bem'                  => $qtd->qtdBens,
                    'qtde_bens_disponiveis'     => $qtd->qtdBensDisponiveis,
                    'qtde_bens_indisponiveis'   => $qtd->qtdBensIndisponiveis,
                ];

        return $produto;
    }

    public static function getQuantidadeBens($produto)
    {
        return [
            'qtdBensDisponiveis' => $produto->hasBens()->where('status_id', Status::DISPONIVEL)->count(),
            'qtdBensIndisponiveis' => $produto->hasBens()->where('status_id', Status::INDISPONIVEL)->count(),
            'qtdBens' => $produto->hasBens()->whereIn('status_id', [Status::DISPONIVEL, Status::INDISPONIVEL])->count()
        ];
    }
}
