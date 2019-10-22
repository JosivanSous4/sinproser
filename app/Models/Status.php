<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public $table = 'status';
	
	public $timestamps = false;

    const ATIVO = 1;
    const INATIVO = 2; 
    const ABERTO = 3;
    const PAGO = 4;
    const DISPONIVEL = 5;
    const INDISPONIVEL = 6;
    const REMOVIDO = 7;


    protected $fillables = [
    	'nome', 'descricao'
    ];
}
