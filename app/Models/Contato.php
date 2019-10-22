<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    protected $table 		= 'contatos';
    protected $primaryKey 	= 'contato_id';
	
    protected $fillable = [
        'tipo', 'contato'
    ];
}
