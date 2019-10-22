@extends('layouts.app-template')

@section('title')
    Lista de Locais de Trabalho
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
	        }
	    ]">
    </sub-cabecalho>

	<lista-tipos-formacoes></lista-tipos-formacoes>

@endsection
