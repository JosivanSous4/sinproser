<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Model;

class Parceiro extends Model
{
    protected $table 		= 'parceiros';
    protected $primaryKey 	= 'parceiro_id';

	protected $fillable = ['parceiro_id', 'nome', 'foto', 'descricao', 'endereco_id'];

    public function hasContatos()
    {
    	return $this->belongsToMany('App\Models\Contato', 'parceiro_has_contatos', 'parceiro_id', 'contato_id');
    }

    public function hasEndereco()
    {
        return $this->hasOne('App\Models\Endereco', 'endereco_id', 'endereco_id');
    }
}
