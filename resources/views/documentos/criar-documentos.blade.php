@extends('layouts.app-template')

@section('title')
    Criar documento
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
	            'nome' : 'Criar Documento',
	            'link' : '/documentos/criar-documento',
	        }
	    ]">
    </sub-cabecalho>

	<form-criar-documento></form-criar-documento>

@endsection
