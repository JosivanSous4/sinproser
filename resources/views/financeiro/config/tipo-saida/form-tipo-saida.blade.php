@extends('layouts.app-template')

@section('title')
    Cadastrar Tipos de Saida
@stop

@section('content')
	
	<sub-cabecalho :lista=
	    "[
	        {
	            'nome' : 'Tipo de saída',
	            'link' : '/configuracoes/cadastro/tipos-de-saida',
	        },
	        {
	            'nome' : 'Cadastro de tipo de saída',
	            'link' : '',
	        }
	    ]">
    </sub-cabecalho>

	<form-tipo-saida :tiposaida="{{$tiposSaida}}"></form-tipo-saida>

@endsection