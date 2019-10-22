<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Model;

class Sindicato extends Model
{
    // public $timestamps = false;

    protected $table 		= 'sindicato';
    protected $primaryKey 	= 'sindicato_id';

	protected $fillable = [
        'sindicato_id', 'nome', 'descricao', 'foto', 'endereco_id'
    ];

    public function hasContatos()
    {
    	return $this->belongsToMany('App\Models\Contato', 'sindicato_has_contatos', 'sindicato_id', 'contato_id');
    }

    public function hasEndereco()
    {
        return $this->hasOne('App\Models\Endereco', 'endereco_id', 'endereco_id');
    }
}
