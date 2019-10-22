@extends('layouts.site-template')

@section('title')
	Contato
@stop

@section('content')

	<section class="ptb-0">
		<div class="mb-30 brdr-ash-1 opacty-5"></div>
		<div class="container">
			<a class="mt-10" href="{{ url('/') }}"><i class="mr-5 ion-ios-home"></i>Inicio<i class="mlr-10 ion-chevron-right"></i></a>
			<a class="color-aaa mt-10" href="{{ url('/sobre-nos') }}">Sobre Nós<i class="mlr-10 ion-chevron-right"></i></a>
			<a class="color-aaa mt-10" href="{{ url('/institucional/diretoria') }}">Diretoria</a>
		</div>
	</section>
	
	<section>
		<div class="container">
			<div class="row">
				
				<div class="col-sm-12 col-md-8">
					<h2 class="mb-50"><b>DIRETORIA</b></h2>

					@forelse($diretoria as $diretor)
						<p class="pt-30">
							Diretoria do Sindicato dos Professores e Servidores Municipais de São João do Carú (<script>document.write(new Date().getFullYear());</script>).
						</p><br>

						<div class="fototexto">
							<div class="row">
								<div class="col-md-3">
									<img src="{{ !empty($diretor->foto) ? asset('storage/uploads/' . $diretor->foto) : asset('storage/uploads/diretor-default.png') }}" class="imagem-diretor">
								</div>
								<div class="col-md-6">
									<p class="textomaior">{{ $diretor->nome }}</p>
									<p>{{ $diretor->cargo }}</p>
								</div>
							</div><br>
						</div>
					@empty
						<p class="pt-30">
							Nenhum membro da diretoria cadastrado.
						</p>
					@endforelse
					
				</div>
				
				<div class="col-sm-12 col-md-4">
					@include('site.partials.informacoes')
				</div>
				
			</div>
		</div>
	</section>

@endsection