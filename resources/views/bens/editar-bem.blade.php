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
	            'nome' : 'Editar Bem',
	            'link' : '#',
	        }
	    ]">
    </sub-cabecalho>

	<form-bens dados="{{ $produto }}"></form-bens>

@endsection