@extends('layouts.site-template')

@section('title')
	Sindicato dos Professores e Servidores Municipais de São João do Carú
@stop

@section('content')
	@php
		$acentos = array("/(á|à|ã|â|ä)/", "/(Á|À|Ã|Â|Ä)/", "/(é|è|ê|ë)/", "/(É|È|Ê|Ë)/", "/(í|ì|î|ï)/", "/(Í|Ì|Î|Ï)/", "/(ó|ò|õ|ô|ö)/", "/(Ó|Ò|Õ|Ô|Ö)/", "/(ú|ù|û|ü)/", "/(Ú|Ù|Û|Ü)/", "/(ñ)/", "/(Ñ)/");
	@endphp

	<div class="container">
		<div class="h-600x h-sm-auto">
			<div class="h-2-3 h-sm-auto oflow-hidden">

				@if(!empty($comunicado))
					<div class="pb-5 pr-5 pr-sm-0 float-left float-sm-none w-2-3 w-sm-100 h-100 h-sm-300x">
						<a class="pos-relative h-100 dplay-block" href="#">
							<div class="img-bg bg-grad-layer-6" style="background: url({{ asset('storage/uploads/'.$comunicado->imagem_capa) }})"></div>
							<div class="abs-blr color-white p-20 bg-sm-color-7">
								<h3 class="mb-15 mb-sm-5 font-sm-13"><b>{{ $comunicado->titulo }}</b></h3>
								<ul class="list-li-mr-20">
									<li>
										por <span class="color-primary">
											<b>$comunicado->hasUsuarioCriador->name</b>
										</span> {{ strftime('%A, %d de %B de %Y', strtotime($comunicado->created_at)) }}
									</li>
									<li><i class="color-primary mr-5 font-12 ion-ios-bolt"></i>{{ $comunicado->num_views }}</li>
									<li><i class="color-primary mr-5 font-12 ion-chatbubbles"></i>0</li>
								</ul>
							</div>
						</a>
					</div>
				@else
					<div class="pb-5 pr-5 pr-sm-0 float-left float-sm-none w-2-3 w-sm-100 h-100 h-sm-300x">
						<a class="pos-relative h-100 dplay-block" href="#">
							<div class="img-bg bg-grad-layer-6"></div>
							<div class="abs-blr color-white p-20 bg-sm-color-7">
								<h3 class="mb-15 mb-sm-5 font-sm-13"><b>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ut sem sed sapien sodales lacinia.</b></h3>
								<ul class="list-li-mr-20">
									<li>by <span class="color-primary"><b>Lorem Ipsum</b></span> Jan 25, 2018</li>
									<li><i class="color-primary mr-5 font-12 ion-ios-bolt"></i>30,190</li>
									<li><i class="color-primary mr-5 font-12 ion-chatbubbles"></i>0</li>
								</ul>
							</div>
						</a>
					</div>
				@endif

				<div class="float-left float-sm-none w-1-3 w-sm-100 h-100 h-sm-600x">
					
					@if(!empty($destaques[0]))
						<div class="pl-5 pb-5 pl-sm-0 ptb-sm-5 pos-relative h-50">
							@php
								$tituloSAcento = preg_replace($acentos, explode(" ","a A e E i I o O u U n N"), $destaques[0]->titulo);
								$tituloMinus = strtolower($tituloSAcento);
								$tituloUrl = str_replace(' ', '-', $tituloMinus);
							@endphp
							<a class="pos-relative h-100 dplay-block" href="{{ url('/noticias/'.$destaques[0]->noticia_id.'/'.$tituloUrl) }}">
								<div class="img-bg bg-grad-layer-6" style="background: url({{ asset('storage/uploads/'.$destaques[0]->imagem_capa) }})"></div>
								<div class="abs-blr color-white p-20 bg-sm-color-7">
									<h4 class="mb-10 mb-sm-5"><b>{{ $destaques[0]->titulo }}</b></h4>
									<ul class="list-li-mr-20">
										<li>
											{{ strftime('%A, %d de %B de %Y', strtotime($destaques[0]->created_at)) }}
										</li>
										<li>
											<i class="color-primary mr-5 font-12 ion-ios-bolt"></i>
											{{ !empty($destaques[0]->num_views) ? $destaques[0]->num_views : '0' }}
										</li>
										<li><i class="color-primary mr-5 font-12 ion-chatbubbles"></i>0</li>
									</ul>
								</div>
							</a>
						</div>
					@else
						<div class="pl-5 pb-5 pl-sm-0 ptb-sm-5 pos-relative h-50">
							<a class="pos-relative h-100 dplay-block" href="#">
								<div class="img-bg bg-grad-layer-6"></div>
								<div class="abs-blr color-white p-20 bg-sm-color-7">
									<h4 class="mb-10 mb-sm-5"><b>Lorem ipsum dolor sit amet, consectetur adipiscing elit</b></h4>
									<ul class="list-li-mr-20">
										<li>Jan 25, 2018</li>
										<li><i class="color-primary mr-5 font-12 ion-ios-bolt"></i>30,190</li>
										<li><i class="color-primary mr-5 font-12 ion-chatbubbles"></i>0</li>
									</ul>
								</div>
							</a>
						</div>
					@endif

					@if(!empty($destaques[1]))
						<div class="pl-5 ptb-5 pl-sm-0 pos-relative h-50">
							@php
								$tituloSAcento = preg_replace($acentos, explode(" ","a A e E i I o O u U n N"), $destaques[1]->titulo);
								$tituloMinus = strtolower($tituloSAcento);
								$tituloUrl = str_replace(' ', '-', $tituloMinus);
							@endphp
							<a class="pos-relative h-100 dplay-block" href="{{ url('/noticias/'.$destaques[1]->noticia_id.'/'.$tituloUrl) }}">
								<div class="img-bg bg-grad-layer-6" style="background: url({{ asset('storage/uploads/'.$destaques[1]->imagem_capa) }})"></div>
								<div class="abs-blr color-white p-20 bg-sm-color-7">
									<h4 class="mb-10 mb-sm-5"><b>{{ $destaques[1]->titulo }}</b></h4>
									<ul class="list-li-mr-20">
										<li>
											{{ strftime('%A, %d de %B de %Y', strtotime($destaques[1]->created_at)) }}
										</li>
										<li>
											<i class="color-primary mr-5 font-12 ion-ios-bolt"></i>
											{{ !empty($destaques[1]->num_views) ? $destaques[1]->num_views : '0' }}
										</li>
										<li><i class="color-primary mr-5 font-12 ion-chatbubbles"></i>0</li>
									</ul>
								</div>
							</a>
						</div>
					@else
						<div class="pl-5 ptb-5 pl-sm-0 pos-relative h-50">
							<a class="pos-relative h-100 dplay-block" href="#">
								<div class="img-bg bg-grad-layer-6"></div>
								<div class="abs-blr color-white p-20 bg-sm-color-7">
									<h4 class="mb-10 mb-sm-5"><b>Lorem ipsum dolor sit amet, consectetur adipiscing elit</b></h4>
									<ul class="list-li-mr-20">
										<li>Jan 25, 2018</li>
										<li><i class="color-primary mr-5 font-12 ion-ios-bolt"></i>30,190</li>
										<li><i class="color-primary mr-5 font-12 ion-chatbubbles"></i>0</li>
									</ul>
								</div>
							</a>
						</div>
					@endif

				</div>

			</div>

			<div class="h-1-3 oflow-hidden">

				@if(!empty($destaques[2]))
					<div class="pr-5 pr-sm-0 pt-5 float-left float-sm-none pos-relative w-1-3 w-sm-100 h-100 h-sm-300x">
						@php
							$tituloSAcento = preg_replace($acentos, explode(" ","a A e E i I o O u U n N"), $destaques[2]->titulo);
							$tituloMinus = strtolower($tituloSAcento);
							$tituloUrl = str_replace(' ', '-', $tituloMinus);
						@endphp
						<a class="pos-relative h-100 dplay-block" href="{{ url('/noticias/'.$destaques[2]->noticia_id.'/'.$tituloUrl) }}">
							<div class="img-bg bg-grad-layer-6" style="background: url({{ asset('storage/uploads/'.$destaques[2]->imagem_capa) }})"></div>
							<div class="abs-blr color-white p-20 bg-sm-color-7">
								<h4 class="mb-10 mb-sm-5"><b>{{ $destaques[2]->titulo }}</b></h4>
								<ul class="list-li-mr-20">
									<li>
										{{ strftime('%A, %d de %B de %Y', strtotime($destaques[2]->created_at)) }}
									</li>
									<li>
										<i class="color-primary mr-5 font-12 ion-ios-bolt"></i>
										{{ !empty($destaques[2]->num_views) ? $destaques[2]->num_views : '0' }}
									</li>
									<li><i class="color-primary mr-5 font-12 ion-chatbubbles"></i>0</li>
								</ul>
							</div>
						</a>
					</div>
				@else
					<div class="pr-5 pr-sm-0 pt-5 float-left float-sm-none pos-relative w-1-3 w-sm-100 h-100 h-sm-300x">
						<a class="pos-relative h-100 dplay-block" href="#">
							<div class="img-bg bg-grad-layer-6"></div>
							<div class="abs-blr color-white p-20 bg-sm-color-7">
								<h4 class="mb-10 mb-sm-5"><b>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</b></h4>
								<ul class="list-li-mr-20">
									<li>Jan 25, 2018</li>
									<li><i class="color-primary mr-5 font-12 ion-ios-bolt"></i>30,190</li>
									<li><i class="color-primary mr-5 font-12 ion-chatbubbles"></i>0</li>
								</ul>
							</div>
						</a>
					</div>
				@endif

				@if(!empty($destaques[3]))
					<div class="plr-5 plr-sm-0 pt-5 pt-sm-10 float-left float-sm-none pos-relative w-1-3 w-sm-100 h-100 h-sm-300x">
						@php
							$tituloSAcento = preg_replace($acentos, explode(" ","a A e E i I o O u U n N"), $destaques[3]->titulo);
							$tituloMinus = strtolower($tituloSAcento);
							$tituloUrl = str_replace(' ', '-', $tituloMinus);
						@endphp
						<a class="pos-relative h-100 dplay-block" href="{{ url('/noticias/'.$destaques[3]->noticia_id.'/'.$tituloUrl) }}">
							<div class="img-bg bg-grad-layer-6" style="background: url({{ asset('storage/uploads/'.$destaques[3]->imagem_capa) }})"></div>
							<div class="abs-blr color-white p-20 bg-sm-color-7">
								<h4 class="mb-10 mb-sm-5"><b>{{ $destaques[3]->titulo }}</b></h4>
								<ul class="list-li-mr-20">
									<li>
										{{ strftime('%A, %d de %B de %Y', strtotime($destaques[3]->created_at)) }}</li>
									<li>
										<i class="color-primary mr-5 font-12 ion-ios-bolt"></i>
										{{ !empty($destaques[3]->num_views) ? $destaques[3]->num_views : '0' }}
									</li>
									<li><i class="color-primary mr-5 font-12 ion-chatbubbles"></i>0</li>
								</ul>
							</div>
						</a>
					</div>
				@else
					<div class="plr-5 plr-sm-0 pt-5 pt-sm-10 float-left float-sm-none pos-relative w-1-3 w-sm-100 h-100 h-sm-300x">
						<a class="pos-relative h-100 dplay-block" href="#">
							<div class="img-bg bg-grad-layer-6"></div>
							<div class="abs-blr color-white p-20 bg-sm-color-7">
								<h4 class="mb-10 mb-sm-5"><b>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</b></h4>
								<ul class="list-li-mr-20">
									<li>Jan 25, 2018</li>
									<li><i class="color-primary mr-5 font-12 ion-ios-bolt"></i>30,190</li>
									<li><i class="color-primary mr-5 font-12 ion-chatbubbles"></i>0</li>
								</ul>
							</div>
						</a>
					</div>
				@endif

				@if(!empty($destaques[4]))
					<div class="pl-5 pl-sm-0 pt-5 pt-sm-10 float-left float-sm-none pos-relative w-1-3 w-sm-100 h-100 h-sm-300x">
						@php
							$tituloSAcento = preg_replace($acentos, explode(" ","a A e E i I o O u U n N"), $destaques[4]->titulo);
							$tituloMinus = strtolower($tituloSAcento);
							$tituloUrl = str_replace(' ', '-', $tituloMinus);
						@endphp
						<a class="pos-relative h-100 dplay-block" href="{{ url('/noticias/'.$destaques[4]->noticia_id.'/'.$tituloUrl) }}">
							<div class="img-bg bg-grad-layer-6" style="background: url({{ asset('storage/uploads/'.$destaques[4]->imagem_capa) }})"></div>
							<div class="abs-blr color-white p-20 bg-sm-color-7">
								<h4 class="mb-10 mb-sm-5"><b>{{ $destaques[4]->titulo }}</b></h4>
								<ul class="list-li-mr-20">
									<li>
										{{ strftime('%A, %d de %B de %Y', strtotime($destaques[4]->created_at)) }}
									</li>
									<li>
										<i class="color-primary mr-5 font-12 ion-ios-bolt"></i>
										{{ !empty($destaques[4]->num_views) ? $destaques[4]->num_views : '0' }}
									</li>
									<li><i class="color-primary mr-5 font-12 ion-chatbubbles"></i>0</li>
								</ul>
							</div>
						</a>
					</div>
				@else
					<div class="pl-5 pl-sm-0 pt-5 pt-sm-10 float-left float-sm-none pos-relative w-1-3 w-sm-100 h-100 h-sm-300x">
						<a class="pos-relative h-100 dplay-block" href="#">
							<div class="img-bg bg-grad-layer-6"></div>
							<div class="abs-blr color-white p-20 bg-sm-color-7">
								<h4 class="mb-10 mb-sm-5"><b>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</b></h4>
								<ul class="list-li-mr-20">
									<li>Jan 25, 2018</li>
									<li><i class="color-primary mr-5 font-12 ion-ios-bolt"></i>30,190</li>
									<li><i class="color-primary mr-5 font-12 ion-chatbubbles"></i>0</li>
								</ul>
							</div>
						</a>
					</div>
				@endif

			</div>

		</div>
	</div>

	<section>
		<div class="container">
			<div class="row">

				<div class="col-md-12 col-lg-8">

					<h4 class="p-title"><b>NOTÍCIAS RECENTES</b></h4>

					@forelse($noticiasRecentes as $noticiaRecente)
						<div class="row">
							<div class="col-sm-6">
								<img src="{{ asset('storage/uploads/'.$noticiaRecente->imagem_capa) }}" alt="{{ $noticiaRecente->titulo }}">
								<h4 class="pt-20">
									@php
										$tituloSAcento = preg_replace($acentos, explode(" ","a A e E i I o O u U n N"), $noticiaRecente->titulo);
										$tituloMinus = strtolower($tituloSAcento);
										$tituloUrl = str_replace(' ', '-', $tituloMinus);
									@endphp
									<a href="{{ url('/noticias/'.$noticiaRecente->noticia_id.'/'.$tituloUrl) }}">
										<b>{{ $noticiaRecente->titulo }}</b>
									</a>
								</h4>
								<ul class="list-li-mr-20 pt-10 mb-30">
									<li class="color-lite-black">
										por <a href="#" class="color-black">
											<b>{{ $noticiaRecente->hasUsuarioCriador->name }},</b>
										</a>
										{{ strftime('%A, %d de %B de %Y', strtotime($noticiaRecente->created_at)) }}
									</li>
									<li>
										<i class="color-primary mr-5 font-12 ion-ios-bolt"></i>
										{{ !empty($noticiaRecente->num_views) ? $noticiaRecente->num_views : '0' }}
									</li>
									<li><i class="color-primary mr-5 font-12 ion-chatbubbles"></i>0</li>
								</ul>
							</div>
						</div>

						<a class="dplay-block btn-brdr-primary mt-20 mb-md-50" href="#">
							<b>IR PARA PÁGINA DE NOTÍCIAS</b>
						</a>
					@empty
						<div class="row">
							<div class="col-sm-12">
								<h4>Nenhuma notícia para ser mostrada.</h4>
							</div>
						</div>
					@endforelse
				
				</div>

				<div class="d-none d-md-block d-lg-none col-md-3"></div>

				@include('site.partials.lateral')

			</div>
		</div>
	</section>

@endsection
