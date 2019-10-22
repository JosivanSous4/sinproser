<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cidade;
use App\Models\Estado;
use App\Models\TipoEntrada;
use App\Models\TipoSaida;
use App\Models\AreaAtuacao;
use App\Models\TipoFormacao;
use App\Models\LocalTrabalho;
use App\Models\Saida;
use App\Models\Entrada;
use App\Models\GrauInstrucao;
use App\Models\TipoPagamento;
use App\Models\User;
use App\Models\Perfil;
use App\Repository\AssociadoRepository;
use App\Repository\LocalTrabalhoRepository;
use App\Repository\AreaAtuacaoRepository;
use App\Repository\TipoFormacaoRepository;
use App\Repository\EmprestimoRepository;
use \DB;


class ApiController extends Controller
{
    public function getEntradas($entrada_id='')
    {
        $query = Entrada::with('hasTipoEntrada', 'hasAssociadosEntradas.hasAssociados.hasDadosPessoais', 'hasStatus')
                    ->where('deleted_at', null)
                    ->orderBy('competencia', 'DESC')
                    ->orderBy('pagador');

        if ($entrada_id!='') {
           $entrada = $query->find($entrada_id);
        }else {
           $entrada = $query->paginate(20);
        }

        return $entrada;
    }

    public function getSaidas($saida_id='')
    {
        $query = Saida::with('hasTipoSaida')->where('deleted_at', null)->orderBy('saida_id', 'desc');
        if ($saida_id!='') {
           $saidas = $query->find($saida_id);
        } else {
           $saidas = $query->paginate(20);
        }

        return $saidas;
    }

    public static function getListaEstados()
    {
        return Estado::select('estado_id', 'estado')->get();
    }

    public static function getListaCidades($estado_id)
    {
        return Cidade::select('cidade_id', 'cidade')->where('estado_id', $estado_id)->get();
    }

    public function getTiposEntrada()
    {
        try {
            $tiposEntrada = TipoEntrada::get();

            return response()->json($tiposEntrada,200);;
        } catch (\Exception $e) {
            return response()->json(
                [
                    'status'  => 'error',
                    'msg'     => 'Erro ao processar! ' . $e->getMessage()
                ], 200);
        }
    }

    public function getTiposSaida()
    {
        try {
            $tiposSaida = TipoSaida::get();

            return response()->json($tiposSaida,200);;
        } catch (\Exception $e) {
            return response()->json(
                [
                    'status'  => 'error',
                    'msg'     => 'Erro ao processar! ' . $e->getMessage()
                ], 200);
        }
    }

    public function getTiposFormacoes()
    {
        $tipoFormacaoRepo = new TipoFormacaoRepository();
    	return $tipoFormacaoRepo->getTiposDeFormacoes();
    }

    public function getLocaisDeTrabalho()
    {
        $localTrabalhoRepo = new LocalTrabalhoRepository();
        return $localTrabalhoRepo->getLocaisDeTrabalho();
    }

    public function getGrausInstrucao()
    {
        return  GrauInstrucao::select('grau_instrucao_id', 'nome', 'descricao')->get();
    }

    public function getTiposPagamento()
    {
        return  TipoPagamento::select('tipo_pagamento_id', 'nome', 'descricao')->get();
    }

    public function getAreasAtuacao()
    {
        $areaAtuacaoRepo = new AreaAtuacaoRepository();
        return  $areaAtuacaoRepo->getAreasAtuacao();
    }

    public function getListaDeAssociados($status = 1)
    {
        $repoAssociado = new AssociadoRepository();

        $query = $repoAssociado->getQueryAssociado();
        
        if($status == 0){
            $associados = $query->onlyTrashed()->get();
        } else {
            $associados = $query->get();
        }

        $associados = $associados->map(function($associado){
            $data_associacao = date_create($associado->data_associacao);

            return (object)[
                'associado_id'  => $associado->associado_id,
                'nome' => $associado->hasDadosPessoais->nome,
                'area_atuacao' => $associado->hasAreaAtuacao->nome,
                'salario' => $associado->salario,
                'data_associacao' => date_format($data_associacao, 'd/m/Y')
            ];
        });

        return $associados;
    }

    public function getDadosAssociado($id_associado)
    {
        $repoAssociado = new AssociadoRepository();

        $associados = $repoAssociado->getQueryAssociado()->find($id_associado);

        $associados = $associados->map(function($associado){
            $data_associacao = date_create($associado->data_associacao);

            return (object) [
                'associado_id'  => $associado->associado_id,
                'nome' => $associado->hasDadosPessoais->nome,
                'area_atuacao' => $associado->hasAreaAtuacao->nome,
                'salario' => $associado->salario,
                'data_associacao' => date_format($data_associacao, 'd/m/Y')
            ];
        });

        return $associados;
    }

    public function getQuantidadeDeAssociados()
    {
        $repoAssociado = new AssociadoRepository();
        return $repoAssociado->getTotalDeAssociados();
    }

    public function getQuantidadeDeAssociadosProfessores()
    {
        $repoAssociado = new AssociadoRepository();
        return $repoAssociado->getTotalDeAssociadosProfessores();
    }

    public function getQuantidadeDeAssociadosNaoProfessores()
    {
        $repoAssociado = new AssociadoRepository();
        return $repoAssociado->getTotalDeAssociadosNaoProfessores();
    }

    public function getUsuarios()
    {
        try {
            $usuarios = User::with('hasDadosPessoais', 'hasContatos', 'hasPerfil')
                ->whereNull('deleted_at')
                ->orderBy('name')
                ->get();

            return response()->json($usuarios,200);;
        } catch (\Exception $e) {
            return response()->json(
                [
                    'status'  => 'error',
                    'msg'     => 'Erro ao processar! ' . $e->getMessage()
                ], 200);
        }
    }

    public function getPerfil()
    {
        try {
            $perfil = Perfil::orderBy('nome')->get();

            return response()->json($perfil,200);;
        } catch (\Exception $e) {
            return response()->json(
                [
                    'status'  => 'error',
                    'msg'     => 'Erro ao processar! ' . $e->getMessage()
                ], 200);
        }
    }

    public function getAniversariantesDoMes($mes = null){
        if(is_null($mes)) {
            $mes = date('m');
        }

        $aniversariantes = null;
        if($mes >= 1 && $mes <= 12) {
            $repoAssociado = new AssociadoRepository();
            $aniversariantes = $repoAssociado->getAniversariantes($mes);
        } else {
            return response()->json(
                [
                    'status'  => 'error',
                    'msg'     => 'O mês deve ser estar entre janeiro e dezembro',
                    'aniversariantes' => ''
                ], 422);
        }

        return response()->json(
            [
                'status'  => 'success',
                'msg'     => 'Sucesso ao buscar aniversariantes',
                'aniversariantes' => $aniversariantes
            ], 200);
    }

    public function getListaResponsaveis()
    {
        $repoEmprestimo = new EmprestimoRepository();
        return $repoEmprestimo->getListaResponsaveis();
    }

    public function getResponsavel($responsavel_id)
    {
        $repoEmprestimo = new EmprestimoRepository();
        return $repoEmprestimo->getResponsavel($responsavel_id);
    }

    public function getEmprestimos()
    {
        $emprestimoRepository = new EmprestimoRepository();
        // dd($emprestimoRepository->getEmprestimos());
        return $emprestimoRepository->getEmprestimos();
    }

}
