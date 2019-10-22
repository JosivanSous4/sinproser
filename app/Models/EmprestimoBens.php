<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmprestimoBens extends Model
{
    use SoftDeletes;

    protected $table 		= 'emprestimos_bens';
    protected $primaryKey 	= 'emprestimo_bem_id';

    protected $fillable = ['responsavel_id', 'data_prevista_devolucao', 'data_devolucao', 'bol_devolvido'];

    public function hasBens()
    {
        return $this->belongsToMany('App\Models\Bem', 'emprestimo_has_bens','emprestimo_bem_id', 'bem_id')->withPivot('emprestimo_bem_id', 'bem_id', 'bol_devolvido', 'data_devolucao');
    }

    public function hasResponsavel()
    {
        return $this->hasOne('App\Models\ResponsavelEmprestimo', 'responsavel_id', 'responsavel_id');
    }
}
