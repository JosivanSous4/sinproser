@extends('layouts.app-template')

@section('title')
    Cadastrar Tipos de Entrada
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
            },
            {
                'nome' : 'Cadastro de diretor',
                'link' : '{{ url('configuracoes/gerenciar-site/diretor/form-diretor') }}',
            }
        ]">
    </sub-cabecalho>

    @if($diretor)
        <form-diretor :dados="{{$diretor}}"></form-diretor>
    @else
        <form-diretor></form-diretor>
    @endif

@endsection
