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
                'nome' : 'Parceiros',
                'link' : '{{ url('configuracoes/gerenciar-site/parceiros') }}',
            }
        ]">
    </sub-cabecalho>
	<lista-parceiro><lista-parceiro>

@endsection
