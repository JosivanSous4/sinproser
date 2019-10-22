<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">

	<title>
		SINPROSERMUCARU | @yield('title')</title>
	</title>

    <link href="{{asset('assets/global/plugins/bootstrap/css/bootstrap-4.1.1.min.css')}}" rel="stylesheet" type="text/css"/>
	<link href="{{asset('assets/css/build.css')}}" rel="stylesheet" type="text/css"/>
</head>

<body class="text-center">
	<div class="container" style="padding-top: 10px;">
		<div class="col-md-12 text-center">
			<img src="{{ asset('assets/img/logo_republica_federativa_brasil.png') }}" width="100px">
		</div>
		<div id="app">
			<pagina-cnpj></pagina-cnpj>
		</div>
		<div class="row col-md-12 text-left">
            <p style="margin-top: 15px; margin-bottom: 0px">
                fonte: <a href="https://www.receita.fazenda.gov.br/pessoajuridica/cnpj/cnpjreva/Cnpjreva_Solicitacao2.asp?cnpj=07799644000130" target="_blank">https://www.receita.fazenda.gov.br/pessoajuridica/cnpj/cnpjreva/Cnpjreva_Solicitacao2.asp?cnpj=07799644000130</a>
            </p>
			<p >
				SIGA (Sistema Interno de Gestão de Associados) desenvolvido por <a href="//buildsoft.com.br" target="_blank">BuildSoft</a>
			</p>
		</div>
		<br>
		<br>
		<br>
	</div>
	<script src="{{asset('/assets/js/build.js')}}" type="text/javascript"></script>
</body>
</html>