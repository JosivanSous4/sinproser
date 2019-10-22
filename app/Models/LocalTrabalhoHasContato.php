<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocalTrabalhoHasContato extends Model
{
    protected $primaryKey 	= 'local_de_trabalho_has_contatos';

    protected $fillable = [
        'local_de_trabalho_id', 'contato_id'
    ];
}
