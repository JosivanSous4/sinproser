<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    protected $table = 'noticias';
    protected $primaryKey 	= 'noticia_id';

    protected $fillable = [
        'titulo', 'imagem_capa', 'conteudo', 'descricao_rapida', 'num_views', 'bol_comunicado', 'bol_destaque', 'bol_ativo', 'usuario_criador_id'
    ];


    public function hasUsuarioCriador()
    {
        return $this->belongsTo('App\Models\User', 'usuario_criador_id', 'user_id')->select('user_id', 'name', 'dados_pessoais_id');
    }
}
