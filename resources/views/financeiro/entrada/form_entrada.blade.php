@extends('layouts.app-template')

@section('title')
    Cadastrar Tipos de Entrada
@stop

@section('content')
	<sub-cabecalho :lista=
	    "[
	        {
	            'nome' : 'Financeiro',
	            'link' : '#',
	        },
	        {
	            'nome' : 'Lista de entradas',
	            'link' : '{{ url('financeiro/entrada') }}',
	        },
	        {
	            'nome' : 'Cadastrar entrada',
	            'link' : '',
	        }
	    ]">
    </sub-cabecalho>

	<form-entrada :entrada="{{ $entrada }}"></form-entrada>

@endsection