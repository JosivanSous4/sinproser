<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{

    public $timestamps = false;
    
    protected $fillable = [
		'codigo_uf', 'estado', 'uf', 'regiao'
    ];
}