<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formacao extends Model
{
    protected $table 		= 'formacoes';
    protected $primaryKey 	= 'formacao_id';

    protected $fillable = ['associado_id', 'tipo_formacao_id', 'formacao', 'situacao_formacao'];

    public function hasTipoFormacao()
    {
        return $this->belongsTo('App\Models\TipoFormacao', 'tipo_formacao_id', 'tipo_formacao_id');
    }
}
