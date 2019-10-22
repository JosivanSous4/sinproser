@extends('layouts.app-template')

@section('title')
    Editar local de trabalho
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
	            'nome' : 'Editar local de trabalho',
	            'link' : '',
	        }
	    ]">
    </sub-cabecalho>

    <form-local-de-trabalho local_trabalho="{{ $localDeTrabalho }}"></form-local-de-trabalho>

@endsection
