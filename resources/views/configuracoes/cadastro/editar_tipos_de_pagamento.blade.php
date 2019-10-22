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
	            'nome' : 'Editar Tipos de Pagamento',
	            'link' : '',
	        }
	    ]">
    </sub-cabecalho>

	<form-tipo-pagamento dados="{{ $tipoDePagamento }}"></form-tipo-pagamento>

@endsection
