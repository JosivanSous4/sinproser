<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table        = 'users';
    protected $primaryKey   = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'dados_pessoais_id', 'perfil_id', 'associado_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function hasDadosPessoais()
    {
        return $this->hasOne('App\Models\DadosPessoais', 'dados_pessoais_id', 'dados_pessoais_id');
    }

    public function hasDadosDeAssociado()
    {
        return $this->hasOne('App\Models\Associado', 'associado_id', 'associado_id');
    }

    public function hasPerfil()
    {
        return $this->hasOne('App\Models\Perfil', 'perfil_id', 'perfil_id');
    }

    public function hasContatos()
    {
    	return $this->belongsToMany('App\Models\Contato', 'user_has_contatos', 'user_id', 'contato_id');
    }
}
