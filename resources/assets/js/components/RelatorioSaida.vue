<template>
    <div id="RelatorioSaida">
        <div class="m-content">
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet m-portlet--head-solid-bg m-portlet--rounded">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Relatório de saída
                                </h3>
                            </div>
                        </div>
                    </div>

                    <form class="m-form" ref="relatorioSaida" :action="urlBase+'/relatorio/financeiro/saida/busca'">
                        <div class="m-portlet__body">
                            <div class="m-form__group form-group" style="padding-top: 0px;">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label>
                                            Tipo de saída:
                                        </label>
                                        <select  class="form-control m-input text-uppercase" name="tipo_saida_id" v-model="pesquisar.tipo_saida_id" id="exampleSelect1">
                                            <option v-for="tipo_saida in tipos_saida" :value="tipo_saida.tipo_saida_id">
                                                {{tipo_saida.nome}}
                                            </option>
                                        </select>
                                    </div>
                                    <!-- <div class="col-lg-3">
                                        <label>
                                            Status da saída:
                                        </label>
                                        <select class="form-control m-input text-uppercase" name="status_id" v-model="pesquisar.status_id">
                                            <option v-for="statu in status" :value="statu.status_id">{{statu.status}}</option>
                                        </select>
                                    </div> -->
                                    <div class="col-lg-8">
                                        <label>
                                            Digite o nome do beneficiário:
                                        </label>
                                        <input type="text" v-model="pesquisar.beneficiario" name="beneficiario" class="form-control m-input" placeholder="Digite o nome">
                                    </div>
                                </div>
                            </div>
                            <div class="m-form__group form-group" style="padding-top: 0px;">
                                <div class="row">
                                    <div class="col-lg-5 col-md-9 col-sm-12">
                                        <label>
                                            Período de pagamento:
                                        </label>

                                        <div class="input-daterange input-group" id="m_datepicker_5">
                                            <input type="date" v-model="pesquisar.dtainicial" class="form-control m-input" name="dtainicial">
                                            <div class="input-group-append">
                                                <span class="input-group-text"> à </span>
                                            </div>
                                            <input type="date" v-model="pesquisar.dtafinal" class="form-control" name="dtafinal">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m-form__actions m-form__actions" style="padding-top: 0px;">
                            <button type="button" @click="pesquisarSaida()"class="btn btn-primary">
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
        name: 'RelatorioSaida',
        data() {
            return {
                saidas : [],
                urlBase       : urlBase,
                tipos_saida : [],
                status : '',
                pesquisar : {
                    tipo_saida_id : '',
                    beneficiario  : '',
                    status_id     : '',
                    dtainicial    : '',
                    dtafinal      : '',
                },
            }
        },
        methods : {
            fecharPesquisa : function(){
                this.pesquisar.tipo_saida_id = '';
                this.pesquisar.beneficiario  = '';
                this.pesquisar.status_id     = '';
                this.pesquisar.dtainicial    = '';
                this.pesquisar.dtafinal      = '';
            },
            pesquisarSaida : function(){
                let self = this;
                let url = urlBase+"/relatorio/financeiro/saida/busca";

                this.$refs.relatorioSaida.submit();

            },
            getTiposSaida: function() {
                self = this;

                let url = urlBase+"/api/tipos-saida";

                self.$http.get(url).then((response) => {
                    self.tipos_saida = response.body;
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
        },
        created () {
            this.getTiposSaida();
            this.getStatusFinanceiro();
        },
    };
</script>

<style scoped>

</style>
