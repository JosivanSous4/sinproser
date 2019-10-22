<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoFormacao extends Model
{
    protected $table = 'tipos_formacoes';
    protected $primaryKey 	= 'tipo_formacao_id';
    
    protected $fillable = ['nome', 'descricao'];
}
