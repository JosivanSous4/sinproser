@extends('layouts.app-template')

@section('title')
    Cadastrar Associado
@stop

@section('content')

    <sub-cabecalho :lista=
	    "[
	        {
	            'nome' : 'Associados',
	            'link' : '{{ url('associados/lista-de-associados') }}',
	        },
	        {
	            'nome' : 'Cadastro de associado',
	            'link' : '',
	        }
	    ]">
    </sub-cabecalho>

	<form-associado></form-associado>

@endsection