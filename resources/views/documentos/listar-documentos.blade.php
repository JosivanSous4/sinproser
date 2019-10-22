@extends('layouts.app-template')

@section('title')
    Listar Documentos
@stop

@section('content')

    <sub-cabecalho :lista=
	    "[
	        {
	            'nome' : 'Documentos',
	            'link' : '/documentos',
	        },
	        {
	            'nome' : 'Lista Documentos',
	            'link' : '/documentos',
	        }
	    ]">
    </sub-cabecalho>

	<lista-documentos></lista-documentos>

@endsection