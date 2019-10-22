@extends('layouts.app-template')

@section('title')
    Listar Associados
@stop

@section('content')

    <sub-cabecalho :lista=
	    "[
	        {
	            'nome' : 'Configurações',
	            'link' : '#',
	        },
	        {
	            'nome' : 'Gerenciamento do Site',
	            'link' : '{{ url('configuracoes/gerenciar-site') }}'
	        }
	    ]">
    </sub-cabecalho>

	<cadastros-site></cadastros-site>

@endsection
