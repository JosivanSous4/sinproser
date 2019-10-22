<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Associado extends Model
{
    use SoftDeletes;

    protected $primaryKey 	= 'associado_id';
    
    protected $fillable = [
        'data_associacao', 'foto', 'bool_professor', 'bol_presidente', 'bol_inadimplente', 'grau_instrucao_id', 'dados_funcionais_id', 'tipo_pagamento_id', 'endereco_id' , 'area_atuacao_id', 'salario','dados_pessoais_id', 'carteirinha_id', 'status_id', 'usuario_criador_id'
    ];

    public function hasEndereco()
    {
    	return $this->belongsTo('App\Models\Endereco', 'endereco_id', 'endereco_id');
    }

    public function hasContatos()
    {
    	return $this->belongsToMany('App\Models\Contato', 'associado_has_contatos', 'associado_id', 'contato_id');
    }

    public function hasFormacoes()
    {
        return $this->hasMany('App\Models\Formacao', 'associado_id', 'associado_id');
    }

    public function hasGrauInstrucao()
    {
        return $this->belongsTo('App\Models\GrauInstrucao', 'grau_instrucao_id', 'grau_instrucao_id');
    }

    public function hasDadosFuncionais()
    {
        return $this->belongsTo('App\Models\DadosFuncionais', 'dados_funcionais_id', 'dado_funcional_id');
    }

    public function hasTipoPagamento()
    {
        return $this->belongsTo('App\Models\TipoPagamento', 'tipo_pagamento_id', 'tipo_pagamento_id');
    }

    public function hasAreaAtuacao()
    {
        return $this->belongsTo('App\Models\AreaAtuacao', 'area_atuacao_id', 'area_atuacao_id');
    }

    public function hasDadosPessoais()
    {
        return $this->hasOne('App\Models\DadosPessoais', 'dados_pessoais_id', 'dados_pessoais_id');
    }

    public function hasCarteirinha()
    {
        return $this->belongsTo('App\Models\Carteirinha', 'carteirinha_id', 'carteirinha_id');
    }

    public function hasStatus()
    {
        return $this->belongsTo('App\Models\Status', 'status_id', 'status_id');
    }

    public function hasUsuarioCriador()
    {
        return $this->belongsTo('App\Models\User', 'usuario_criador_id', 'user_id')->select('user_id', 'name', 'dados_pessoais_id');
    }

    public function hasLocalTrabalho()
    {
        return $this->belongsToMany('App\Models\LocalTrabalho', 'associados_has_locais_de_trabalho', 'associado_id', 'local_de_trabalho_id')->withPivot('associado_local_de_trabalho_id','associado_id','local_de_trabalho_id','funcao','matricula','data_vinculacao');
    }

    public static function mask($val, $mask)
    {
        $maskared = '';
        $k = 0;
        for($i = 0; $i <= strlen($mask)-1; $i++){
            if($mask[$i] == '#'){
                if(isset($val[$k]))
                    $maskared .= $val[$k++];
            } else {
                if(isset($mask[$i]))
                    $maskared .= $mask[$i];
            }
        }

        return $maskared;
    }

    public function hasEntradas()
    {
        return $this->belongsToMany('App\Models\Entrada', 'associados_has_entradas','associado_id', 'entrada_id');
    }
}
