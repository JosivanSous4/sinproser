<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Classes;

use \App\Http\Interfaces\HtmlToPdf;
use App\Models\Associado;
use App\Models\DadosPessoais;
use DateTime;

/**
 * Description of ReciboPessoaFisicaServico
 *
 * @author Jesonilton Pontes
 */
class ReciboLocacaoPessoaFisica implements HtmlToPdf
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
        try{
            $pdf = \PDF::loadHtml($this->html);
            return $pdf->stream("Recibo " . $this->recibo->locatario->nome . " " . $this->recibo->dataEmissaoNum . "-" . date("U") . ".pdf");
    
        } catch(\Exceptions $ex) {
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
                                       <br>
                                       <center><h4>RECIBO</h4></center>
                                       <p class='recuo'>
                                           Eu, <b>{$this->recibo->presidente->nome}</b>, portador do CPF: {$this->recibo->presidente->cpf} e RG: {$this->recibo->presidente->rg}, venho por meio deste,
                                           declarar que recebi a quantia de <b>R$ {$this->recibo->valor}</b> de <b>{$this->recibo->locatario->nome}</b>, portador do CPF: <b>{$this->recibo->locatario->cpf}</b> e RG: <b>{$this->recibo->locatario->rg}</b>, 
                                           referente à aluguel do salão social do SINPROBEM (Sindicato dos Professores Municipais de Bom Jardim), sob CNPJ - 05.814.019/0001-95, 
                                           localizado à Rua Nova Brasília, Nº 22, Alto Dos Praxedes, Bom Jardim/MA, para a realização de <b>{$this->recibo->motivoEmissao}</b> a 
                                           ser realizado(a) no dia {$this->recibo->dataFesta->dia} de {$this->recibo->dataFesta->mes} de {$this->recibo->dataFesta->ano}.                                       
                                       </p>
                                       <p class='recuo'>
                                           E, para maior clareza, afirmo o presente recibo para que produza os seus efeitos dando plena, rasa e irrevogável
                                           quitação, pelo valor recebido.
                                       </p>
                                       <p>
                                       <center>Sem mais e para que este seja interpretado como verdadeito, firmo.</center>
                                       </p>
                                       <br>
                                       <p class='cidade_data'>
                                           Bom Jardim - MA, {$this->recibo->dataEmissao->dia} de {$this->recibo->dataEmissao->mes} de {$this->recibo->dataEmissao->ano}.
                                       </p>
                                   </div>
                                   <br>
                                   <div class='row'>
                                       <div class='col-p-3'></div>
                                       <center>___________________________________________<br>
                                                   {$this->recibo->presidente->nome}
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
                                           Eu, <b>{$this->recibo->presidente->nome}</b>, portador do CPF: {$this->recibo->presidente->cpf} e RG: {$this->recibo->presidente->rg}, venho por meio deste,
                                           declarar que recebi a quantia de <b>R$ {$this->recibo->valor}</b> de <b>{$this->recibo->locatario->nome}</b>, portador do CPF: <b>{$this->recibo->locatario->cpf}</b> e RG: <b>{$this->recibo->locatario->rg}</b>, 
                                           referente à aluguel do salão social do SINPROBEM (Sindicato dos Professores Municipais de Bom Jardim), sob CNPJ - 05.814.019/0001-95, 
                                           localizado à Rua Nova Brasília, Nº 22, Alto Dos Praxedes, Bom Jardim/MA, para a realização de <b>{$this->recibo->motivoEmissao}</b> a 
                                           ser realizado(a) no dia {$this->recibo->dataFesta->dia} de {$this->recibo->dataFesta->mes} de {$this->recibo->dataFesta->ano}.                                       
                                       </p>
                                       <p class='recuo'>
                                           E, para maior clareza, afirmo o presente recibo para que produza os seus efeitos dando plena, rasa e irrevogável
                                           quitação, pelo valor recebido.
                                       </p>
                                       <p>
                                       <center>Sem mais e para que este seja interpretado como verdadeito, firmo.</center>
                                       </p>
                                       <br>
                                       <p class='cidade_data'>
                                           Bom Jardim - MA, {$this->recibo->dataEmissao->dia} de {$this->recibo->dataEmissao->mes} de {$this->recibo->dataEmissao->ano}.
                                       </p>
                                   </div>
                                   <br>
                                   <div class='row'>
                                       <div class='col-p-3'></div>
                                       <center>___________________________________________<br>
                                                   {$this->recibo->presidente->nome}
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
        $presidente = $this->buscarPresidente();

        $this->recibo = (Object) [
                    'presidente' => (Object) [
                        'nome' => $presidente->hasDadosPessoais->nome,
                        'cpf' => DadosPessoais::mascara($presidente->hasDadosPessoais->cpf),
                        'rg' => $presidente->hasDadosPessoais->rg
                    ],
                    'locatario' => (Object) [
                        'nome' => $request->input('nome'),
                        'cpf' => $request->input('cpf'),
                        'rg' => $request->input('rg')
                    ],
                    'valor' => $request->input('valor'),
                    'motivoEmissao' => $request->input('motivo-emissao'),
                    'dataEmissao' => (Object) $this->getDataComoTexto($request->input('data-emissao')),
                    'dataFesta' => (Object) $this->getDataComoTexto(DateTime::createFromFormat('Y-m-d', $request->input('data-locacao'))->format('d-m-Y')),
                    'dataEmissaoNum' => $request->input('data-emissao')
        ];
        
    }

    private function buscarPresidente()
    {
        return Associado::with('hasDadosPessoais')->where("bolpresidente", 1)->first();
    }

}
