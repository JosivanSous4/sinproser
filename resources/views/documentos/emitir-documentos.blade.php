@extends('layouts.app-template')

@section('title')
    Emitir documento
@stop

@section('content')

    <sub-cabecalho :lista=
	    "[
	        {
	            'nome' : 'Documentos',
	            'link' : '/documentos',
	        },
	        {
	            'nome' : 'Emitir Documento',
	            'link' : '/documentos/emitir-documento',
	        }
	    ]">
    </sub-cabecalho>

	<emitir-documento token="{{ csrf_token() }}"></emitir-documento>

@endsection