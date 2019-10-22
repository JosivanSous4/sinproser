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
	            'nome' : 'Arrecadação sindical',
	            'link' : '',
	        }
	    ]">
    </sub-cabecalho>
	<form-baixa-coletiva></form-baixa-coletiva>

@endsection
