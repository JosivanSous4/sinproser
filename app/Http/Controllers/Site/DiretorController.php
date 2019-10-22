<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Site\Diretor;
use Illuminate\Http\Request;
use App\Http\Requests\Site\DiretorRequest;
use App\Repository\Site\DiretorRepository;
use Validator;

class DiretorController extends Controller
{
    public function index()
    {
        return view('configuracoes.site.diretor.listar-diretor');
    }

    public function getFormDiretor($diretor_id="")
    {
        $diretor = null;
        if ($diretor_id != "") {
            $diretor = Diretor::find($diretor_id);
        }

        return view('configuracoes.site.diretor.form-diretor', compact('diretor'));
    }

    public function postSalvarDiretor(DiretorRequest $request)
    {
        try {
            $diretorRepository = new DiretorRepository();

            $salvar = $diretorRepository->createOrUpdate($request);

            if ($salvar['status'] == 1) {
                return [
                    'status'  => 'success',
                    'msg'     => $salvar['msg']
                ];
            } else {
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

    public function postExcluirDiretor(Request $request)
    {
        try {
            $diretor = Diretor::find($request->diretor_id);
            $diretor->deleted_at = date('Y-m-d H:i:s');
            $diretor->save();

            return [
                'status' => 'success',
                'msg'    => 'Diretor excluído com sucesso!'
            ];
        } catch (\Exception $e) {
            return [
                'status'  => 'error',
                'msg'     => 'Erro ao processar! ' . $e->getMessage()
            ];
        }
    }

}
