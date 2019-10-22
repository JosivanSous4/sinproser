<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\DocumentoRepository;
use App\Http\Requests\DocumentoFormRequest;
use App\Http\Requests\EmitirDocumentoFormRequest;

class DocumentoController extends Controller
{
    public function index()
    {
        return view('documentos.listar-documentos');
    }

    public function criarDocumentoGet()
    {
        return view('documentos.criar-documentos');
    }

    public function editarDocumentoGet($documento_id)
    {
        $documentoRepository = new DocumentoRepository();

        $documento = $documentoRepository->getDocumento($documento_id);

        return view('documentos.editar-documentos', compact('documento'));
    }

    public function criarOuEditarDocumentoPost(DocumentoFormRequest $request)
    {
        $documentoRepository = new DocumentoRepository();

        $retorno = $documentoRepository->updateOrCreate($request);

        if ($retorno->bol_success) {
            return ['msg' => $retorno->msg , 'status' => 'success'];
        } else {
            return ['msg' => $retorno->msg , 'status' => 'error'];
        }
    }

    public function emitirDocumentoGet()
    {
        return view('documentos.emitir-documentos');
    }

    public function validarDocumento(EmitirDocumentoFormRequest $request)
    {
        return response()->json([
                'status' => "success",
                'msg'    => "Documento foi gerado com sucesso!"
            ], 200);
    }

    public function emitirDocumentoPost(Request $request)
    {
        $documentoRepository = new DocumentoRepository();

        try {
            $documento = $documentoRepository->imprimir($request);

            return view('documentos.documento-print', compact('documento'));
        } catch (\Exception $e) {
            return response()->json(
                [
                    'status'  => 'error',
                    'msg'     => 'Erro ao emitir documento! ' . $e->getMessage()
                ]);
        }
    }

    public function getListaDocumentos()
    {
        $documentoRepository = new DocumentoRepository();

        try {
            $dados = $documentoRepository->readAll()->get();

            return response()->json($dados, 200);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'status'  => 'error',
                    'msg'     => 'Erro ao processar! ' . $e->getMessage()
                ]);
        }
    }
}