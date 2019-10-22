@extends('layouts.site-template')

@section('title')
	Contato
@stop

@section('content')

	<section class="ptb-0">
		<div class="mb-30 brdr-ash-1 opacty-5"></div>
		<div class="container">
			<a class="mt-10" href="{{ url('/') }}"><i class="mr-5 ion-ios-home"></i>Inicio<i class="mlr-10 ion-chevron-right"></i></a>
			<a class="color-aaa mt-10" href="{{ url('/contato') }}">Contato</a>
		</div>
	</section>
	
	<section>
		<div class="container">
			<div class="row">
			
				<div class="col-sm-12 col-md-8">
					<h3><b>ENVIE-NOS UMA MENSAGEM</b></h3>
					<p class="mb-30 mr-100 mr-sm-0">
						Gostaríamos muito de ouvir sua opinião. Entre em contato para enviar dúvidas, sugestões, opiniões, parcerias de publicidade.
					</p>

					<div class="row">
						@if(session('success'))
							<div class="col-md-12" style="padding-bottom: 0px; ">
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

					<form action="{{ url('contato/enviar-mensagem') }}" method="post" class="form-block form-bold form-mb-20 form-h-35 form-brdr-b-grey pr-50 pr-sm-0">
						@csrf
						<div class="row">
						
							<div class="col-sm-6">
								<p class="color-aaa">Nome*</p>
								<div class="pos-relative">
									<input class="pr-20" required name="nome" type="text" value="{{ old('nome') }}">
									<i class="dplay-none abs-tbr lh-35 font-13 color-green ion-android-done"></i>
								</div>
							</div>
							
							<div class="col-sm-6">
								<p class="color-aaa">Email*</p>
								<div class="pos-relative">
									<input class="pr-20" required name="email" type="email" value="{{ old('email') }}">
									<i class="dplay-none abs-tbr lh-35 font-13 color-green ion-android-done"></i>
								</div>
							</div>
							
							<div class="col-sm-6">
								<p class="color-aaa">Telefone*</p>
								<div class="pos-relative">
									<input class="pr-20" required name="telefone" type="text" value="{{ old('telefone') }}">
									<i class="dplay-none abs-tbr lh-35 font-13 color-green ion-android-done"></i>
								</div>
							</div>
							
							<div class="col-sm-6">	
								<p class="color-aaa">Assunto*</p>
								<div class="pos-relative">
									<input class="pr-20" required name="assunto" type="text" value="{{ old('assunto') }}">
									<i class="dplay-none abs-tbr lh-35 font-13 color-green ion-android-done"></i>
								</div>
							</div>
							
							<div class="col-sm-12">
								<div class="pos-relative pr-80">
									<p class="color-aaa">Mensagem*</p>
									<h4><b>Deixe sua mensagem</b></h4>
									<textarea class="mb-0" required name="mensagem">{{ old('mensagem') }}</textarea>
									<button class="abs-br font-20 plr-15 btn-fill-primary" type="submit"><i class="ion-ios-paperplane"></i></button>
								</div>
							</div>
							
						</div>
					</form>
				</div>
				
				<div class="col-sm-12 col-md-4">
					@include('site.partials.informacoes')
				</div>
				
			</div>
		</div>
	</section>

@endsection