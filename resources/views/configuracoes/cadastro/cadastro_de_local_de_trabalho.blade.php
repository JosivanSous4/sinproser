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
	            'nome' : 'Locais de trabalho',
	            'link' : '{{ url('/configuracoes/cadastro/locais-de-trabalho') }}',
	        },
	        {
	            'nome' : 'Cadastro de local de trabalho',
	            'link' : '',
	        }
	    ]">
    </sub-cabecalho>

	<form-local-de-trabalho></form-local-de-trabalho>

@endsection
