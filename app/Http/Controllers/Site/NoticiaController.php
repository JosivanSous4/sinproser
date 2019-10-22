<?php

namespace App\Http\Controllers\Site;
use App\Http\Controllers\Controller;

use Auth;
use Illuminate\Http\Request;
use App\Models\Site\Noticia;
use App\Repository\GenericRepository;
use App\Http\Requests\NoticiaFormRequest;

class NoticiaController extends Controller
{
    public function getNoticia($noticia_id, $titulo)
    {
        $noticia = Noticia::find($noticia_id);

        return view('site.noticia', compact('noticia'));
    }

    public function getNoticias()
    {
        return view('configuracoes.site.noticias.noticias');
    }

    public function getCriarNoticia()
    {
        return view('configuracoes.site.noticias.criar_noticia');
    }

    public function postCriarNoticia(NoticiaFormRequest $request)
    {
        try {
            $noticia = $request->all();

            $noticia['imagem_capa'] = GenericRepository::upload($request->file('imagem_capa'));
            $noticia['usuario_criador_id'] = Auth::user()->user_id;

            Noticia::create($noticia);

            return ['msg' => 'Noticia publicada com sucesso' , 'status' =>'success'];
        } catch (Exception $e) {
            return ['msg' => 'Não foi possível publicar notícia', 'status' =>'error'];
        }
    }

    public function getEditarNoticia($noticia_id)
    {
        $noticia = Noticia::find($noticia_id);

        return view('configuracoes.site.noticias.editar_noticia', compact('noticia'));
    }

    public function postEditarNoticia(NoticiaFormRequest $request)
    {
        try {
            $noticia = Noticia::find($request->noticia_id);
            $noticia->update($request->all());

            return ['msg' => 'Noticia editada com sucesso' , 'status' =>'success'];
        } catch (Exception $e) {
            return ['msg' => 'Não foi possível editar notícia', 'status' =>'error'];
        }
    }
}
