@extends('layouts.site-template')

@section('title')
	Links Úteis
@stop

@section('content')

@php
    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    date_default_timezone_set('America/Sao_Paulo');
@endphp

	<section class="ptb-0">
		<div class="mb-30 brdr-ash-1 opacty-5"></div>
		<div class="container">
			<a class="mt-10" href="index.html"><i class="mr-5 ion-ios-home"></i>Início<i class="mlr-10 ion-chevron-right"></i></a>
			<a class="mt-10" href="archive-page.html">Notícias<i class="mlr-10 ion-chevron-right"></i></a>
			<a class="mt-10 color-ash">{{ $noticia->titulo }}</a>
		</div>
	</section>
	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-lg-8">
					<img src="{{ asset('storage/uploads/'.$noticia->imagem_capa) }}" alt="">
					<h3 class="mt-30"><b>{{ $noticia->titulo }}</b></h3>
					<ul class="list-li-mr-20 mtb-15">
						<li class="color-lite-black">
							por <a href="#" class="color-black"><b>{{ $noticia->hasUsuarioCriador->name }},</b></a>
							<br>{{ strftime('%A, %d de %B de %Y', strtotime($noticia->created_at)) }}
						</li>
					</ul>
					
					{!! $noticia->conteudo !!}
					
					<div class="float-left-right text-center mt-40 mt-sm-20">
						<ul class="mb-30 list-a-bg-grey list-a-hw-radial-35 list-a-hvr-primary list-li-ml-5">
							<li class="mr-10 ml-0">Share</li>
							<li><a href="#"><i class="ion-social-facebook"></i></a></li>
							<li><a href="#"><i class="ion-social-twitter"></i></a></li>
							<li><a href="#"><i class="ion-social-google"></i></a></li>
							<li><a href="#"><i class="ion-social-instagram"></i></a></li>
						</ul>
						
					</div>
					
					<h4 class="p-title mt-20"><b>ENVIE SEU COMENTÁRIO</b></h4>
					
					<div class="row">
						@if(session('success'))
							<div class="col-md-12" style="padding-bottom: 0px;">
				                <div class="alert alert-success" role="alert">
				                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									    <span aria-hidden="true">&times;</span>
									</button>
				                    {{ session('success') }}
				                </div>
			                </div>
		                @else 
		                	@if($errors->all())
							    <div class="col-md-12" style="padding-bottom: 0px; ">
				                    <div class="alert alert-danger" role="alert">
					                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										    <span aria-hidden="true">&times;</span>
										</button>
									    @foreach($errors->all() as $key => $mensagem)
							                *{{ $mensagem }}<br>
									    @endforeach
					                </div>
							    </div>
							@elseif(session('error')) 
								<div class="col-md-12" style="padding-bottom: 0px; ">
					                <div class="alert alert-danger" role="alert">
					                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										    <span aria-hidden="true">&times;</span>
										</button>
					                    {{ session('error') }}
					                </div>
				                </div>
							@endif
		                @endif
		            </div>
					<form class="form-block form-plr-15 form-h-45 form-mb-20 form-brdr-lite-white mb-md-50" method="POST" action="{{ url('/noticias/enviar-comentario') }}">
						@csrf
						<input type="hidden" value="{{ $noticia->noticia_id }}" name="noticia_id">
						<input type="text" placeholder="Seu Nome*:" name="nome">
						<input type="text" placeholder="Seu Email*:" name="email">
						<textarea class="ptb-10" placeholder="comentário*:" name="comentario"></textarea>
						<div class="g-recaptcha" data-sitekey="6LfDn5EUAAAAAMUbgFRju6zyj7fkmBJHiBJLnSQ5"></div><br>
						<button class="btn-fill-primary plr-30" rows="4" cols="50" type="submit"><b>ENVIAR COMENTÁRIO</b></button>
					</form>
				</div>
				
				<div class="d-none d-md-block d-lg-none col-md-3"></div>
				<div class="col-md-6 col-lg-4">
					<div class="pl-20 pl-md-0">
						<div class="mtb-50">
							<h3 class="mb-20 mt-sm-50"><b>INFORMATION</b></h3>
							
							<ul class="font-11 list-relative list-li-pl-30 list-block list-li-mb-15">
								<li><i class="abs-tl ion-ios-location"></i>599 Co Rd 771 Ohio City CO <br>81237. United States</li>
								<li><i class="abs-tl ion-android-mail"></i>Infor.deercreative@gmail.com</li>
								<li><i class="abs-tl ion-android-call"></i>(+12)-345-678-910</li>
							</ul>
							<ul class="font-11  list-a-plr-10 list-a-plr-sm-5 list-a-ptb-15 list-a-ptb-sm-5">
								<li><a class="pl-0" href="#"><i class="ion-social-linkedin"></i></a></li>
								<li><a href="#"><i class="ion-social-facebook"></i></a></li>
								<li><a href="#"><i class="ion-social-twitter"></i></a></li>
								<li><a href="#"><i class="ion-social-google"></i></a></li>
								<li><a href="#"><i class="ion-social-pinterest"></i></a></li>
							</ul>
						
						</div>						
						<div class="mtb-50">
							@include('site.partials.posts_populares')							
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection