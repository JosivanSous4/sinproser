@extends('layouts.app-template')

@section('title')
    Cadastrar Tipos de Entrada
@stop

@section('content')
	<sub-cabecalho :lista=
	    "[
	        {
	            'nome' : 'Usuario',
	            'link' : '#',
	        },
	        {
	            'nome' : 'Cadastro de usuário',
	            'link' : '',
	        }
	    ]">
    </sub-cabecalho>
	<form-usuario :usuario_dados="{{$usuario}}"></form-usuario>

@endsection
