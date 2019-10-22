<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\ProdutoRepository;
use App\Repository\EmprestimoRepository;
use App\Http\Requests\BensFormRequest;

class BemController extends Controller
{
    public function index()
    {
        return view('bens.listar-bens');
    }

    public function getCadastroDeBens()
    {
        return view('bens.form-bens');
    }

    public function postCadastroDeBens(BensFormRequest $request)
    {
        $produtoRepository = new ProdutoRepository();

        $retorno = $produtoRepository->updateOrCreate($request);

        if ($retorno->bol_success) {
            return ['msg' => $retorno->msg , 'status' =>'success'];
        } else {
            return ['msg' => $retorno->msg , 'status' =>'error'];
        }
    }

    public function getListaBens()
    {
        $produtoRepository = new ProdutoRepository();

        try {
            $dados = $produtoRepository->readAll();

            return response()->json($dados, 200);;
        } catch (\Exception $e) {
            return response()->json(
                [
                    'status'  => 'error',
                    'msg'     => 'Erro ao processar! ' . $e->getMessage()
                ], 200);
        }
    }

    public function getEmprestarBens($produto_id)
    {
        $produtoRepository = new ProdutoRepository();
        
        $produto = json_encode($produtoRepository->getEmprestarProduto($produto_id));
        
        return view('bens.emprestar-bens', compact('produto'));
    }

    public function postEmprestarBens(Request $request)
    {
        $emprestimoRepository = new EmprestimoRepository();

        if($emprestimoRepository->registrarEmprestimo($request)){
            if ($request['emprestimo_bem_id']) {
                $message = 'Atualizado com Sucesso!';
            } else {
                $message = 'Salvo com Sucesso!';
            }

            $status = 'success';
        } else{
            if ($request['emprestimo_bem_id']) {
                $message = 'Erro ao editar. Recarregue a página e tente novamente!';
            } else {
                $message = 'Erro ao salvar. Recarregue a página e tente novamente!';
            }

            $status = 'error';
        }

        return ['status' => $status, 'msg' => $message];
    }

    public function getEditarBem($produto_id)
    {
        $produtoRepository = new ProdutoRepository();
        $produto = json_encode($produtoRepository->getProduto($produto_id));

        return view('bens.editar-bem', compact('produto'));
    }

    public function postEditarBem(Request $request)
    {
        $produtoRepository = new ProdutoRepository();

        $retorno = $produtoRepository->updateOrCreate($request);

        if ($retorno->bol_success) {
            return ['msg' => $retorno->msg , 'status' =>'success'];
        } else {
            return ['msg' => $retorno->msg , 'status' =>'error'];
        }
    }

    public function getEmprestimos()
    {
        return view('bens.emprestimos');
    }

    public function getDevolucao($emprestimo_bem_id)
    {
        $emprestimoRepository = new EmprestimoRepository();

        $emprestimo = json_encode($emprestimoRepository->getEmprestimo($emprestimo_bem_id));

        return view('bens.devolver-bens', compact('emprestimo'));
    }


    public function postDevolver(Request $request)
    {
        $data_devolucao     = $request->data_devolucao;
        $bens               = $request->bens_selecionados;
        $emprestimo_bem_id  = $request->emprestimo_bem_id;

        $emprestimoRepository = new EmprestimoRepository();

        $devolucao = $emprestimoRepository->postDevolucao($request);

        return response()->json($devolucao, 200);;
    }
}
