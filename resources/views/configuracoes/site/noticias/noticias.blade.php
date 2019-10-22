@extends('layouts.app-template')

@section('title')
    Cadastrar Local de Trabalho
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
	        }
	    ]">
    </sub-cabecalho>

	<lista-noticias></lista-noticias>
@endsection
