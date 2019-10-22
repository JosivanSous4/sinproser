@extends('layouts.app-template')

@section('title')
    Lista de Locais de Trabalho
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
	        }
	    ]">
    </sub-cabecalho>

	<cadastros></cadastros>

@endsection
