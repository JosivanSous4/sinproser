@extends('layouts.app-template')

@section('title')
    Informações Sindicato
@stop

@section('css')
	<link rel="stylesheet" href="{{asset('/assets/css/vueWysiwyg.css')}}">
@endsection

@section('content')

    <sub-cabecalho :lista=
	    "[
	        {
	            'nome' : 'Informações Sindicato',
	            'link' : '/configuracoes/gerenciar-site/informacoes-sindicato/',
	        }
	    ]">
    </sub-cabecalho>

	<form-informacoes-sindicato dados="{{ isset($dados) ? $dados : '' }}"></form-informacoes-sindicato>

@endsection