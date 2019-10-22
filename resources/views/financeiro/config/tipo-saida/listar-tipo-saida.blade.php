@extends('layouts.app-template')

@section('title')
    Listar Tipos de Saida
@stop

@section('content')
	
	<sub-cabecalho :lista=
	    "[
	        {
	            'nome' : 'Tipo de saída',
	            'link' : '',
	        }
	    ]">
    </sub-cabecalho>
    
	<lista-tipo-saida><lista-tipo-saida>
	
@endsection