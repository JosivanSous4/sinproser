<h4 class="p-title"><b>POPULAR POSTS</b></h4>

@forelse($postsPopulares as $postPopular)
<a class="oflow-hidden pos-relative mb-20 dplay-block" href="#">
	<div class="wh-100x abs-tlr"><img src="{{ asset('storage/uploads/'.$noticia->imagem_capa) }}" alt=""></div>
	<div class="ml-120 min-h-100x">
		<h5><b>{{ $noticia->titulo }}</b></h5>
		<h6 class="color-lite-black pt-10">por <span class="color-black"><b>{{ $noticia->hasUsuarioCriador->name }},</b></span> {{ strftime('%A, %d de %B de %Y', strtotime($noticia->created_at)) }}</h6>
	</div>
</a>
@empty
<a class="oflow-hidden pos-relative mb-20 dplay-block" href="#">
	A computar
</a>
@endforelse