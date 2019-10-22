<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DadosFuncionais extends Model
{
    protected $table 		= 'dados_funcionais';
    protected $primaryKey 	= 'dado_funcional_id';

    protected $fillable = ['data_admissao', 'pis_pasep', 'portaria'];
}
