@extends('layouts.app-template')

@section('title')
    Listar Tipos de Entrada
@stop

@section('content')

	<sub-cabecalho :lista=
	    "[
	        {
	            'nome' : 'Financeiro',
	            'link' : '',
	        },
			{
	            'nome' : 'Lista de entradas',
	            'link' : '{{ url('financeiro/entrada') }}',
	        }
	    ]">
    </sub-cabecalho>

	<lista-entrada><lista-entrada>

@endsection
