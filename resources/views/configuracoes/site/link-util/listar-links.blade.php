@extends('layouts.app-template')

@section('title')
    Listar Tipos de Entrada
@stop

@section('content')

    <sub-cabecalho :lista=
        "[
            {
                'nome' : 'Configurações',
                'link' : '#',
            },
            {
                'nome' : 'Gerenciamento do Site',
                'link' : '{{ url('configuracoes/gerenciar-site') }}'
            },
            {
                'nome' : 'Links úteis',
                'link' : '{{ url('configuracoes/gerenciar-site/links-uteis') }}',
            }
        ]">
    </sub-cabecalho>

	<lista-link-util><lista-link-util>

@endsection
