<template>
    <div id="RelatorioEntrada">
        <div class="m-content">
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet m-portlet--head-solid-bg m-portlet--rounded">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Relatório de entrada
                                </h3>
                            </div>
                        </div>
                    </div>

                    <form class="m-form" ref="relatorioEntrada" :action="urlBase+'/relatorio/financeiro/entrada/busca'">
                        <div class="m-portlet__body">
                            <div class="m-form__group form-group" >
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label>
                                            Tipo de entrada:
                                        </label>
                                        <select  class="form-control m-input text-uppercase" name="tipo_entrada_id" v-model="pesquisar.tipo_entrada_id" id="exampleSelect1">
                                            <option v-for="tipo_entrada in tipo_entradas" :value="tipo_entrada.tipo_entrada_id">
                                                {{tipo_entrada.nome}}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="">
                                            Pagador associado?
                                        </label>
                                        <div class="m-radio-inline">
                                            <label class="m-radio">
                                                <input type="radio" v-model="pesquisar.tipo_pagador" name="tipo_pagador" :value="1">
                                                Sim
                                                <span></span>
                                            </label>
                                            <label class="m-radio">
                                                <input type="radio" v-model="pesquisar.tipo_pagador" name="tipo_pagador" :value="2">
                                                Não
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-5" v-if="pesquisar.tipo_pagador">
                                        <label>
                                            Selecione o associado:
                                        </label>
                                        <select class="form-control m-input text-uppercase" name="associado_id" v-model="pesquisar.associado_id" id="exampleSelect1">
                                            <option value="">-- SELECIONE O ASSOCIADO --</option>
                                            <option v-for="associado in associados" :value="associado.associado_id">
                                                {{associado.nome}}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-lg-5" v-if="!pesquisar.tipo_pagador">
                                        <label>
                                            Digite o nome do pagador:
                                        </label>
                                        <input type="text" v-model="pesquisar.pagador" name="pagador" class="form-control m-input" placeholder="Digite o nome">
                                    </div>
                                </div>
                            </div>
                            <div class="m-form__group form-group" style="padding-top: 0px;">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label>
                                            Status da entrada:
                                        </label>
                                        <select class="form-control m-input text-uppercase" name="status_id" v-model="pesquisar.status_id">
                                            <option v-for="statu in status" :value="statu.status_id">{{statu.status}}</option>
                                        </select>
                                    </div>
                                    <!-- <div class="col-lg-6">
                                        <label>
                                            Mês de referência:
                                        </label>
                                        <input type="text" v-model="pesquisar.competencia" name="competencia" class="form-control m-input" placeholder="MM/AAAA">
                                    </div> -->
                                    <div class="col-lg-6">
                                        <label>
                                            Mês de referência:
                                        </label>
                                        <!-- <input type='month' v-model="competencia" class="form-control m-input" placeholder="MM/AAAA"> -->
                                        <div class="input-daterange input-group" id="m_datepicker_5">
                                            <input type='month' v-model="competenciaInicio" class="form-control m-input" name="competenciaInicio">
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    à
                                                </span>
                                            </div>
                                            <input type='month' v-model="competenciaFim" class="form-control" name="competenciaFim">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="m-form__actions m-form__actions" style="padding-top: 0px;">
                            <button type="button" @click="pesquisarEntrada()"class="btn btn-primary">
                                Pesquisar
                            </button>
                            <button type="button" @click="fecharPesquisa()" class="btn btn-danger">
                                Limpar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'RelatorioEntrada',
        data() {
            return {
                showFilter : false,
                entradas : [],
                urlBase       : urlBase,
                associados    : [],
                status        : [],
                pagamento : {
                    entrada_id     : '',
                    data_pagamento : '',
                },
                pesquisar : {
                    tipo_entrada_id : '',
                    tipo_pagador : null,
                    associado_id : '',
                    pagador      : '',
                    status_id    : '',
                    // competencia  : '',
                    competenciaInicio : '',
                    competenciaFim    : '',
                },
                retorno : '',
                competenciaInicio : '',
                competenciaFim : '',
            }
        },
        methods : {
            fecharPesquisa : function(){
                this.showFilter                 = !this.showFilter;
                this.pesquisar.tipo_entrada_id  = '';
                this.pesquisar.tipo_pagador     = null;
                this.pesquisar.associado_id     = '';
                this.pesquisar.pagador          = '';
                this.pesquisar.status_id        = '';
                this.pesquisar.competencia      = '';
            },
            excluirEntrada : function(entrada) {
                self = this;
                let url = urlBase+"/financeiro/entrada/excluir";

                Swal({
                    title: 'Excluir entrada?',
                    type: 'question',
                    inputAttributes: {
                        autocapitalize: 'off'
                    },
                    showCancelButton: true,
                    confirmButtonText: 'Sim',
                    showLoaderOnConfirm: true,
                    preConfirm: (login) => {
                        return self.$http.post(url, entrada).then((response) => {
                            self.retorno = response.body;
                            self.formRequest = {};
                            self.getEntrada();
                        }, response => {
                            var form = response.body;
                            self.formRequest = form;
                            self.retorno = 0;
                        });
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    if (self.retorno == 0) {

                        var msg = self.formErros(self.formRequest);

                        return Swal({
                            type: 'error',
                            title: 'Oops...',
                            text: 'Há campos em brancos!',
                        });
                    }

                    if (self.retorno) {
                        return Swal({
                            type: self.retorno.status,
                            title: self.retorno.msg,
                        });
                    }
                })
            },
            pesquisarEntrada : function(){
                let self = this;
                let url = urlBase+"/relatorio/financeiro/entrada";

                // self.pesquisar.competenciaInicio = moment(self.competenciaInicio).format('YYYY-MM-DD')
                // self.pesquisar.competenciaFim    = moment(self.competenciaFim).format('YYYY-MM-DD')


                this.$refs.relatorioEntrada.submit();

                // this.$http.get(url, {params: self.pesquisar}).then(response => {
                //     self.entradas = response.body;
                // }, response => {
                //     return Swal({
                //         type: response.body.status,
                //         title: response.body.msg,
                //     });
                // });
            },
            modalBaixa : function(id){
                self = this;
                // console.log(id);
                self.pagamento.entrada_id = id;
            },
            darBaixa : function(){
                let self = this;

                let url = urlBase+"/financeiro/baixa";

                Swal({
                    title: "Registrar pagamento?",
                    type: 'question',
                    showCancelButton: true,
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                        return self.$http.post(url, self.pagamento).then((response) => {
                            self.retorno = response.body;
                            self.getEntrada();
                        }, response => {
                            return Swal({
                                type: self.retorno.status,
                                title: self.retorno.msg,
                            });
                        });
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    if (self.retorno) {
                        return Swal({
                            type: self.retorno.status,
                            title: self.retorno.msg,
                        });
                    }

                }).catch(Swal.noop)
            },
            getEntrada: function() {
                self = this;

                let url = urlBase+"/api/entradas";

                self.$http.get(url).then((response) => {
                    self.entradas = response.body;
                }, response => {
                    return self.$swal({
                        type: self.response.status,
                        title: self.response.msg,
                    });
                });
            },
            getTiposEntrada: function() {
                self = this;

                let url = urlBase+"/api/tipos-entrada";

                self.$http.get(url).then((response) => {
                    self.tipo_entradas = response.body;
                }, response => {
                    return self.$swal({
                        type: self.response.status,
                        title: self.response.msg,
                    });
                });
            },
            getStatusFinanceiro : function(){
                self = this;

                let url = urlBase+"/financeiro/entrada/get-status";

                self.$http.get(url).then((response) => {
                    self.status = response.body;
                }, response => {
                    return self.$swal({
                        type: self.response.status,
                        title: self.response.msg,
                    });
                });
            },
            getAssociados: function(){
                this.$http.get(urlBase+'/api/lista-de-associados').then(response => {
                    this.associados = response.data;
                });
            },
        },
        created () {
            this.getEntrada();
            this.getTiposEntrada();
            this.getStatusFinanceiro();
            this.getAssociados();
        },
    };
</script>

<style scoped>

</style>
