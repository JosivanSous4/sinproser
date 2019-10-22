<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DadosPessoais extends Model
{
    protected $table 		= 'dados_pessoais';
    protected $primaryKey 	= 'dados_pessoais_id';

    protected $fillable = ['nome', 'sexo', 'rg', 'data_emissao_rg', 'orgao_emissor_rg', 'cpf', 'estado_civil', 'data_nascimento'];

    public function getNomeParaUrl(){
        $nome = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"), explode(" ","a A e E i I o O u U n N"), $this->nome);
        return str_replace(' ', '-', strtolower($nome));
    }


    public function hasAssociado()
    {
        return $this->hasOne('App\Models\Associado', 'dados_pessoais_id', 'dados_pessoais_id');
    }

    public static function formatarCpf($cpf)
    {
        $mascara = "###.###.###-##";
        $maskared = '';
        $k = 0;
        for($i = 0; $i<=strlen($mascara)-1; $i++)
        {
            if($mascara[$i] == '#')
            {
                if(isset($cpf[$k]))
                $maskared .= $cpf[$k++];
            }
            else
            {
                if(isset($mascara[$i]))
                $maskared .= $mascara[$i];
            }
        }
        return $maskared;
    }
}
