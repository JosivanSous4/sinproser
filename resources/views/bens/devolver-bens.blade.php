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
	            'nome' : 'Devolução de bens',
	            'link' : '/bens/emprestar-bens',
	        }
	    ]">
    </sub-cabecalho>

	<devolucao-bens :dados="{{$emprestimo}}"></devolucao-bens>

@endsection
