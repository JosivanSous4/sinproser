<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Classes;
use App\Models\Associado;
use App\Models\Usuario;
use App\Models\Carteira;

/**
 * Description of ReciboPessoaFisicaServico
 *
 * @author Jesonilton Pontes
 */
class Auxiliar
{
    static public function gerarHash($id)
    {
        // Geracao do token
        $hash = sha1(uniqid($id . mt_rand(), true));
        $hash = substr($hash, 0, 8);
        // return $hash;
        // Lista de usuarios para verificacao de unicidade do token
        $associadoParaVerificacao = Associado::where('id_hash', $hash)->first();
        $usuarioParaVerificacao   = Usuario::where('id_hash', $hash)->first();
        $carteiraParaVerificacao  = Carteira::where('id_hash', $hash)->first();

        $retorno = false;

        if ($associadoParaVerificacao && $usuarioParaVerificacao && $carteiraParaVerificacao) {
            self::gerarHash($id);
        }

        return $hash;
    }
}
