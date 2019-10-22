@extends('layouts.app-template')

@section('title')
    Cadastrar Local de Trabalho
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
	            'nome' : 'Tipos de Formações',
	            'link' : '{{ url('configuracoes/cadastro/tipos-de-formacoes') }}',
	        },
	        {
	            'nome' : 'Cadastro de Tipo de Formação',
	            'link' : '',
	        }
	    ]">
    </sub-cabecalho>

	<form-tipo-formacao></form-tipo-formacao>

@endsection
