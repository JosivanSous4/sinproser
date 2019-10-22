<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Classes;

use \App\Http\Interfaces\HtmlToPdf;
use App\Models\Associado;
use App\Models\Carteirinha;
use App\Models\DadosPessoais;
use PDF;

/**
 * Description of ReciboPessoaFisicaServico
 *
 * @author Jesonilton Pontes
 */
class CarteiraPDF implements HtmlToPdf
{

    private $carteira;
    private $associados;

    public function __construct($associados_ids, $bool_registrar = false)
    {
        $this->prepare($associados_ids, $bool_registrar);
    }

    public function generatePdf()
    {
        $associados = $this->associados;

        $associados->map(function($associado){
            $associado->hasDadosPessoais->cpf = Associado::mask($associado->hasDadosPessoais->cpf, '###.###.###-##');
        });

        return view('carteirinha.carteirinha_print', compact('associados'));
    }

    private function prepare($associados_ids, $bool_registrar)
    {
        $associados = Associado::whereIn('associado_id', $associados_ids)->get();

        if($bool_registrar) {

            foreach ($associados as $key => $associado) {
                $carteira = $associado->hasCarteirinha()->first();

                if(is_null($carteira)){
                    $carteira = new Carteirinha();
                } else {
                    $carteira->bol_segunda_via = true;
                }

                $carteira->data_emissao = date('Y-m-d H:i:s');
                $carteira->save();

                $associado->carteirinha_id = $carteira->carteirinha_id;
                $associado->save();
            }

        }
            
        $this->associados = Associado::with('hasDadosPessoais', 'hasDadosFuncionais', 'hasCarteirinha')->whereIn('associado_id', $associados_ids)->get();;
    }

}
