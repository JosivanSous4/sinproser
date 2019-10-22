<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
    	'estado_id', 'codigo_ibge', 'cidade',
    ];

    public function hasEstado()
    {
        return $this->hasOne('App\Models\Estado', 'estado_id', 'estado_id');
    }
}
