@extends('layouts.app-template')

@section('title')
    Cadastrar Tipos de Entrada
@stop

@section('content')

	<sub-cabecalho :lista=
	    "[
	        {
	            'nome' : 'Configurações',
	            'link' : '#',
	        },
	        {
	            'nome' : 'Cadastro',
	            'link' : '{{ url('configuracoes/cadastro') }}'
	        },
	        {
	            'nome' : 'Cadastro de tipo de entrada',
	            'link' : '',
	        }
	    ]">
    </sub-cabecalho>

	<form-tipo-entrada :tipoentrada="{{$tiposEntrada}}"></form-tipo-entrada>

@endsection