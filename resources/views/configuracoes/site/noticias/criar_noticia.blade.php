@extends('layouts.app-template')

@section('title')
    Criar Publicação
@stop

@section('css')
	<link rel="stylesheet" href="{{asset('/assets/css/vueWysiwyg.css')}}">
@endsection

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

	<form-noticia></form-noticia>

@endsection
