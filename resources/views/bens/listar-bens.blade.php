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
	            'nome' : 'Lista de Bens',
	            'link' : '/bens/',
	        }
	    ]">
    </sub-cabecalho>

	<lista-bens></lista-bens>

@endsection