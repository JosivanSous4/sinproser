<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;
use App\Models\Saida;
use App\Models\Recibo;
use App\Repository\SaidaRepository;
use App\Repository\ReciboRepository;
use \Auth;

class SaidaRepository
{
    static public function updateOrCreateOne($request)
    {
        try {
            DB::transaction(function () use ($request){
                $dadosRecibo = [
                    'recibo_id'             => null,
                    'nome_receptor'         => $request['beneficiario'],
                    'data_emissao'          => $request['data_saida'],
                    'motivo_emissao'        => $request['descricao'],
                    'valor'                 => $request['valor'],
                    'tipo_recibo_id'        => 1,
                    'usuario_emissor_id'    => Auth::user()->user_id
                ];

                $recibo = Recibo::updateOrCreate(['recibo_id' => $dadosRecibo['recibo_id']], $dadosRecibo);

                $request['recibo_id'] = $recibo->recibo_id;
                $request['usuario_criador_id'] = Auth::user()->user_id;

                $saida = Saida::updateOrCreate(['saida_id' => $request['saida_id']], $request);
            });

            if ($request['saida_id']) {
                $message = 'Editado com Sucesso!';
            } else {
                $message = 'Salvo com Sucesso!';
            }

            return ['status' => 1, 'msg' => $message];
        }  catch (\Exception $ex) {
            return ['status' => 0, 'msg' => 'Erro ao salvar' . ' ' . $ex];
        }
    }

    public static function getDadosGraficoRendimento($ano = null)
    {
        if(is_null($ano)){
            $ano = date('Y');
        }

        $meses = array(1 => 'Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro');
        $dados = [];
        foreach ($meses as $key => $mes) {
            $valorTotal = (Saida::select(DB::raw('SUM(valor) as total'))->whereMonth('data_saida', $key)->whereYear('data_saida', $ano)->first())->total;
            $dados[] = floatval($valorTotal? $valorTotal : 0);
        }
        
        return $dados;
    }
}
