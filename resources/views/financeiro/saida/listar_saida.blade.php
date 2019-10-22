@extends('layouts.app-template')

@section('title')
    Listar Tipos de Saida
@stop

@section('content')
	
	<sub-cabecalho :lista=
	    "[
	        {
	            'nome' : 'Financeiro',
	            'link' : '',
	        },
			{
	            'nome' : 'Lista de saída',
	            'link' : '{{ url('financeiro/saida') }}',
	        }	        
	    ]">
    </sub-cabecalho>

	<lista-saida><lista-saida>
	
@endsection