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
	            'nome' : 'Tipos de Formações',
	            'link' : '{{ url('/configuracoes/cadastro/tipos-de-formacoes') }}',
	        },
	        {
	            'nome' : 'Editar Tipo de Formação',
	            'link' : '',
	        }
	    ]">
    </sub-cabecalho>

	<form-tipo-formacao dados="{{ $tipoFormacao }}"></form-tipo-formacao>

@endsection
