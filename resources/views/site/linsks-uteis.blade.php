@extends('layouts.site-template')

@section('title')
	Links Úteis
@stop

@section('content')

	<section class="ptb-0">
		<div class="mb-30 brdr-ash-1 opacty-5"></div>
		<div class="container">
			<a class="mt-10" href="{{ url('/') }}"><i class="mr-5 ion-ios-home"></i>Inicio<i class="mlr-10 ion-chevron-right"></i></a>
			<a class="color-aaa mt-10" href="{{ url('/links-uteis') }}">Links Úteis</a>
		</div>
	</section>
	
	<section>
		<div class="container">
			<div class="row">
			
				<div class="col-sm-12 col-md-8">
					<h2 class="mb-50"><b>LINKS QUE TALVEZ SEJAM ÚTEIS PARA VOCÊ</b></h2>
					
					@forelse($links as $link)
						<div class="quote-primary mtb-20">
							<h5 class="mt-15">
								<b>{{ $link->destino }}</b>
							</h5>
							<h5>
								<a href="{{ $link->link }}" target="_blank">
									{{ $link->link }}
								</a>
							</h5>
						</div>
					@empty
						<div class="quote-primary mtb-20">
							<h5>
								Nenhum link útil cadastrado.
							</h5>
						</div>
					@endforelse
					
				</div>
				
				<div class="col-sm-12 col-md-4">
					@include('site.partials.informacoes')
				</div>
				
			</div>
		</div>
	</section>

@endsection