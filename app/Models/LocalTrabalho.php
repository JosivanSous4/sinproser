<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LocalTrabalho extends Model
{

    use SoftDeletes;

    protected $table 		= 'locais_de_trabalho';
    protected $primaryKey 	= 'local_de_trabalho_id';

    protected $fillable = [
        'nome', 'descricao', 'endereco_id', 'usuario_criador_id'
    ];

    public function hasEndereco()
    {
    	return $this->belongsTo('App\Models\Endereco', 'endereco_id', 'endereco_id');
    }

    public function hasContatos()
    {
    	return $this->belongsToMany('App\Models\Contato', 'local_de_trabalho_has_contatos', 'local_de_trabalho_id', 'contato_id');
    }

    public function getStrLocalTrabalho()
    {
        $localTrabalho = '<strong>'.$this->nome .'</strong>, rua '. 
                        $this->hasEndereco->rua . ', Numero '.
                        $this->hasEndereco->numero_residencia . ', '.               
                        $this->hasEndereco->bairro . ', '.               
                        $this->hasEndereco->hasCidade->cidade . '-'.
                        $this->hasEndereco->hasCidade->hasEstado->uf;

        return $localTrabalho;
    }

    public function getQuery()
    {
        return $this->with('hasEndereco', 'hasContatos');
    }
}
