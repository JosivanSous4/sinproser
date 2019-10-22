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
	            'nome' : 'Lista de saída',
	            'link' : '{{ url('financeiro/saida') }}',
	        },
	        {
	            'nome' : 'Cadastrar saída',
	            'link' : '',
	        }
	    ]">
    </sub-cabecalho>
	<form-saida :saida="{{$saida}}"></form-saida>

@endsection