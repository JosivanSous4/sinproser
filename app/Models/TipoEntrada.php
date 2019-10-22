<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoEntrada extends Model
{
    protected $table = "tipo_entrada";
    protected $primaryKey = "tipo_entrada_id";
    
    protected $fillable = [
        'tipo_entrada_id', 'nome', 'descricao'
    ];
}
