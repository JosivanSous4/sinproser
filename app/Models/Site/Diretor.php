<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Model;

class Diretor extends Model
{
    protected $table 		= 'diretores';
    protected $primaryKey 	= 'diretor_id';

	protected $fillable = [
        'diretor_id', 'nome', 'foto', 'cargo'
    ];

}