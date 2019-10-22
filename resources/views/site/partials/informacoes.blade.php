@php
	$qtdEmails = 0;

	$qtdTelefones = 0;

	$qtdFacebook = 0;

	$qtdInstagram = 0;

	$qtdTwitter = 0;

	$siteController = new App\Http\Controllers\Site\SiteController();

	$informacoesSindicato = $siteController->getInformacoesSindicato();

	if ($informacoesSindicato) {
		$endereco = $informacoesSindicato->hasEndereco;
		$contatos = $informacoesSindicato->hasContatos;
	}

@endphp

<h3 class="mb-20 mt-sm-50"><b>INFORMAÇÕES</b></h3>

<ul class="font-11 list-relative list-li-pl-30 list-block list-li-mb-15">
	<li>
		<i class="abs-tl ion-ios-location"></i>
		{{ !empty($endereco) ? "$endereco->rua, $endereco->numero_residencia, $endereco->bairro - " . $endereco->hasCidade->cidade . '/' . $endereco->hasCidade->hasEstado->uf . " - $endereco->cep  - Brasil." : 'Nenhum endereço cadastrado' }}
	</li>

	@if(!empty($contatos))
		@foreach($contatos as $contato)
			@if($contato->tipo == 'Email')
				<li>
					<i class="abs-tl ion-android-mail"></i> {{ $contato->contato }}
				</li>
				
				@php
					$qtdEmails + 1;
				@endphp
			
			@else
				@if($qtdEmails <= 0)
					<li>
						<i class="abs-tl ion-android-mail"></i> Nenhum e-mail cadastrado
					</li>
				@endif
			@endif
		@endforeach

		@foreach($contatos as $contato)
			@if($contato->tipo == 'Telefone' || $contato->tipo == 'Celular')
				<li>
					<i class="abs-tl ion-android-call"></i> +55 {{ $contato->contato }}
				</li>

				@php
					$qtdTelefones + 1;
				@endphp
			@else
				@if($qtdTelefones <= 0)
					<li>
						<i class="abs-tl ion-android-call"></i> Nenhum telefone cadastrado
					</li>
				@endif
			@endif
		@endforeach
	@else
		<li><i class="abs-tl ion-android-mail"></i> Nenhum e-mail cadastrado</li>
		<li><i class="abs-tl ion-android-call"></i> Nenhum telefone cadastrado</li>
	@endif

</ul>

<ul class="font-11  list-a-plr-10 list-a-plr-sm-5 list-a-ptb-15 list-a-ptb-sm-5">
	@if(!empty($contatos))
		@foreach($contatos as $contato)
			@if($contato->tipo == 'Facebook')
				<li>
					<a href="{{ 'https://facebook.com/' . $contato->contato }}" title="Facebook">
						<i class="ion-social-facebook"></i>
					</a>
				</li>
				@php
					$qtdFacebook + 1;
				@endphp
			
			@else
				@if($qtdFacebook <= 0)
					<li><a class="pl-0" href="#" title="Facebook"><i class="ion-social-facebook"></i></a></li>
				@endif
			@endif
		@endforeach

		@foreach($contatos as $contato)
			@if($contato->tipo == 'Instagram')
				<li>
					<a href="{{ 'https://instagram.com/' . $contato->contato }}" title="Instagram">
						<i class="ion-social-instagram"></i>
					</a>
				</li>
				
				@php
					$qtdInstagram + 1;
				@endphp
			
			@else
				@if($qtdInstagram <= 0)
					<li><a href="#"><i class="ion-social-instagram" title="Instagram"></i></a></li>
				@endif
			@endif
		@endforeach

		@foreach($contatos as $contato)
			@if($contato->tipo == 'Twitter')
				<li>
					<a href="{{ 'https://twitter.com/' . $contato->contato }}" title="Twitter">
						<i class="ion-social-twitter"></i>
					</a>
				</li>
				
				@php
					$qtdTwitter + 1;
				@endphp
			
			@else
				@if($qtdTwitter <= 0)
					<li><a href="#"><i class="ion-social-twitter" title="Twitter"></i></a></li>
				@endif
			@endif
		@endforeach
	@else
		<li><a class="pl-0" href="#" title="Facebook"><i class="ion-social-facebook"></i></a></li>
		<li><a href="#"><i class="ion-social-instagram" title="Instagram"></i></a></li>
		<li><a href="#"><i class="ion-social-twitter" title="Twitter"></i></a></li>
	@endif

	<li><a href="#"><i class="ion-social-google" title="Google"></i></a></li>

</ul>