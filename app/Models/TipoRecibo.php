<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoRecibo extends Model
{
    protected $table = "tipos_recibo";
    protected $primaryKey = "tipo_recibo_id";

    protected $fillable = [
        'tipo_recibo_id', 'nome', 'descricao'
    ];
}
