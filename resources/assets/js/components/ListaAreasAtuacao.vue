<template>
    <div id="ListaAreasAtuacao">
        <div class="m-content">
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Áreas de atuação
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">
                                <a :href="urlBase+'/configuracoes/cadastro/areas-de-atuacao/cadastrar-area-atuacao'" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
                                    <span>
                                        <i class="la la-plus"></i>
                                        <span>
                                            Nova Área de Atuação
                                        </span>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <table class="table table-striped- table-bordered table-hover table-checkable">
                        <thead>
                            <tr>
                                <th>
                                    Cod
                                </th>
                                <th>
                                    Nome
                                </th>
                                <th>
                                    Descrição
                                </th>
                                <th class="text-center">
                                    Dia previsto para pagamento
                                </th>
                                <th class="text-center">
                                    Usuário criador
                                </th>
                                <th class="text-center">
                                    Ação
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="area_atuacao in areas_atuacao">
                                <td class="align-middle">
                                    {{area_atuacao.area_atuacao_id}}
                                </td>
                                <td class="align-middle">
                                    {{area_atuacao.nome}}
                                </td>
                                <td class="align-middle">
                                    {{area_atuacao.descricao}}
                                </td>
                                <td class="align-middle">
                                    {{area_atuacao.dia_previsto_pagamento}} <small>de cada mês</small>
                                </td>
                                <td class="align-middle">
                                    {{area_atuacao.has_usuario_criador.name}}
                                </td>
                                <td nowrap="" style="" class="text-center align-middle">
                                    <a :href="urlBase+'/configuracoes/cadastro/areas-de-atuacao/editar-area-atuacao/'+area_atuacao.area_atuacao_id" class="btn btn-primary m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
                                        <i class="la la-edit"></i>
                                    </a>
                                    <a href="#" @click="excluirAreaAtuacao(area_atuacao.area_atuacao_id)" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
                                        <i class="la la-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>                
    </div>
</template>

<script>
    export default {
        name: 'ListaTipopagamento',
        props: ['dados'],
        data() {
            return {
                areas_atuacao : [],
                urlBase       : urlBase,
                retorno : {}
            }
        },
        methods : {
            getAreasAtuacao : function() {
                this.$http.get(this.urlBase+'/api/areas-atuacao').then(response => {
                    this.areas_atuacao = response.data;
                });
            },
            excluirAreaAtuacao: function(area_atuacao_id) {

                var dados = { area_atuacao_id: area_atuacao_id };
                let url = urlBase + "/configuracoes/cadastro/areas-de-atuacao/excluir-area-atuacao";
                
                Swal({
                    title: 'Realmente deseja excluir esta área de atuação?',
                    type: 'question',
                    showCancelButton: true,
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                        return this.$http.post(url, dados).then((response) => {
                            this.retorno = response.body;
                        }, response => {
                            this.retorno = response.body;
                        });
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    this.getAreasAtuacao();
                    return Swal({
                        type: this.retorno.status,
                        title: this.retorno.msg,
                    });
                }).catch(Swal.noop)
            }
        },
        created () {
            this.getAreasAtuacao();
        },
    };
</script>

<style scoped>

</style>