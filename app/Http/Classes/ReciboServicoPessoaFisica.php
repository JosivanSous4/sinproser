<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Classes;

use \App\Http\Interfaces\HtmlToPdf;

/**
 * Description of ReciboPessoaFisicaServico
 *
 * @author Jesonilton Pontes
 */
class ReciboServicoPessoaFisica implements HtmlToPdf
{

    use \App\Models\Traits\DateAsText;

    private $fundoRecibo;
    private $html;
    private $recibo;

    public function __construct($request)
    {
        $this->fundoRecibo = asset('assets/img/fundo_recibo.png');
        $this->prepare($request);
        $this->generateHtml();

        return $this->html;
    }

    public function generatePdf()
    {
        try {
            $pdf = \PDF::loadHtml($this->html);
            return $pdf->stream("Recibo " . $this->recibo->portador->nome . " " . $this->recibo->dataEmissaoNum . "-" . date("U") . ".pdf");
        } catch (\Exception $ex) {
            return null;
        }
    }

    private function generateHtml()
    {
        $this->html = "<!DOCTYPE html>
               <html>
                   <head>
                       <meta charset='utf-8'>
                       <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

                       <link rel='stylesheet' type='text/css' href='{{asset('assets/global/plugins/bootstrap/css/bootstrap.min.css')}}'>
                       <link rel='stylesheet' type='text/css' href='css/css-print.css'>

                       <title>SINPROBEM | Recibo</title>

                       <style type='text/css'>
                           .recuo {
                               text-indent: 60px;
                           }
                           .text-center{
                               text-align: center;
                           }
                           .img_fundo {
                               position: absolute;
                               margin-top: 50px;
                               /* margin-left: 15% */
                           }

                           .assinatura {
                               border-top: 1px solid black;
                           }

                           p {
                               text-align: justify;
                           }

                           .cidade_data {
                               text-align: right;
                           }
                       </style>
                   </head>
                   <body>
                       <div class='container' style='padding-left:40px; padding-right:40px;'>
                           <div class='row'>
                               <div class='col-md-3 col-xs-1 col-p-1'></div>
                               <div class='col-md-7 col-xs-9 col-p-10'>
                                   <div class='row'>
                                       <center>
                                           <img src='{$this->fundoRecibo}' width='100%' class='img_fundo'>
                                       </center>
                                       <center><h4>RECIBO</h4></center>
                                       <p class='recuo'>
                                           Eu, {$this->recibo->portador->nome}, portador do CPF: <b>{$this->recibo->portador->cpf}</b> e RG: <b>{$this->recibo->portador->rg}</b>, venho por meio deste,
                                           declarar que recebi a quantia de <b>R$ {$this->recibo->valor}</b>, do <b>SINDICATO DOS PROFESSORES MUNICIPAIS DE BOM JARDIM/MA - SINPROBEM, </b>
                                           sob CNPJ - <b>05.814.019/0001-95</b>, localizado à Rua Nova Brasília, Nº 22, Alto Dos Praxedes, Bom Jardim/MA, valor Referente a {$this->recibo->motivoEmissao}.
                                       </p>
                                       <p class='recuo'>
                                           E, para maior clareza, afirmo o presente recibo para que produza os seus efeitos dando plena, rasa e irrevogável
                                           quitação, pelo valor recebido.
                                       </p>
                                       <p>
                                       <center>Sem mais e para que este seja interpretado como verdadeito, firmo.</center>
                                       </p>
                                       <p class='cidade_data'>
                                           Bom Jardim - MA, {$this->recibo->dataEmissao->dia} de {$this->recibo->dataEmissao->mes} de {$this->recibo->dataEmissao->ano}.
                                       </p>
                                   </div>
                                   <br>
                                   <div class='row' >
                                       <div class='col-p-3'></div>
                                       <center>___________________________________________<br>
                                                   {$this->recibo->portador->nome}
                                       </center>
                                       <div class='col-p-3'></div>
                                   </div>
                               </div>
                               <div class='col-md-2 col-xs-1 col-p-1'></div>
                           </div>
                           
                          <div class='row' style='margin-top: 100px;'>
                               <div class='col-md-3 col-xs-1 col-p-1'></div>
                               <div class='col-md-7 col-xs-9 col-p-10'>
                                   <div class='row'>
                                       <center>
                                           <img src='{$this->fundoRecibo}' width='100%' class='img_fundo'>
                                       </center>
                                       <center><h4>RECIBO</h4></center>
                                       <p class='recuo'>
                                           Eu, {$this->recibo->portador->nome}, portador do CPF: <b>{$this->recibo->portador->cpf}</b> e RG: <b>{$this->recibo->portador->rg}</b>, venho por meio deste,
                                           declarar que recebi a quantia de <b>R$ {$this->recibo->valor}</b>, do <b>SINDICATO DOS PROFESSORES MUNICIPAIS DE BOM JARDIM/MA - SINPROBEM, </b>
                                           sob CNPJ - <b>05.814.019/0001-95</b>, localizado à Rua Nova Brasília, Nº 22, Alto Dos Praxedes, Bom Jardim/MA, valor Referente a {$this->recibo->motivoEmissao}.
                                       </p>
                                       <p class='recuo'>
                                           E, para maior clareza, afirmo o presente recibo para que produza os seus efeitos dando plena, rasa e irrevogável
                                           quitação, pelo valor recebido.
                                       </p>
                                       <p>
                                       <center>Sem mais e para que este seja interpretado como verdadeito, firmo.</center>
                                       </p>
                                       <p class='cidade_data'>
                                           Bom Jardim - MA, {$this->recibo->dataEmissao->dia} de {$this->recibo->dataEmissao->mes} de {$this->recibo->dataEmissao->ano}.
                                       </p>
                                   </div>
                                   <br>
                                   <div class='row' >
                                       <div class='col-p-3'></div>
                                       <center>___________________________________________<br>
                                                   {$this->recibo->portador->nome}
                                       </center>
                                       <div class='col-p-3'></div>
                                   </div>
                               </div>
                               <div class='col-md-2 col-xs-1 col-p-1'></div>
                           </div>
                       </div>
                   </body>
               </html>";
    }

    private function prepare($request)
    {
        $this->recibo = (Object) [
                    'portador' => (Object) $request->only('nome', 'cpf', 'rg'),
                    'valor' => $request->input('valor'),
                    'motivoEmissao' => $request->input('motivo-emissao'),
                    'dataEmissao' => $this->getDataComoTexto($request->input('data-emissao')),
                    'dataEmissaoNum' => $request->input('data-emissao')
        ];
    }

}
