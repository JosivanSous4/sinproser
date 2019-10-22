<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carteirinha extends Model
{
    protected $table 		= 'carteirinhas';
    protected $primaryKey 	= 'carteirinha_id';

    protected $fillable = ['data_emissao'];

    public function getQtdCarteirinhasNaoImpressas()
    {
    	return $this->where('bol_impresso', false)->count();
    }

    public function getQtdCarteirinhasImpressas()
    {
    	return $this->where('bol_impresso', true)->count();
    }

}
