<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Saida extends Model
{
    protected $table = "saidas";
    protected $primaryKey = "saida_id";

    protected $fillable = [
        'saida_id', 'beneficiario', 'descricao', 'valor', 'data_saida','tipo_saida_id', 'usuario_criador_id', 'recibo_id'
    ];

    public function hasTipoSaida()
    {
        return $this->hasOne('App\Models\TipoSaida', 'tipo_saida_id', 'tipo_saida_id');
    }
}
