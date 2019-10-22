@extends('layouts.app-template')

@section('title')
    Editar documento
@stop

@section('css')
	<link rel="stylesheet" href="{{asset('/assets/css/vueWysiwyg.css')}}">
@endsection

@section('content')

    <sub-cabecalho :lista=
	    "[
	        {
	            'nome' : 'Documentos',
	            'link' : '/documentos',
	        },
	        {
	            'nome' : 'Editar Documento',
	            'link' : '/documentos/editar-documento',
	        }
	    ]">
    </sub-cabecalho>

	<form-criar-documento dados="{{ $documento }}"></form-criar-documento>

@endsection