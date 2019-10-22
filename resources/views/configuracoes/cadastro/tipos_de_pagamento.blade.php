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
	            'link' : '',
	        }
	    ]">
    </sub-cabecalho>

	<lista-tipos-pagamento dados="{{ $tiposDePagamento }}"></lista-tipos-pagamento>

@endsection
