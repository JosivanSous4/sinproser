<template>
    <div id="ListaTipoPagamento">
        <div class="m-content">
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Tipos de pagamento
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">
                                <a :href="urlBase+'/configuracoes/cadastro/tipos-de-pagamento/cadastrar-tipo-pagamento'" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
                                    <span>
                                        <i class="la la-plus"></i>
                                        <span>
                                            Novo tipo de pagamento
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
                            <tr v-for="tipo in tipos_pagamento">
                                <td class="align-middle">
                                    {{tipo.tipo_pagamento_id}}
                                </td>
                                <td class="align-middle">
                                    {{tipo.nome}}
                                </td>
                                <td class="align-middle">
                                    {{tipo.descricao}}
                                </td>
                                <td nowrap="" style="" class="text-center align-middle">
                                    <a :href="urlBase+'/configuracoes/cadastro/tipos-de-pagamento/editar-tipo-pagamento/'+tipo.tipo_pagamento_id" class="btn btn-primary m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
                                        <i class="la la-edit"></i>
                                    </a>
                                    <a href="#" @click="excluirTipoPagamento(tipo.tipo_pagamento_id)" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
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
                tipos_pagamento : [],
                urlBase       : urlBase,
                retorno : {}
            }
        },
        methods : {
            getTipospagamento: function() {
                self = this;

                let url = urlBase+"/api/tipos-pagamento";
                
                self.$http.get(url, self.tipo_entrada).then((response) => {
                    self.tipos_pagamento = response.body;
                }, response => {
                    return self.$swal({
                        type: self.response.status,
                        title: self.response.msg,
                    });
                });
            },
            excluirTipoPagamento: function(tipo_pagamento_id) {

                var dados = { tipo_pagamento_id: tipo_pagamento_id };
                let url = urlBase + "/configuracoes/cadastro/tipos-de-pagamento/excluir-tipo-pagamento";
                
                Swal({
                    title: 'Realmente deseja excluir este tipo de pagamento?',
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
                    this.getTipospagamento();
                    return Swal({
                        type: this.retorno.status,
                        title: this.retorno.msg,
                    });
                }).catch(Swal.noop)
            }
        },
        created () {
            this.getTipospagamento();
        },
    };
</script>

<style scoped>

</style>