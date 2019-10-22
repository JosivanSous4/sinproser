<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    const RECIBO_ENTRADA = 1, RECIBO_SAIDA = 2;

    protected $primaryKey 	= 'documento_id';

    protected $fillable = [
        'documento_id', 'nome', 'template_documento', 'status_id', 'usuario_id',
    ];
}