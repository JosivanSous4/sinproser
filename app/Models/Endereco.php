<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{

    protected $table 		= 'enderecos';
    protected $primaryKey 	= 'endereco_id';

    protected $fillable = [
        'zona', 'cidade_id', 'bairro', 'rua', 'numero_residencia', 'complemento', 'cep'
    ];

    public function hasCidade()
    {
    	return $this->belongsTo('App\Models\Cidade', 'cidade_id', 'cidade_id');
    }
}