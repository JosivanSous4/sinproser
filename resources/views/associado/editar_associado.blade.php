@extends('layouts.app-template')

@section('title')
    Editar dados de {{ $associado->hasDadosPessoais->nome }}
@stop

@section('content')

    <sub-cabecalho :lista=
	    "[
	        {
	            'nome' : 'Associados',
	            'link' : '{{ url('associados/lista-de-associados') }}',
	        },
	        {
	            'nome' : 'Editar associado',
	            'link' : '',
	        }
	    ]">
    </sub-cabecalho>

	<form-associado dados_associado="{{ $associado }}"></form-associado>

@endsection
