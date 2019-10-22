<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'produtos';
	protected $primaryKey 	= 'produto_id';
    protected $fillable = [
        'nome', 'descricao', 'valor_unitario'
    ];

    public function hasBens()
    {
        return $this->hasMany('App\Models\Bem', 'produto_id', 'produto_id');
    }
}