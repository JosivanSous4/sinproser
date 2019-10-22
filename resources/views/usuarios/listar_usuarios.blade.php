@extends('layouts.app-template')

@section('title')
    Listar Tipos de Saida
@stop

@section('content')

	<sub-cabecalho :lista=
	    "[
	        {
	            'nome' : 'Usuario',
	            'link' : '',
	        }
	    ]">
    </sub-cabecalho>

	<lista-usuario dados="{{ $usuarios }}"><lista-usuario>

@endsection
