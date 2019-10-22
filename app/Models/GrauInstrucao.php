<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GrauInstrucao extends Model
{
    protected $table 		= 'graus_instrucao';
    protected $primaryKey 	= 'grau_instrucao_id';

    protected $fillables = ['nome', 'descricao'];
}
