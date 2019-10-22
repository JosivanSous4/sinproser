@extends('layouts.app-template')

@section('title')
    Listar Associados
@stop

@section('script-inferior')
	<script src="{{asset('/assets/demo/default/custom/crud/metronic-datatable/base/data-local.js')}}" type="text/javascript"></script>
@endsection

@section('content')

    <sub-cabecalho :lista=
	    "[
	        {
	            'nome' : 'Associados',
	            'link' : '{{ url('associados/lista-de-associados') }}',
	        },
	        {
	            'nome' : 'Perfil',
	            'link' : '',
	        },
	        {
	            'nome' : '{{ $associado->hasDadosPessoais->nome }}',
	            'link' : '',
	        }
	    ]">
    </sub-cabecalho>

    <perfil-associado dados="{{ $associado }}"></perfil-associado>

@endsection