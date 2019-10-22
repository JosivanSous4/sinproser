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
                'nome' : 'Parceiros',
                'link' : '{{ url('configuracoes/gerenciar-site/parceiros') }}',
            },
            {
                'nome' : 'Cadastro de parceiro',
                'link' : '{{ url('configuracoes/gerenciar-site/parceiros/form-parceiro') }}',
            }
        ]">
    </sub-cabecalho>

    @if($parceiro)
        <form-parceiro :dados="{{$parceiro}}"></form-parceiro>
    @else
        <form-parceiro></form-parceiro>
    @endif

@endsection
