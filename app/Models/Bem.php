<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bem extends Model
{
    protected $table = 'bens';
    protected $primaryKey = 'bem_id';

    protected $fillable = [
        'data_aquisicao', 'produto_id', 'status_id'
    ];

    public function hasProduto()
    {
        return $this->belongsTo('App\Models\Produto', 'produto_id', 'produto_id');
    }


    public function hasStatus()
    {
        return $this->hasOne('App\Models\Status', 'status_id', 'status_id');
    }
}
