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
	            'nome' : 'Locais de trabalho',
	            'link' : '',
	        }
	    ]">
    </sub-cabecalho>

	<lista-locais-trabalho dados="{{ $locaisDeTrabalho }}"></lista-locais-trabalho>

@endsection
