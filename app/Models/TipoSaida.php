<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoSaida extends Model
{
   
    protected $table = "tipos_saida";
    protected $primaryKey = "tipo_saida_id";
    
    protected $fillable = [
        'tipo_saida_id', 'nome', 'descricao'
    ];
}
