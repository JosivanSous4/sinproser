@extends('layouts.app-template')

@section('title')
    Dashboard
@stop

@section('content')

	<sub-cabecalho titulo="Início" :lista="[{'nome' : 'Início', 'link' : '/'}]"></sub-cabecalho>

	<dashboard dados_grafico_rendimento="{{ json_encode($dadosGraficoRendimento) }}" dados_grafico_adimplencia="{{ json_encode($dadosGraficoAdimplencia) }}" lista_anos="{{ json_encode($listaAnos) }}"></dashboard>

@endsection