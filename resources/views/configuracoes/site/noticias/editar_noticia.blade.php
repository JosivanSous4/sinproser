@extends('layouts.app-template')

@section('title')
    Criar Publicação
@stop

@section('content')

    <sub-cabecalho :lista=
	    "[
	        {
	            'nome' : 'Configurações',
	            'link' : '#',
	        },
	        {
	            'nome' : 'Gerenciamento do Site',
	            'link' : '{{ url('configuracoes/gerenciar-site') }}'
	        },
	        {
	            'nome' : 'Notícias',
	            'link' : '{{ url('configuracoes/gerenciar-site/noticias') }}',
	        },
	        {
	            'nome' : 'Nova Notícia',
	            'link' : '#',
	        }
	    ]">
    </sub-cabecalho>

	<form-noticia dados="{{ $noticia }}"></form-noticia>

@endsection
