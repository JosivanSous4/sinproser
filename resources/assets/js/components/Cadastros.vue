<template>
    <div id="OpcoesFormulario">
        <div class="m-content">
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Cadastre algumas opções para seus formulários
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="row form-group">
                        <div class="col-md-4 text-right">
                            <a :href="urlBase+'/configuracoes/cadastro/locais-de-trabalho'" class="btn btn-primary m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
                                <span>
                                    <i class="la la-plus"></i>
                                    <span>
                                        Locais de trabalho
                                    </span>
                                </span>
                            </a>
                        </div>

                        <div class="col-md-4 text-center">
                            <a :href="urlBase+'/configuracoes/cadastro/tipos-de-pagamento'" class="btn btn-success m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
                                <span>
                                    <i class="la la-plus"></i>
                                    <span>
                                        Tipos de pagamento
                                    </span>
                                </span>
                            </a>
                        </div>

                        <div class="col-md-4 text-left">
                            <a :href="urlBase+'/configuracoes/cadastro/tipos-de-entrada'" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
                                <span>
                                    <i class="la la-plus"></i>
                                    <span>
                                        Tipos de entrada
                                    </span>
                                </span>
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 text-right">
                            <a :href="urlBase+'/configuracoes/cadastro/tipos-de-saida'" class="btn btn-info m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
                                <span>
                                    <i class="la la-plus"></i>
                                    <span>
                                        Tipos de saída
                                    </span>
                                </span>
                            </a>
                        </div>

                        <div class="col-md-4 text-center">
                            <a :href="urlBase+'/configuracoes/cadastro/areas-de-atuacao'" class="btn btn-warning m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
                                <span>
                                    <i class="la la-plus"></i>
                                    <span>
                                        Áreas de atuacao
                                    </span>
                                </span>
                            </a>
                        </div>

                        <div class="col-md-4 text-left">
                            <a :href="urlBase+'/configuracoes/cadastro/tipos-de-formacoes'" class="btn btn-danger m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
                                <span>
                                    <i class="la la-plus"></i>
                                    <span>
                                        Tipos de formações
                                    </span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>                
    </div>
</template>

<script>
    export default {
        name: 'OpcoesFormulario',
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