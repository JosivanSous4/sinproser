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
                'nome' : 'Diretores',
                'link' : '{{ url('configuracoes/gerenciar-site/diretor') }}',
            }
        ]">
    </sub-cabecalho>

	<lista-diretor><lista-diretor>

@endsection
