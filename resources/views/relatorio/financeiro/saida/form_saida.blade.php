@extends('layouts.app-template')

@section('title')
    Cadastrar Tipos de Entrada
@stop

@section('content')
	<sub-cabecalho :lista=
	    "[
	        {
	            'nome' : 'Relatório',
	            'link' : '#',
	        },
	        {
	            'nome' : 'Financeiro',
	            'link' : '',
	        },
	        {
	            'nome' : 'Saída',
	            'link' : '',
	        }
	    ]">
    </sub-cabecalho>

	<relatorio-saida></relatorio-saida>

@endsection
