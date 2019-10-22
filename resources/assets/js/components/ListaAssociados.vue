<template>
    <div id="lista-associados">
        <div class="m-content">
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Lista de associados
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">
                                <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
                                    <a :href="this.urlBase + '/associados/cadastro-de-associado'" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
                                        <span>
                                            <i class="la la-plus"></i>
                                            <span>
                                                Novo associado
                                            </span>
                                        </span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="form-group row col-md-2">
                        <select class="form-control m-input m-input--square" v-model="filtro_associados" @change="redirectAssociado">
                            <option value="ativos">Ativos</option>
                            <option value="inativos">Inativos</option>
                        </select>
                    </div>
                    <div id="local_data">
                        <table class="table table-bordered table-hover siga-data-table">
                            <thead>
                                <tr>
                                    <th>
                                        Nome
                                    </th>
                                    <th>
                                        Área atuação
                                    </th>
                                    <th>
                                        Data de associação
                                    </th>
                                    <th class="text-center">
                                        Ação
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-if="listaAssociados.length == 0" >
                                    <tr class="text-center">
                                        <td colspan="4">Nenhum registro encontrado</td>
                                    </tr>
                                </template>
                                <template v-else v-for="associado in listaAssociados">
                                    <tr class="clickable" :title="'Ver perfil de ' + associado.nome">
                                        <td @click="redirecionarParaPerfil(associado)">
                                            {{ associado.nome }}
                                        </td>
                                        <td @click="redirecionarParaPerfil(associado)">
                                            {{ associado.area_atuacao }}
                                        </td>
                                        <td @click="redirecionarParaPerfil(associado)">
                                            {{ associado.data_associacao }}
                                        </td>
                                        <td class="text-center">
                                            <template v-if="filtro_associados == 'ativos'">                                            
                                                <a :href="this.urlBase + '/associados/editar-associado/' + associado.associado_id" data-toggle="tooltip" data-placement="top" :title="'Editar dados de ' + associado.nome" class="btn btn-sm btn-primary m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
                                                    <i class="la la-edit"></i>
                                                </a>

                                                <button type="submit" @click="excluirAssociado(associado.associado_id)" data-toggle="tooltip" data-placement="top" :title="'Desativar ' + associado.nome" class="btn btn-sm btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
                                                    <i class="la la-ban"></i>
                                                </button>
                                            </template>

                                            <button v-if="!bol_filtrando && listaAssociados.length > 0 && filtro_associados == 'inativos'" type="submit" @click="restaurarAssociado(associado.associado_id, associado.nome)" data-toggle="tooltip" data-placement="top" :title="'Restaurar ' + associado.nome" class="btn btn-sm btn-success m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
                                                <i class="la la-refresh"></i>
                                            </button>
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
        props : ['dados', 'status'],
        name: 'lista-associados',
        data() {
            return {
                urlBase: urlBase,
                listaAssociados: [],
                filtro_associados: status,
                bol_filtrando: false
            }
        },
        methods : {
            getAssociados: function(){
                this.listaAssociados = [];
                var status = this.filtro_associados == 'inativos'? 0 : 1;
                this.$http.get(this.urlBase+'/api/lista-de-associados/'+status).then(response => {
                    this.listaAssociados = response.data;
                });
            },
            redirectAssociado: function(){
                this.bol_filtrando = true;
                window.location.href = this.urlBase + "/associados/lista-de-associados/"+this.filtro_associados;
            },
            excluirAssociado: function(associado_id) {
                var dados = { associado_id: associado_id };

                Swal({
                    title: 'Realmente deseja desativar este associado?',
                    type: 'question',
                    showCancelButton: true,
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                        return this.$http.post(this.urlBase+'/associados/excluir-associado', dados).then((response) => {
                            this.retorno = response.body;
                            this.status_requisicao = true;
                        }, response => {
                            this.status_requisicao = false;
                            this.retorno = response.body;
                        });
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    this.getAssociados();

                    return Swal({
                        type: this.retorno.status,
                        title: this.retorno.msg,
                        preConfirm: () => {
                            window.location.href = this.urlBase + "/associados/lista-de-associados/"+this.filtro_associados;
                        }
                    });
                }).catch(Swal.noop)
            },
            restaurarAssociado: function(associado_id, nome) {
                var dados = { associado_id: associado_id };

                Swal({
                    title: 'Realmente deseja restaurar ' + nome + '?',
                    type: 'question',
                    showCancelButton: true,
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                        return this.$http.post(this.urlBase+'/associados/restaurar-associado', dados).then((response) => {
                            this.retorno = response.body;
                            this.status_requisicao = true;
                        }, response => {
                            this.status_requisicao = false;
                            this.retorno = response.body;
                        });
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    this.getAssociados();

                    return Swal({
                        type: this.retorno.status,
                        title: this.retorno.msg,
                        preConfirm: () => {
                            window.location.href = this.urlBase + "/associados/lista-de-associados/"+this.filtro_associados;
                        }
                    });
                }).catch(Swal.noop)
            },
            redirecionarParaPerfil : function(associado){
                window.location.href = this.urlBase + "/associados/perfil-associado/" + associado.associado_id + "/" + associado.nome_para_url;
            },
            checkEdit : function() {
                var dados = null;

                if (this.dados) {
                    dados = JSON.parse(this.dados);
                    this.listaAssociados = dados;
                }
                this.filtro_associados = this.status;
            },
        },
        mounted () {
            this.checkEdit();
        },
    };
</script>

<style scoped>
</style>
