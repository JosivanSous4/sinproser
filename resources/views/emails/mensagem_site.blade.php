<!DOCTYPE html>
<html>
<head>
	<title></title>

	<style type="text/css">
		.link {
			text-decoration: none;
		}

		.corpo {
			padding-bottom: 15px;
		}

	</style>
</head>
<body>

	<div style="width: 80%; background-color: #eee; margin: 0 auto; text-align: center; padding: 15px; padding-left: 15px; padding-right: 15px; font-family: 'Roboto', sans-serif;">
		<div class="titulo">
			<h2>{{ $assunto }} </h2>
		</div>
		<div class="corpo">
			<p>{{ $mensagem }}</p>
		</div>
		<div class="rodape">
			<p>
				<span>{{ $email }}</span>
			</p>
			<p>
				<span>{{ $telefone }}</span>
			</p>
			<span>{{ $nome }} via <a href="//www.sinprosermucaru.com.br" target="_blank" class="link">site</a></span>
		</div>
	</div>

</body>
</html>