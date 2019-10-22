<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssociadoHasLocalTrabalho extends Model
{
    protected $table 		= 'associados_has_locais_de_trabalho';
    protected $primaryKey 	= 'associado_local_de_trabalho_id';

    protected $fillable = ['associado_id', 'local_de_trabalho_id', 'funcao', 'matricula', 'data_vinculacao'];

    public $timestamps = false;
}
