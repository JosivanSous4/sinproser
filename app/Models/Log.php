<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'logs';
    protected $primaryKey = 'log_id';
    protected $fillable = ['menu', 'descricao_operacao', 'status', 'dados', 'usuario_id'];

    const ERRO = 'ERRO';
    const SUCESSO = 'SUCESSO';
    const PERIGO = 'PERIGO';
    const INFORMACAO = 'INFORMACAO';


    public static function erro($menu, $descricao_operacao, $dados, $usuario_id)
    {
    	self::registrar($menu, $descricao_operacao, self::ERRO, $dados, $usuario_id);
    }

    public static function sucesso($menu, $descricao_operacao, $dados, $usuario_id)
    {
    	self::registrar($menu, $descricao_operacao, self::SUCESSO, $dados, $usuario_id);
    }

    public static function perigo($menu, $descricao_operacao, $dados, $usuario_id)
    {
    	self::registrar($menu, $descricao_operacao, self::PERIGO, $dados, $usuario_id);
    }

    public static function informacao($menu, $descricao_operacao, $dados, $usuario_id)
    {
    	self::registrar($menu, $descricao_operacao, self::INFORMACAO, $dados, $usuario_id);
    }

    public static function registrar($menu, $descricao_operacao, $status, $dados, $usuario_id)
    {
		self::create([
			'menu' => $menu, 
			'descricao_operacao' => $descricao_operacao, 
			'status' => $status,
			'dados' => $dados, 
			'usuario_id' => $usuario_id
		]);
    }
}
