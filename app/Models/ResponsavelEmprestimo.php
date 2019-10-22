<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResponsavelEmprestimo extends Model
{
    protected $table 		= 'responsaveis_emprestimos';
    protected $primaryKey 	= 'responsavel_id';

    protected $fillable = ['nome_responsavel', 'cpf_responsavel', 'endereco_id'];

    public $timestamps = false;

    public function hasContatos()
    {
    	return $this->belongsToMany('App\Models\Contato', 'responsavel_contatos', 'responsavel_id', 'contato_id');
    }

    public function hasEndereco()
    {
    	return $this->belongsTo('App\Models\Endereco', 'endereco_id', 'endereco_id');
    }

}
