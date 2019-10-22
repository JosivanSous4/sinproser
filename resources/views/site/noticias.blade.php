@extends('layouts.site-template')

@section('title')
	Contato
@stop

@section('content')

@php
    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    date_default_timezone_set('America/Sao_Paulo');
@endphp

	<section class="ptb-0">
		<div class="mb-30 brdr-ash-1 opacty-5"></div>
		<div class="container">
			<a class="mt-10" href="{{ url('/') }}"><i class="mr-5 ion-ios-home"></i>Inicio<i class="mlr-10 ion-chevron-right"></i></a>
			<a class="color-aaa mt-10" href="{{ url('/noticias') }}">Notícias</a>
		</div>
	</section>

	<section>
		<div class="container">
			<div class="row">
			
				<div class="col-md-12 col-lg-8">
					<h3 class="p-title"><b>FIQUE POR DENTRO DE NOSSAS NOTÍCIAS</b></h3>
					<div class="row">
					
						@forelse($noticias as $noticia)
							<div class="col-sm-6">
								<img src="{{ asset('storage/uploads/'.$noticia->imagem_capa) }}" alt="">
								<h4 class="pt-20"><a href="#"><b>{{ $noticia->titulo }}</b></a></h4>
								<ul class="list-li-mr-20 pt-10 mb-30">
									<li class="color-lite-black">por <a href="#" class="color-black"><b>{{ $noticia->hasUsuarioCriador->name }},</b></a>
									<br>{{ strftime('%A, %d de %B de %Y', strtotime($noticia->created_at)) }}</li>
								</ul>
								<p class="text-justify"  style="margin-top: -14px!important;">
									{{ substr($noticia->descricao_rapida, 0, strrpos(substr($noticia->descricao_rapida, 0, 100), ' ')) . '...' }}
								</p>
								@php 
									$tituloSAcento = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"), $noticia->titulo);
									$tituloMinus = strtolower($tituloSAcento); 
									$tituloUrl = str_replace(' ', '-', $tituloMinus);
								@endphp
								<a class="dplay-block btn-brdr-primary mt-20 mb-md-50" href="{{ url('/noticias/'.$noticia->noticia_id.'/'.$tituloUrl) }}"><b>VER MAIS</b></a>
							</div>
						@empty
							<div class="col-sm-6">
								<p class="pt-30">
									Nenhuma notícia cadastrada ainda.
								</p>
							</div>
						@endforelse
						
					</div>
					
				</div>
				
				<div class="d-none d-md-block d-lg-none col-md-3"></div>
				
				<div class="col-md-6 col-lg-4">	
					<div class="pl-20 pl-md-0">

						@include('site.partials.informacoes')
						
						<div class="mtb-50">
							@include('site.partials.posts_populares')	
						</div>

					</div>
				</div>
				
			</div>
		</div>
	</section>

@endsection