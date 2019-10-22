<template>
    <div id="ListaTiposFormacoes">
        <div class="m-content">
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Tipos de Formações
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">
                                <a :href="urlBase+'/configuracoes/cadastro/tipos-de-formacoes/cadastrar-tipo-formacao'" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
                                    <span>
                                        <i class="la la-plus"></i>
                                        <span>
                                            Novo tipo de formação
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
                                    Ação
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-if="listaFormacoes.length">
                                <tr v-for="formacao in listaFormacoes">
                                    <td class="align-middle">
                                        {{formacao.tipo_formacao_id}}
                                    </td>
                                    <td class="align-middle">
                                        {{formacao.nome}}
                                    </td>
                                    <td class="align-middle">
                                        {{formacao.descricao}}
                                    </td>
                                    <td nowrap="" style="" class="text-center align-middle">
                                        <a :href="urlBase+'/configuracoes/cadastro/tipos-de-formacoes/editar-tipo-formacao/'+formacao.tipo_formacao_id" class="btn btn-primary m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
                                            <i class="la la-edit"></i>
                                        </a>
                                        <a href="#" @click="excluirTipoFormacao(formacao.tipo_formacao_id)" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
                                            <i class="la la-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>                
    </div>
</template>

<script>
    export default {
        name: 'ListaTiposFormacoes',
        data() {
            return {
                listaFormacoes : '',
                urlBase       : urlBase,
                retorno : {}
            }
        },
        methods : {
            getTiposFormacoes : function() {
                this.$http.get(urlBase+'/api/tipos-formacoes').then(response => {
                    this.listaFormacoes = response.data;
                    console.log(this.listaFormacoes);
                });
            },
            excluirTipoFormacao: function(tipo_formacao_id) {

                var dados = { tipo_formacao_id: tipo_formacao_id };
                let url = urlBase + "/configuracoes/cadastro/tipos-de-pagamento/excluir-tipo-pagamento";
                
                Swal({
                    title: 'Realmente deseja excluir este tipo de formação?',
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
                    this.getTiposFormacoes();
                    return Swal({
                        type: this.retorno.status,
                        title: this.retorno.msg,
                    });
                }).catch(Swal.noop)
            }
        },
        created () {
            this.getTiposFormacoes();
        },
    };
</script>

<style scoped>

</style>