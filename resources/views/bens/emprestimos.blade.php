@extends('layouts.app-template')

@section('title')
    Listar Bens
@stop

@section('content')

    <sub-cabecalho :lista=
	    "[
	        {
	            'nome' : 'Bens',
	            'link' : '/bens',
	        },
	        {
	            'nome' : 'Emprestimos',
	            'link' : '/bens/emprestimos',
	        }
	    ]">
    </sub-cabecalho>

	<lista-emprestimos></lista-emprestimos>

@endsection