@extends('layouts.app-template')

@section('title')
    Listar Tipos de Entrada
@stop

@section('content')
	
	<sub-cabecalho :lista=
	    "[
	        {
	            'nome' : 'Tipo de entrada',
	            'link' : '',
	        }
	    ]">
    </sub-cabecalho>

	<lista-tipo-entrada><lista-tipo-entrada>
	
@endsection