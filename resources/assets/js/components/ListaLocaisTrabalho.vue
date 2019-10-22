<template>
    <div id="listaLocaisDeTrabalho">
        <div class="m-content">
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Lista de locais de trabalho
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">
                                <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
                                    <a :href="urlBase + '/configuracoes/cadastro/locais-de-trabalho/cadastro-de-local-de-trabalho'" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
                                        <span>
                                            <i class="la la-plus"></i>
                                            <span>
                                                Novo local de trabalho
                                            </span>
                                        </span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div id="local_data">
                        <table class="table table-bordered table-hover siga-data-table">
                            <thead>
                                <tr>
                                    <th>
                                        Local de trabalho
                                    </th>
                                    <th class="text-center">
                                        Ação
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-if="listaLocaisTrabalho.length">
                                    <tr class="clickable" v-for="localTrabalho in listaLocaisTrabalho">
                                        <td v-html="localTrabalho.strLocalTrabalho"></td>
                                        <td class="text-center">
                                            <a :href="this.urlBase + '/configuracoes/cadastro/locais-de-trabalho/editar-local-de-trabalho/' + localTrabalho.local_de_trabalho_id" data-toggle="tooltip" data-placement="top" title="Editar dados deste local de trabalho" class="btn btn-primary m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
                                                <i class="la la-edit"></i>
                                            </a>

                                            <button type="submit" @click="excluirLocalDeTrabalho(localTrabalho.local_de_trabalho_id)" data-toggle="tooltip" data-placement="top" title="Excluir este local de trabalho" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
                                                <i class="la la-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </template>
                                <template v-else>
                                    <tr>
                                        <td colspan="2" class="text-center">
                                            <h3 class="mensagem-info-tabela">Registre locais de trabalho</h3>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props : ['dados'],
        name: 'listaLocaisDeTrabalho',
        data() {
            return {
                urlBase : urlBase,
                listaLocaisTrabalho: []
            }
        },
        methods : {
            getLocaisDeTrabalho: function(){
                this.$http.get(this.urlBase + '/api/locais-de-trabalho').then(response => {
                    this.listaLocaisTrabalho = response.data;
                });
            },
            excluirLocalDeTrabalho: function(localTrabalhoId) {
                localTrabalhoId = {local_de_trabalho_id: localTrabalhoId };
                Swal({
                    title: 'Realmente deseja excluir este local de trabalho?',
                    type: 'question',
                    showCancelButton: true,
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                        return this.$http.post(this.urlBase+'/configuracoes/cadastro/locais-de-trabalho/excluir-local-de-trabalho', localTrabalhoId).then((response) => {
                            this.retorno = response.body;
                            this.status_requisicao = true;
                        }, response => {
                            this.status_requisicao = false;
                            this.retorno = response.body;
                        });
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    this.getLocaisDeTrabalho();

                    return Swal({
                        type: this.retorno.status,
                        title: this.retorno.msg,
                    });
                }).catch(Swal.noop)
            },
            checkEdit : function() {
                var dados = null;

                if (this.dados) {
                    dados = JSON.parse(this.dados);
                    this.listaLocaisTrabalho = dados;
                }
            },
        },
        mounted () {
            this.checkEdit();
        },
    };
</script>

<style scoped>
</style>
