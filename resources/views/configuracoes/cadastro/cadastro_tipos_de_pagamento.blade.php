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
	            'nome' : 'Tipos de Pagamento',
	            'link' : '{{ url('configuracoes/cadastro/tipos-de-pagamento') }}',
	        },
	        {
	            'nome' : 'Cadastro de Tipo de Pagamento',
	            'link' : '#',
	        }
	    ]">
    </sub-cabecalho>

	<form-tipo-pagamento></form-tipo-pagamento>

@endsection
