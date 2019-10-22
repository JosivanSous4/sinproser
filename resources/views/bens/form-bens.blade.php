@extends('layouts.app-template')

@section('title')
    Cadastrar Bem
@stop

@section('content')

    <sub-cabecalho :lista=
	    "[
	        {
	            'nome' : 'Bens',
	            'link' : '/bens',
	        },
	        {
	            'nome' : 'Cadastro de Bens',
	            'link' : '#',
	        }
	    ]">
    </sub-cabecalho>

	<form-bens></form-bens>

@endsection
