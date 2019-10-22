@extends('layouts.site-template')

@section('title')
	Sobre Nós
@stop

@section('content')

	<section class="ptb-0">
		<div class="mb-30 brdr-ash-1 opacty-5"></div>
		<div class="container">
			<a class="mt-10" href="{{ url('/') }}"><i class="mr-5 ion-ios-home"></i>Inicio<i class="mlr-10 ion-chevron-right"></i></a>
			<a class="color-aaa mt-10" href="{{ url('/sobre-nos') }}">Sobre Nós</a>
		</div>
	</section>
	
	<section>
		<div class="container">
			<div class="row">
				
				<div class="col-sm-12 col-md-8">
					<h2 class="mb-50"><b>QUEM SOMOS?</b></h2>

					@if(!empty($sindicato->foto))
						<img src="{{ asset('storage/uploads/'.$sindicato->foto) }}" alt="SINPROSERMUCARU">
					@endif

					@if(!isset($sindicato) || empty($sindicato))
						<p class="pt-30">
							Nenhuma informação cadastrada.
						</p>
					@else
						<p class="pt-30">
							{!! $sindicato->descricao !!}
						</p>
					@endif
					
				</div>

				<div class="col-sm-12 col-md-4">
					@include('site.partials.informacoes')
				</div>
			</div>
		</div>
	</section>

@endsection