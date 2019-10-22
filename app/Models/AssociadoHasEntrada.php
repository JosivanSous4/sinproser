<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssociadoHasEntrada extends Model
{
    protected $table = "associados_has_entradas";
    // protected $primaryKey = "saida_id";

    protected $fillable = [
        'associado_id', 'entrada_id', 'data_repasse', 'deleted_at'
    ];

    public function hasAssociados(){
        return $this->hasOne('App\Models\Associado', 'associado_id', 'associado_id');
    }

}
