<?php

namespace App\Http\Controllers\Site;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Site\Parceiro;
use App\Models\Site\Noticia;
use App\Models\Site\Diretor;
use App\Models\Site\LinkUtil;
use \DB;


class ApiController extends Controller
{
    public function getParceiros()
    {
        $query = Parceiro::where('deleted_at', null)
                    ->orderBy('nome');

        $parceiros = $query->paginate(20);

        return $parceiros;
    }

    public function getNoticias()
    {
    	$notitias = Noticia::all();
    	$notitias = $notitias->map(function($noticia){
    					return (Object)[
    						'noticia_id' 		=> $noticia->noticia_id,
    						'titulo' 			=> $noticia->titulo,
    						'imagem_capa' 		=> $noticia->imagem_capa,
    						'descricao_rapida' 	=> $noticia->descricao_rapida,
    						'destaque' 			=> $noticia->bol_destaque? 'Destacada na posição '.$noticia->posicao_destaque : 'Não destacada',
    						'dt_criacao' 		=> $noticia->created_at->format('d/m/Y')
    					];
    				});

    	return json_encode($notitias);
    }

    public function getDiretores()
    {
        $query = Diretor::where('deleted_at', null)
                    ->orderBy('nome');

        $diretores = $query->paginate(20);

        return $diretores;
    }

    public function getLinkUtil()
    {
        $query = LinkUtil::where('deleted_at', null)
                    ->orderBy('destino');

        $links = $query->paginate(20);

        return $links;
    }

}
