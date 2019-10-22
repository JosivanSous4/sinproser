<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

        <!-- <link href="{{asset('/assets/css/style.print.css')}}" rel="stylesheet" type="text/css" /> -->

        <title>SINPROSERMUCARU | Carteirinha(s) de associado</title>

        <style type="text/css">
            .container-carteira {
                min-height: 230px;
                height: 201px;
                font-family: Helvetica;
            }

            .container-carteira-fake {
                min-height: 220px;
                font-family: Helvetica;
            }

            .carteira {
                width: 340px;
                height: 200px;
                text-align:center;
            }

            /*FRENTE DA CARTEIRA*/
            #carteira_frente {
                position: absolute;
            }

            .carteira_frente {
                /*background-image: url("{{asset('/assets/img/carteira_frente.png')}}");*/
                background-repeat: no-repeat;
            }

            /*TOPO DA CARTEIRA*/
            .carteira_frente .carteira_topo {
                text-align: center;
                padding-left: 10px;
                padding-right: 10px;
            }

            .carteira_frente .carteira_topo .nome{
                margin-top: 16px;
                font-size: 16px;
                height: 30px;
                font-weight: bold;
            }

            .carteira_frente .carteira_topo .barra{
                width: 320px;
                margin: 0 auto;

                margin-top: 10px;
                padding: 2px;

                font-family: "arial";
               
            }

            .carteira_frente .carteira_topo h6{
                width: 320px;
                margin: 0 auto;

                margin-top: 15px;
                padding: 2px;

                font-family: "arial";

                border-radius: 3px;

                color: #ffffff;
                background-color: #CCB48B;
            }
            /*FIM TOPO*/

            /*CORPO DA CARTEIRA*/
            .carteira_body {
                margin-top: -5px;

            }

            .carteira_frente .carteira_body .foto_associado{
                background-color: #eee;
                margin-top: 20px;
                margin-left: 10px;
                border-radius: 5px;

                width: 105px;
                height: 105px;
            }

            .carteira_frente .carteira_body .foto_associado > img{
                border-radius: 5px;
                width: 105px;
                height: 105px;
            }

            .carteira_frente .carteira_body .dados_associado {
                width: 220px;
                height: 95px;

                margin-left: 120px;
                margin-right: 10px;
                margin-top: -115px;

                padding-top: 5px;

                border-radius: 4px;
                position: absolute;
                font-size: 12px;
            }

            .carteira_frente .carteira_body .dados_associado .funcao{
                text-align: left;
                margin-left: 5px;
            }

            .carteira_frente .carteira_body .dados_associado .dado{
                color: #FAAB33;
            }


            .carteira_frente .carteira_body .dados_associado .dados_pessoais {
                text-align: left;
                margin-left: 5px;
                margin-top: 2px;
                color: #000;
            }

            .carteira_frente .carteira_body .dados_associado .dados_pessoais > .dados-esquerda {
                width: 130px;
                float: left;
            }

            .carteira_frente .carteira_body .dados_associado .dados_pessoais > .dados-direira {
                float: left;
                width: 130px;
                margin-left: 100px;
                margin-top: -41px;
            }

            .carteira_frente .carteira_body .dados_associado .dados_pessoais strong {
                color: #000;
            }

            .linha1 {
                padding: 7px 0px;
            }

            .pis_pasep {
                position: absolute;
                font-size: 8pt;
                margin-top: 10px;
                margin-left: 182px;
                color: #fff;
            }
            /*FIM FRENTE DA CARTEIRA*/


            /*COSTA DA CARTEIRA*/
            #carteira_costa {
                position: absolute;
                margin-top: 0px;
                margin-left: 370px;
            }

            .logo-costa {
                position: absolute;
                margin-top: 40px;
                margin-left: -135px;
                width: 230px;
            }

            .cnpj-costa {
                position: absolute;
                margin-top: 10px;
                margin-left: 120px;
                width: 6px;
            }

            .carteira_costa {
                /*background-image: url("{{asset('/assets/img/carteira_costa.png')}}");*/
                color: rgba(0,0,0,0.5);
                font-size: 9pt;
                width: 402px;
                height: 202px;
                margin-top: -10px;  
            }

            .carteira_costa .img-endereco {
                margin-top: 139px;
                margin-left: 18px;
                position: absolute;
            }

            .carteira_costa .img-endereco img{
                width: 125px;
            }

            .carteira_costa .emissao {
                position: absolute;
                margin-top: 168px;
                margin-left: 15px; 
                font-size: 8pt;
                color: #fff;
            }

            .emissao{
                position: absolute;
                margin-top: 100px;
                margin-left: 150px;
            }

            .contatos{
                position: absolute;
                margin-top: 156px;
                margin-left: 178px;
                text-align: right;  
                font-size: 8pt;
                color: #fff;
            }

            .qr_code {
                position: absolute;
                margin-top: 125px;
                margin-left: 10px;
                width: 50px;
            }

            .page-break {
                page-break-after: always;
            }

            .txt {
                position: absolute;
                text-align: center;
                margin-top: 400px;
            }
            
            .fundo-carteira {
                margin-top: -20px;
                z-index: 0001;
            }

            .quebra-pagina {
                page-break-after: always;
            }

        </style>
    </head>
    <body>
        <div class="container-fluid">
            @foreach ($associados as $index => $associado)
                @if(($index % 4) == 0 && $index != 0)
                    <div class="row form-group container-carteira-fake"></div>
                @endif
                <div class="row form-group container-carteira">
                    <div id="carteira_frente" class="carteira " style="z-index: 200">
                        <div class="col-md-3"></div><!--apenas para centralizar a imagem-->
                        <div class="col-md-5 carteira carteira_frente">
                            <div class="row">
                                <div class="carteira_topo">
                                    <div class="row nome"><strong> {{$associado->hasDadosPessoais->nome}}</strong></div>
                                </div>
                            </div>
                            <div class="carteira_body row">
                                <div class="foto_associado">
                                    <img src="{{ asset('storage/uploads/' . $associado->foto) }}">
                                </div>
                                <div class="dados_associado">
                                    <div class="row funcao">
                                        <small>Função:</small> <br><span class="dado">{{ $associado->bool_professor? 'Professor' : 'Servidor Público Municipal' }}</span>
                                    </div>
                                    <div class="row dados_pessoais inline">
                                        <div class="form-horizontal dados-esquerda">
                                            <div class="cpf linha1">
                                                <small>CPF:</small> <span class="dado"><br>{{ $associado->hasDadosPessoais->cpf }}</span>
                                            </div>
                                        </div>
                                        <div class="form-horizontal dados-direira">
                                            <div class="rg linha1">
                                                <small>RG:</small><br><span class="dado"> {{ $associado->hasDadosPessoais->rg }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pis_pasep">
                                    PIS/PASEP: <span class="dado">{{ $associado->hasDadosFuncionais->pis_pasep }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3"></div><!-- apenas para centralizar a imagem -->
                    </div>
                    <br>
                    <div id="carteira_costa" class="carteira" style="z-index: 200">
                        <div class="col-md-5 carteira carteira_costa">
                            <div class="footer">
                                <!-- <div class="img-endereco">
                                    <img src="{{--asset('assets/img/carteira_endereco.png')--}}">
                                </div> -->
                                <div class="emissao">Emissão: {{date('d/m/Y', strtotime($associado->hasCarteirinha->data_emissao))}}</div>
                                <!-- DATA ATUAL -->
                                <div class="contatos">
                                    Contatos: 
                                    <span>(98) 3657-1215</span><br>
                                    <span>sinprosermucaru@hotmail.com</span>
                                </div>

                                <div class="qr_code">
                                    <img width="40px" src="{{asset('/assets/img/qr_code_carteirinha.png')}}">
                                </div>
                            </div>
                            <div>
                                <img class="logo-costa" src="{{asset('assets/img/logo_carteira_costa.png')}}">
                                <img class="cnpj-costa" src="{{asset('assets/img/cnpj.png')}}">
                            </div>
                        </div>
                        <div class="col-md-3"></div>
                    </div>

                    <div class="fundo-carteira">
                        <div id="carteira_frente" class="carteira " style="z-index: 1">
                            <img class="carteira" src="{{asset('/assets/img/carteira_frente.png')}}">
                        </div>
                        <div id="carteira_costa" class="carteira" style="z-index: 1">
                            <img class="carteira" src="{{asset('/assets/img/carteira_costa.png')}}">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </body>
</html>
