<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $table 		= 'perfis';
    protected $primaryKey 	= 'perfil_id';

    protected $fillables = ['nome', 'descricao'];
}
