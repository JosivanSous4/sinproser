<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Site\Diretor;
use App\Models\Site\LinkUtil;
use Illuminate\Http\Request;
use App\Http\Requests\Site\LinkRequest;
use App\Repository\Site\LinkRepository;
use Validator;

class LinkUtilController extends Controller
{
    public function index()
    {
        return view('configuracoes.site.link-util.listar-links');
    }

    public function getFormLink($link_id="")
    {
        $link = null;
        if ($link_id != "") {
            $link = LinkUtil::find($link_id);
        }

        return view('configuracoes.site.link-util.form-link', compact('link'));
    }

    public function postSalvarLink(LinkRequest $request)
    {
        try {
            $linkRepository = new LinkRepository();

            $salvar = $linkRepository->createOrUpdate($request);

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

    public function postExcluirLink(Request $request)
    {
        try {
            $link = LinkUtil::find($request->link_id);
            $link->deleted_at = date('Y-m-d H:i:s');
            $link->save();

            return [
                'status' => 'success',
                'msg'    => 'Link excluído com sucesso!'
            ];
        } catch (\Exception $e) {
            return [
                'status'  => 'error',
                'msg'     => 'Erro ao processar! ' . $e->getMessage()
            ];
        }
    }

}
