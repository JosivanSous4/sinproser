<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Site\Diretor;
use App\Models\Site\LinkUtil;
use App\Models\Site\Noticia;
use App\Models\Site\Sindicato;
use App\Repository\GenericRepository;
use App\Http\Requests\Site\ComentarioNoticiaFormRequest;
use Illuminate\Support\Facades\Mail;
use \DateTime;

class SiteController extends Controller
{
    public function index()
    {
        $data = new DateTime();
        $mesAtual = $data->format('Y-m-d');

        $data->modify('-10 month');
        $mesAnt = $data->format('Y-m-d');

        $comunicado = Noticia::with('hasUsuarioCriador')
                                ->where('bol_comunicado', 1)
                                ->where('bol_ativo', 1)
                                ->orderBy('created_at', 'desc')
                                ->first();
        
        $destaques = Noticia::with('hasUsuarioCriador')
                            ->where('bol_destaque', 1)
                            ->where('bol_ativo', 1);

        if (!empty($comunicado['noticia_id'])) {
            $destaques = $destaques->whereNotIn('noticia_id', [$comunicado['noticia_id']]);
        }

        $destaques = $destaques->orderBy('created_at', 'desc')
                               ->limit(5)
                               ->get();

        $i = 0;
        $idsNotIn[$i] = $comunicado['noticia_id'];
        
        foreach ($destaques as $destaque) {
            $idsNotIn[$i+1] = $destaque['noticia_id'];
        }
        
        $noticiasRecentes = Noticia::with('hasUsuarioCriador');

        if (!empty($idsNotIn)) {
            $noticiasRecentes = $noticiasRecentes->whereNotIn('noticia_id', $idsNotIn);
        }

        $noticiasRecentes = $noticiasRecentes->orderBy('created_at', 'desc')
                                             ->limit(4)
                                             ->get();

        return view('site.index', compact('comunicado', 'destaques', 'noticiasRecentes'));
    }

    public static function getInformacoesSindicato()
    {
        return Sindicato::with('hasContatos', 'hasEndereco.hasCidade.hasEstado')->first();
    }

    public function getLinksUteis()
    {
        $links = LinkUtil::orderBy('link_id', 'desc')->get();

        return view('site.linsks-uteis', compact('links'));
    }

    public function getNoticias()
    {
        $noticias = Noticia::with('hasUsuarioCriador')->where('bol_ativo', 1)->get();
        $postsPopulares = $this->getPostsPopulares();

        return view('site.noticias', compact('noticias', 'postsPopulares'));
    }

    public function getNoticia($noticia_id, $titulo)
    {
        $noticia = Noticia::find($noticia_id);
        $noticia->num_views += 1;
        $noticia->save();

        $data = new DateTime();
        $mesAtual = $data->format('Y-m-d');

        $data->modify('-10 month');
        $mesAnt = $data->format('Y-m-d');

        $postsPopulares = $this->getPostsPopulares();

        return view('site.noticia', compact('noticia', 'postsPopulares'));
    }

    public function getNoticiasRecentes()
    {
        return Noticia::with('hasUsuarioCriador')
                                 ->where('noticia_id', '<>', $noticia_id)
                                 ->whereBetween('created_at', [$mesAnt, $mesAtual])
                                 ->orderBy('created_at', 'desc')
                                 ->take(4)
                                 ->get();
    }

    public function getPostsPopulares()
    {
        $data = new DateTime();
        $mesAtual = $data->format('Y-m-d');

        $data->modify('-10 month');
        $mesAnt = $data->format('Y-m-d');
        
        return Noticia::with('hasUsuarioCriador')
                                ->whereBetween('created_at', [$mesAnt, $mesAtual])
                                ->orderBy('num_views', 'desc')
                                ->limit(4)
                                ->get();
    }

    public function getContato()
    {
        return view('site.contato');
    }

    public function getSobreNos()
    {
        $sindicato = Sindicato::with('hasContatos', 'hasEndereco')->first();

        return view('site.sobre-nos', compact('sindicato'));
    }

    public function getDiretoria()
    {
        $diretoria = Diretor::get();

        return view('site.diretoria', compact('diretoria'));
    }

    public function postEnviarComentario(ComentarioNoticiaFormRequest $request)
    {
        try {
            $email = $request->all();
            $noticia = Noticia::find($request->noticia_id);
            $email['titulo'] = $noticia->titulo;
            $email['noticia_id'] = $noticia->noticia_id;

            Mail::send('emails.comentario_publicacao_site', $email, function($message) use($email, $noticia){
                $assunto = 'Comentário sobre a notícia: "'. $noticia->titulo .'"';
                $message->to($email['email'])->subject($assunto);
                $message->from('contato@sinprosermucaru.com.br', $email['nome']);
            });
        } catch (\Exception $e) {
            return redirect()->back()->withError('Desculpe. Não foi possível enviar sua mensagem.');
        }

        return redirect()->back()->withSuccess('Mensagem enviada com sucesso!');
    }
} 