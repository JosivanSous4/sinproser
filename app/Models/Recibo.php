<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recibo extends Model
{
    protected $table = "recibos";
    protected $primaryKey = "recibo_id";
    
    protected $fillable = [
        'recibo_id', 'nome_receptor', 'data_emissao', 'motivo_emissao', 'valor', 'tipo_recibo_id', 'usuario_emissor_id'
    ];
}
