@extends('layouts.app-template')

@section('title')
    Listar Associados
@stop

@section('script-inferior')
	<script src="{{asset('/assets/demo/default/custom/crud/metronic-datatable/base/data-local.js')}}" type="text/javascript"></script>
@endsection

@section('content')

	@include('alerts.alerts')
    
    <sub-cabecalho :lista=
	    "[
	        {
	            'nome' : 'Associados',
	            'link' : '{{ url('associados/lista-de-associados') }}',
	        },
	        {
	            'nome' : 'Lista de associados',
	            'link' : '',
	        }
	    ]">
    </sub-cabecalho>
	
    <lista-associados dados="{{ $associados }}" status="{{ $status }}"></lista-associados>

@endsection