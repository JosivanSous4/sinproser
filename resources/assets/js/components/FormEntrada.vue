<template>
    <div id="FormEntrada">
        <div class="m-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="m-portlet">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <span class="m-portlet__head-icon m--hide">
                                        <i class="la la-gear"></i>
                                    </span>
                                    <h3 class="m-portlet__head-text">
                                        Cadastro de entrada
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <form v-on:submit.prevent="salvar" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                            <div class="m-portlet__body">
                                <div class="m-form__group form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="exampleSelect1">
                                                Tipo entrada
                                            </label>
                                            <select  class="form-control m-input text-uppercase" @click="limpaDados()" v-model="form_entrada.tipo_entrada_id" id="exampleSelect1">
                                                <option :value="''">
                                                    -- SELECIONE O TIPO DE ENTRADA --
                                                </option>

                                                <option v-for="tipo_entrada in tipo_entradas" :value="tipo_entrada.tipo_entrada_id">
                                                    {{tipo_entrada.nome}}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-lg-2">
                                            <label for="">
                                                Pagador associado?
                                            </label>
                                            <div class="m-radio-inline">
                                                <label class="m-radio">
                                                    <input type="radio" v-model="form_entrada.tipo_pagador" @click="limpaDados()" name="form_entrada-associado" :value="1">
                                                    Sim
                                                    <span></span>
                                                </label>
                                                <label class="m-radio">
                                                    <input type="radio" v-model="form_entrada.tipo_pagador" @click="limpaDados()" name="form_entrada-tipo_pagador" :value="0">
                                                    Não
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6" v-if="form_entrada.tipo_pagador == 1">
                                            <label>
                                                Selecione o associado:
                                            </label>
                                            <select class="form-control m-input text-uppercase" @change="getValorAssociado()" v-model="associado" id="exampleSelect1">
                                                <option :value="''">
                                                    -- SELECIONE O ASSOCIADO --
                                                </option>
                                                <option v-for="associado in listaAssociados"  :value="associado">
                                                    {{associado.nome}}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-lg-6" v-if="form_entrada.tipo_pagador == 0">
                                            <label>
                                                Digite o nome do pagador:
                                            </label>
                                            <input type="text" class="form-control m-input" v-model="form_entrada.pagador" placeholder="Digite o nome">
                                        </div>
                                    </div>
                                </div>

                                <div class="m-form__group form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>
                                                Mês referente:
                                            </label>
                                            <input type='month' v-model="competencia" class="form-control m-input" placeholder="MM/AAAA">

                                        </div>
                                        <div class="col-lg-4">
                                            <label class="">
                                                Valor:
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon2">
                                                        R$
                                                    </span>
                                                </div>
                                                <money v-model="form_entrada.valor"
                                                       v-bind="money"
                                                       class="form-control m-input" placeholder="Digite o valor pago" >
                                                </money>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>
                                                Status da entrada:
                                            </label>
                                            <select v-model="form_entrada.status_id" class="form-control m-input text-uppercase" id="exampleSelect1">
                                                <option v-for="statu in status" :value="statu.status_id">{{statu.status}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-form__group form-group">
                                    <div class="row">
                                        <div class="col-lg-3" v-if="form_entrada.status_id == 4">
                                            <label>
                                                Data do pagamento:
                                            </label>
                                            <input type="date" v-model="form_entrada.data_pagamento" class="form-control m-input" placeholder="">
                                        </div>

                                        <div class="col-lg-9">
                                            <label class="">
                                                Descrição:
                                            </label>
                                            <textarea class="form-control m-input" v-model="form_entrada.descricao"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                                <div class="m-form__actions m-form__actions--solid">
                                    <div class="row">
                                        <div class="col-lg-12 m--align-right">
                                            <button type="submit" class="btn btn-primary">
                                                Salvar
                                            </button>
                                            <button type="reset" class="btn btn-secondary">
                                                Cancelar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'FormEntrada',
        props: ['entrada'],
        data() {
            return {
                titulo: 'Salvar entrada',
                tipo_entradas : [],
                areas_atuacao : [],
                status        : [],
                listaAssociados: [],
                money: {
                    decimal: ',',
                    thousands: '.',
                    precision: 2,
                    masked: false
                },
                meses : '',
                associado : '',
                competencia : '',
                form_entrada  : {
                    entrada_id      : '',
                    tipo_pagador    : 1,
                    tipo_entrada_id : '',
                    associado_id    : '',
                    pagador         : '',
                    competencia     : '',
                    valor           : 0,
                    data_emissao    : '',
                    data_pagamento  : '',
                    descricao       : '',
                    status_id       : '',
                }
            }
        },
        methods : {
            limpaDados : function(){
                this.form_entrada.valor = 0;
                this.associado          = '';
            },
            changeOptions : function(){
                this.form_entrada.bolporarea = 0;
                // this.form_entrada.area_atuacao_id = '';
            },
            salvar: function() {
                self = this;

                self.form_entrada.competencia = moment(self.competencia).format('YYYY-MM-DD');
                // console.log(moment(self.form_entrada.competencia).format('YYYY-MM-DD'));
                let url = "/financeiro/entrada/form-entrada";
                // console.log(url);
                self.salvarDados(this.titulo + '?', url, self.form_entrada);
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
            getAreasAtuacao: function() {
                self = this;

                let url = urlBase+"/api/areas-atuacao";

                self.$http.get(url).then((response) => {
                    self.areas_atuacao = response.body;
                }, response => {
                    return self.$swal({
                        type: self.response.status,
                        title: self.response.msg,
                    });
                });
            },
            dataReferente : function() {
                var meses = [];
                var cont = 1;
                for (var i = 0; i < 14; i++) {
                    cont = (i < 9 ? "0"+(1 + i) : 1 + i);
                    meses[i] = moment().format(cont+"/YYYY");
                }
                this.meses = meses;
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
                    this.listaAssociados = response.data;
                });
            },
            getValorAssociado : function(){
                if (this.form_entrada.tipo_entrada_id == 1) {
                    this.form_entrada.valor = (this.associado.salario * 2) / 100;
                    this.form_entrada.associado_id = this.associado.associado_id;
                }
            },
            // trataDados : function(){
            //     if (this.tipoentrada) {
            //         this.tipo_entrada.tipo_entrada_id = this.tipoentrada.tipo_entrada_id;
            //         this.tipo_entrada.nome = this.tipoentrada.nome;
            //         this.tipo_entrada.descricao = this.tipoentrada.descricao;

            //         this.titulo = "Atualizar tipo de entrada"
            //     }else{
            //         this.titulo = "Cadastrar tipo de entrada"
            //     }

            //     console.log(this.tipo_entrada);
            // },
        },
        created () {
            // this.trataDados();
            this.getTiposEntrada();
            this.getAreasAtuacao();
            this.dataReferente();
            this.getStatusFinanceiro();
            this.getAssociados();
        },
    };
</script>

<style scoped>

</style>
