<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AreaAtuacao extends Model
{
    protected $table 		= 'areas_atuacao';
    protected $primaryKey 	= 'area_atuacao_id';

	protected $fillable = ['nome', 'dia_previsto_pagamento', 'descricao', 'usuario_criador_id'];

    public function hasUsuarioCriador()
    {
        return $this->belongsTo('App\Models\User', 'usuario_criador_id', 'user_id')->select('user_id', 'name');
    }
}
