<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserHasContato extends Model
{
    protected $table = "user_has_contatos";
    public $timestamps = false;
    // protected $primaryKey = "tipo_entrada_id";

    protected $fillable = [
        'user_id', 'contato_id'
    ];
}
