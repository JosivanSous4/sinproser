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
                'nome' : 'Links Úteis',
                'link' : '{{ url('configuracoes/gerenciar-site/links-uteis') }}',
            },
            {
                'nome' : 'Cadastro de link',
                'link' : '{{ url('configuracoes/gerenciar-site/links-uteis/form-link') }}',
            }
        ]">
    </sub-cabecalho>

    @if($link)
        <form-link-util :dados="{{$link}}"></form-link-util>
    @else
        <form-link-util></form-link-util>
    @endif

@endsection
