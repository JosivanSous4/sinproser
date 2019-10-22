@extends('layouts.app-template')

@section('title')
    Emprestar Bens
@stop

@section('content')

    <sub-cabecalho :lista=
	    "[
	        {
	            'nome' : 'Bens',
	            'link' : '/bens',
	        },
	        {
	            'nome' : 'Empréstimo de Bens',
	            'link' : '/bens/emprestar-bens',
	        }
	    ]">
    </sub-cabecalho>

	<emprestar-bens dados="{{ $produto }}"></emprestar-bens>

@endsection
