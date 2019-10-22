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
	            'nome' : 'Cadastro',
	            'link' : '{{ url('configuracoes/cadastro') }}'
	        },
	        {
	            'nome' : 'Áreas de Atuação',
	            'link' : '{{ url('/configuracoes/cadastro/areas-de-atuacao') }}',
	        },
	        {
	            'nome' : 'Cadastro de Área de Atuação',
	            'link' : '',
	        }
	    ]">
    </sub-cabecalho>

	<form-area-atuacao></form-area-atuacao>

@endsection