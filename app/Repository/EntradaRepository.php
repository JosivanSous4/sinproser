<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;
use App\Models\Entrada;
use App\Models\Recibo;
use App\Models\Associado;
use App\Models\Status;
use App\Models\AssociadoHasEntrada;
use App\Repository\ReciboRepository;

class EntradaRepository
{
    static public function updateOrCreateOne($request)
    {
        try {
            if ($request['tipo_entrada_id'] == 1 AND $request['tipo_pagador'] == 1) {
                $verificacao = Entrada::join('associados_has_entradas', 'associados_has_entradas.entrada_id', '=', 'entradas.entrada_id')
                                ->where('tipo_entrada_id', $request['tipo_entrada_id'])
                                ->where('competencia', $request['competencia'])
                                ->where('associados_has_entradas.associado_id', $request['associado_id'])
                                ->first();
                // $verificacao = $queryVerificacao;
                if ($verificacao) {
                    return [
                            'status' => 0,
                            'msg' => 'Entrada já registrada no dia ' . date('d/m/Y', strtotime($verificacao->created_at))
                        ];
                }
            }

            DB::transaction(function () use ($request){
                $pagador = '';

                if ($request['tipo_pagador'] == 0) {
                    $pagador = $request['pagador'];
                }else {
                    $associado = Associado::with('hasDadosPessoais')->find($request['associado_id']);
                    $pagador = $associado->hasDadosPessoais->nome;
                }

                // $dadosRecibo = [
                //     'recibo_id'             => null,
                //     'nome_receptor'         => $pagador,
                //     'data_emissao'          => $request['data_emissao'],
                //     'motivo_emissao'        => $request['descricao'],
                //     'valor'                 => $request['valor'],
                //     'tipo_recibo_id'        => 2,
                //     'usuario_emissor_id'    => 1
                // ];
                //
                // $recibo = Recibo::updateOrCreate(['recibo_id' => $dadosRecibo['recibo_id']], $dadosRecibo);

                // $request['recibo_id'] = $recibo->recibo_id;
                $request['usuario_criador_id'] = 1;

                if ($request['tipo_entrada_id'] == 1 AND $request['tipo_pagador'] == 1) {
                    $associado = Associado::with('hasDadosPessoais')->find($request['associado_id']);
                    $request['pagador'] = $associado->hasDadosPessoais->nome;
                }

                $entrada = Entrada::updateOrCreate(['entrada_id' => $request['entrada_id']], $request);

                if ($request['tipo_entrada_id'] == 1 AND $request['tipo_pagador'] == 1) {
                    $associadoHasEntrada = new AssociadoHasEntrada();

                    $associadoHasEntrada->associado_id  = $request['associado_id'];
                    $associadoHasEntrada->entrada_id    = $entrada->entrada_id;
                    $associadoHasEntrada->data_repasse  = $request['data_pagamento'];
                    $associadoHasEntrada->save();
                }
            });

            if ($request['entrada_id']) {
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
            $valorTotal = (Entrada::select(DB::raw('SUM(valor) as total'))->where('status_id', Status::PAGO)->whereMonth('data_pagamento', $key)->whereYear('data_pagamento', $ano)->first())->total;
            $dados[] = floatval($valorTotal? $valorTotal : 0);
        }
        
        return $dados;
    }

    public static function getDadosGraficoAdimplencia($mes = null, $ano = null)
    {
        if(is_null($mes)){
            $mes = date('m');
        }

        if(is_null($ano)){
            $ano = date('Y');
        }

        $adimplentes = Entrada::select(DB::raw('count(*) as total_adimplentes, SUM(valor) as total'))->where('status_id', Status::PAGO)->whereMonth('data_pagamento', $mes)->whereYear('data_pagamento', $ano)->first();
        $adimplentes = [
            'total_adimplentes' => $adimplentes->total_adimplentes,
            'valor_total' => $adimplentes->total != null? $adimplentes->total: 0
        ];

        $inadimplentes = Entrada::select(DB::raw('count(*) as total_inadimplentes, SUM(valor) as total'))->where('status_id', Status::ABERTO)->whereMonth('data_pagamento', $mes)->whereYear('data_pagamento', $ano)->first();

        $inadimplentes = [
            'total_inadimplentes' => $inadimplentes->total_inadimplentes,
            'valor_total' => $inadimplentes->total != null? $inadimplentes->total: 0
        ];

        return (Object)[
            'adimplentes'   => $adimplentes,
            'inadimplentes' => $inadimplentes,
            'mes'           => $mes,
            'ano'           => $ano
        ];
    }
}
