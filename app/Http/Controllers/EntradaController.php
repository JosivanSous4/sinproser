<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrada;
use App\Models\Status;
use App\Models\AssociadoHasEntrada;
use App\Models\Associado;
use App\Http\Requests\EntradaFormRequest;
use App\Repository\EntradaRepository;

class EntradaController extends Controller
{
    public function buscarEntrada(Request $request)
    {
        // dd($request->all());
        try {
            $query = Entrada::with('hasTipoEntrada', 'hasAssociadosEntradas.hasAssociados.hasDadosPessoais', 'hasStatus')
                        ->where('deleted_at', null);
            if ($request->status_id) {
                // echo "status_id";
                $query->where('status_id', $request->status_id);
            }

            if ($request->competenciaInicio) {
                // echo "competencia"; //competenciaInicio competenciaFim
                $request->competenciaFim = ($request->competenciaFim ? $request->competenciaFim : $request->competenciaInicio);
                $query->whereBetween('competencia', [$request->competenciaInicio, $request->competenciaFim]);
            }

            if ($request->tipo_entrada_id) {
                // echo "tipo_entrada_id";
                $query->where('tipo_entrada_id', $request->tipo_entrada_id);
            }

            if ($request->tipo_pagador == 2) {
                // echo "tipo_pagador";
                $query->where('pagador', $request->pagador);
            }

            if ($request->tipo_pagador == 1) {
                // echo "associado_id";

                $associado_id = $request->associado_id;
                $entradas_id  = [];
                $entradaAssociado = AssociadoHasEntrada::where('associado_id', $request->associado_id)->get();

                foreach ($entradaAssociado as $ent) {
                    $entradas_id[] = $ent->entrada_id;
                }

                $query->whereIn('entrada_id', $entradas_id);
            }

            $entradas = $query->orderBy('competencia', 'DESC')->orderBy('pagador')->paginate(20);
            // dd($entradas);
            return $entradas;
        } catch (\Exception $e) {
            return [
                'status'  => 'error',
                'msg'     => 'Ocorreu um erro! '.$e->getMessage()
            ];
        }
    }

    public function darBaixa(Request $request)
    {
        try {
            $entrada = Entrada::find($request->entrada_id);

            $entrada->status_id = 4;
            $entrada->data_pagamento = $request->data_pagamento;
            $entrada->save();

            return [
                'status'  => 'success',
                'msg'     => 'Pagamento registrado com sucesso!'
            ];
        } catch (\Exception $e) {
            return [
                'status'  => 'error',
                'msg'     => 'Ocorreu um erro! '.$e->getMessage()
            ];
        }
    }

    public function getStatusFinanceiro()
    {
        $status = Status::whereIn('status_id', [Status::ABERTO, Status::PAGO])->orderBy('status', 'DESC')->get();

        return $status;
    }

    public function getEntrada()
    {
        return view('financeiro.entrada.listar_entrada');
    }

    public function form($id = "")
    {
        $entrada = ($id=="" ? new Entrada() : Entrada::find($id));

    	return view('financeiro.entrada.form_entrada', compact('entrada'));
    }

	public function salvar(EntradaFormRequest $request)
    {
    	try {
            // $request->competencia = date('Y-m-d', strtotime($request->competencia));

            // dd($request->competencia);
            $salvar = EntradaRepository::updateOrCreateOne($request->all());

            if ($salvar['status'] == 1) {
                return [
                    'status'  => 'success',
                    'msg'     => $salvar['msg']
                ];
            }else{
                return [
                    'status'  => 'error',
                    'msg'     => 'Erro ao processar! ' . $salvar['msg']
                ];
            }
       	} catch (\Exception $e) {
    		return [
    			'status'  => 'error',
				'msg'     => 'Erro ao processar! ' . $e->getMessage()
    		];
    	}
    }

    public function geracaoEntradaMensal()
    {
        // dd("");
        try {
            Entrada::geracaoEntradaMensal();
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function excluirEntrada(Request $request)
    {
        try {
            $entrada = Entrada::find($request->entrada_id);
            $entrada->deleted_at = date('Y-m-d H:i:s');
            $entrada->save();

            $associado_id = (isset($request->has_associados_entradas) ? $request->has_associados_entradas['associado_id'] : null);

            if ($associado_id) {
                $associadoHasEntrada = AssociadoHasEntrada::where('associado_id', $associado_id)
                    ->where('entrada_id', $entrada->entrada_id)
                    ->update(['deleted_at' => date('Y-m-d H:i:s')]);
            }

            return [
                'status' => 'success',
                'msg'    => 'Entrada excluída com sucesso!'
            ];
        } catch (\Exception $e) {
            return [
    			'status'  => 'error',
				'msg'     => 'Erro ao processar! ' . $e->getMessage()
    		];
        }
    }

    public function formBaixaColetiva()
    {
        return view('financeiro.entrada.form_baixa_coletiva');
    }

    public function baixaColetiva(Request $request)
    {
        try {
            $data_pagamento     = $request->data_pagamento;
            $competencia        = $request->competencia;
            $area_atuacao_id    = $request->area_atuacao_id;

            $entrada_ids       = array_unique($request->entrada_id);

            // dd($data_pagamento,$competencia,$area_atuacao_id,$entrada_ids);
            $baixas = '';
            $entradas = Entrada::join('associados_has_entradas', 'associados_has_entradas.entrada_id', '=', 'entradas.entrada_id')
                                ->join('associados', 'associados.associado_id', '=', 'associados_has_entradas.associado_id')
                                ->where('associados.area_atuacao_id', $area_atuacao_id)
                                ->where('entradas.competencia', $competencia)
                                ->where('entradas.status_id', Status::ABERTO)
                                ->whereIn('entradas.entrada_id', $entrada_ids)
                                ->get();
            ////////////////////////////////////////////////////////////////////////////////////
            if (count($entradas) != 0) {
                foreach ($entradas as $index => $entrada) {
                    $entrada->status_id = 4;
                    $entrada->data_pagamento = $data_pagamento;
                    $entrada->save();

                    $baixas .= $entrada->pagador . (count($entradas) != ($index+1) ? ", " : "");
                }

                $baixas = "Pagamento(s) recebido(s) de:<br>".$baixas;
            }else {
                $baixas = 'Não foi encontrado nenhuma entrada correspondente.';
            }

            $texto = $baixas;
            return [
                'status'  => 'success',
                'msg'     => 'Baixa registrado com sucesso!',
                'texto'   => $baixas
            ];
        } catch (\Exception $e) {
            return [
                'status'  => 'error',
                'msg'     => 'Ocorreu um erro! '.$e->getMessage()
            ];
        }
    }

    public function buscarEntradaParaBaixa(Request $request)
    {
        try {
            $entradas = Entrada::select('entradas.entrada_id', 'entradas.status_id', 'pagador', 'competencia', 'valor', 'data_pagamento', 'descricao')
                            ->with('hasStatus')
                            ->join('associados_has_entradas', 'associados_has_entradas.entrada_id', '=', 'entradas.entrada_id')
                            ->join('associados', 'associados.associado_id', '=', 'associados_has_entradas.associado_id')
                            ->where('competencia', $request->competencia)
                            ->where('associados.tipo_pagamento_id', $request->tipo_pagamento_id)
                            ->where('associados.area_atuacao_id', $request->area_atuacao_id)
                            ->where('entradas.status_id', Status::ABERTO)
                            ->orderBy('competencia', 'desc')
                            ->orderBy('pagador')
                            ->get();

                            // Status::ABERTO

            return response()->json($entradas,200);;
        } catch (\Exception $e) {
            return response()->json(
                [
                    'status'  => 'error',
                    'msg'     => 'Erro ao processar! ' . $e->getMessage()
                ], 200);
        }
    }

    public function recibo($id="")
    {
        $entrada = Entrada::with(['hasAssociadosEntradas.hasAssociados.hasEndereco'])->find($id);

        // dd($entrada->hasAssociadosEntradas->hasAssociados->hasDadosPessoais);

        if ($entrada->tipo_entrada_id == 1) {
            $texto = "Recebi de <span><b>".$entrada->pagador."</b></span>, sócio(a) de código ".$entrada->hasAssociadosEntradas->associado_id.", inscrito(a) no CPF sob o número ".$entrada->hasAssociadosEntradas->hasAssociados->hasDadosPessoais->cpf.", endereço rua ".$entrada->hasAssociadosEntradas->hasAssociados->hasEndereco->rua.", bairro ".$entrada->hasAssociadosEntradas->hasAssociados->hasEndereco->bairro.", ".$entrada->hasAssociadosEntradas->hasAssociados->hasEndereco->hasCidade->cidade." - ".$entrada->hasAssociadosEntradas->hasAssociados->hasEndereco->hasCidade->hasEstado->uf.", na data de ".date('d/m/Y', strtotime($entrada->data_pagamento))." a importância de <b>R$ ".number_format($entrada->valor,2,",",".")."</b> referente a quitação do(s) mese(s) de "
                    .date('m/Y', strtotime($entrada->competencia)).".";
        }else {
            $texto = "Recebi de <span><b>".$entrada->pagador."</b></span>, na data de ".date('d/m/Y', strtotime($entrada->data_pagamento))." a quantia de R$ ".number_format($entrada->valor,2,",",".")." referente a ".mb_strtoupper($entrada->descricao).".";
        }

        // dd($texto);
        return view('financeiro.print_recibo', compact('texto'));
    }
}
