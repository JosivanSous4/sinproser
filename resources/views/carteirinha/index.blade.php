@extends('layouts.app-template')

@section('title')
    Listar Bens
@stop

@section('content')

    <sub-cabecalho :lista=
	    "[
	        {
	            'nome' : 'Bens',
	            'link' : '/bens',
	        },
	        {
	            'nome' : 'Lista de Carteirinhas',
	            'link' : '/associados/carteirinhas',
	        }
	    ]">
    </sub-cabecalho>

	<lista-carteirinhas dados="{{ $associados }}" acao="{{ $acao }}" relatorio="{{ json_encode($minRelatorio) }}"></lista-carteirinhas>

@endsection