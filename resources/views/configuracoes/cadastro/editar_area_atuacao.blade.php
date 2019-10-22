@extends('layouts.app-template')

@section('title')
    Tipos de Pagamento
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
	            'nome' : 'Áreas de Atuação',
	            'link' : '{{ url('/configuracoes/cadastro/areas-de-atuacao') }}',
	        },
	        {
	            'nome' : 'Atualizar Área de Atuação',
	            'link' : '',
	        }
	    ]">
    </sub-cabecalho>

	<form-area-atuacao dados="{{ $areaAruacao }}"></form-area-atuacao>

@endsection