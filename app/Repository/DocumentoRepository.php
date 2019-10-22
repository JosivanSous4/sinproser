<?php

namespace App\Repository;

use \Auth;
use App\Models\Documento;
use App\Models\Associado;
use App\Models\Status;

class DocumentoRepository
{
    use \App\Http\Traits\Message;

    public function readAll()
    {
        $query = Documento::where('status_id', 1)
                            ->whereNotIn('documento_id', [Documento::RECIBO_ENTRADA, Documento::RECIBO_SAIDA]);

        return $query;
    }

    public function getDocumento($id)
    {
        $query = Documento::where('status_id', 1)
                            ->whereNotIn('documento_id', [Documento::RECIBO_ENTRADA, Documento::RECIBO_SAIDA])
                            ->find($id);

        return $query;
    }

    public function updateOrCreate($request)
    {
        $dados = $request->all();

        $dados['status_id'] = Status::ATIVO;
        $dados['usuario_id'] = Auth::user()->user_id;

        try {
            Documento::updateOrCreate(['documento_id' => $dados['documento_id']], $dados);
            
            if ($request->documento_id) {
                $message = 'Editado com Sucesso!';
            } else {
                $message = 'Salvo com Sucesso!';
            }

            return self::message('Documento', $message);
        }  catch (\Exception $ex) {
            return self::message('Documento', 'Erro ao salvar documento', $ex->getMessage());
        }
    }

    public static function imprimir($request)
    {
        try {

            $associado = Associado::with('hasDadosPessoais')->find($request->associado_id);
            $documento = Documento::find($request->documento_id);
            
            $concatAssociado = ['nome', 'sexo', 'cpf', 'rg', 'salario'];

            $arrAssociado = $associado->toArray();
            $arrAssociado += $associado->hasDadosPessoais->toArray();
            unset($arrAssociado['has_dados_pessoais']);

            $find = [];
            $dados = [];
            foreach ($arrAssociado as $indice => $dado) {
                if (in_array($indice, $concatAssociado)) {
                    $find[] = "{".$indice."_associado}";
                } else {
                    $find[] = "{".$indice."}";
                }
                $dados[] = $dado;
            }

            $find[] = '{lacuna}';
            $dados[] = '<input type="text" class="lacuna tamanho-dinamico text-center" placeholder="Preencha a lacuna">';
            
            $texto = str_replace($find, $dados, $documento->template_documento);

            $documento->template_documento = $texto;

            return $documento;
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
