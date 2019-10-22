<template>
    <div id="FormBaixaColetiva">
        <div class="loaderAll" v-if="loaderAll"></div>
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
                                        Arrecadação sindical
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <form v-on:submit.prevent="salvar" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                            <div class="m-portlet__body">
                                <div class="m-form__group form-group">
                                    <div class="row form-group">
                                        <div class="col-lg-4 col-sm-12">
                                            <label>
                                                Mês referente:
                                            </label>
                                            <input type='month' required v-model="competencia" class="form-control m-input" placeholder="MM/AAAA">
                                        </div>
                                        <div class="col-lg-4 col-sm-12">
                                            <label>
                                                Tipo de pagamento:
                                            </label>
                                            <select class="form-control m-input m-input--square" required name="tipo_pagamento_id" v-model="baixa_coletiva.tipo_pagamento_id" id="exampleSelect1">
                                                <option :value="''">
                                                    -- SELECIONE O TIPO DE PAGAMENTO --
                                                </option>
                                                <option v-for="tipo_pagamento in lista_tipos_pagamento" :value="tipo_pagamento.tipo_pagamento_id">
                                                    {{ tipo_pagamento.nome }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-lg-4 col-sm-12">
                                            <label>
                                                Área de atual:
                                            </label>
                                            <select required class="form-control m-input text-uppercase" v-model="baixa_coletiva.area_atuacao_id" id="exampleSelect1">
                                                <option :value="''">
                                                    -- SELECIONE ÁREA --
                                                </option>

                                                <option v-for="area in areas_atuacao" :value="area.area_atuacao_id">
                                                    {{area.nome}}
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="">
                                        <button type="button" @click="getEntradas()" class="btn btn-primary">
                                            <i class="fa fa-search"></i> Pesquisar
                                        </button>
                                    </div>

                                </div>
                                <!-- <div class="m-form__group form-group">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label class="">
                                                Descrição:
                                            </label>
                                            <textarea class="form-control m-input" v-model="form_entrada.descricao"></textarea>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="m-portlet__body">
                                    <br>
                                    <div class="col-lg-8 pull-left label-entrada">
                                        <p>
                                            <b>Selecione o associado para dar baixa no pagamento</b>
                                        </p>
                                    </div>
                                    <div class="col-lg-3 col-sm-12 pull-right form-group">
                                        <label>
                                            Data do pagamento:
                                        </label>
                                        <input type="date" required v-model="baixa_coletiva.data_pagamento" class="form-control m-input" placeholder="">
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-striped- table-bordered table-hover table-checkable">
                                            <thead>
                                                <tr>
                                                    <th v-tooltip="'Selecionar todos'">
                                                        <label class="m-checkbox m-checkbox--state-primary" style="padding-left: 10px !important;margin-bottom: 15px !important;">
                                                            <input type="checkbox" @click="selecionarTodos()" v-model="chackAll">
                                                            <span></span>
                                                        </label>
                                                    </th>
                                                    <th>
                                                        Cod.
                                                    </th>
                                                    <th>
                                                        Status
                                                    </th>
                                                    <th>
                                                        Pagador
                                                    </th>
                                                    <th>
                                                        Mês referente
                                                    </th>
                                                    <th>
                                                        Valor
                                                    </th>
                                                    <th class="text-center">
                                                        Data pagamento
                                                    </th>
                                                    <th>
                                                        Descrição
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-if="entradas.length != 0" v-for="entrada in entradas">
                                                    <td class="align-middle">
                                                        <label class="m-checkbox m-checkbox--state-primary align-middle" style="padding-left: 10px !important;">
                                                            <input type="checkbox" v-model="baixa_coletiva.entrada_id" :value="entrada.entrada_id" @click="selectAll()" >
                                                            <span></span>
                                                        </label>
                                                    </td>
                                                    <td class="align-middle">
                                                        {{entrada.entrada_id}}
                                                    </td>
                                                    <td class="align-middle ">
                                                        <span class="m-badge m-badge--brand m-badge--wide" :class="{'m-badge--danger' : entrada.status_id == 3, 'm-badge--info' : entrada.status_id == 4}">
                                                            {{entrada.has_status.status}}
                                                        </span>
                                                    </td>
                                                    <td class="align-middle">
                                                        {{entrada.pagador}}
                                                    </td>
                                                    <td class="align-middle">
                                                        {{entrada.competencia | formatCompetencia}}
                                                    </td>
                                                    <td class="align-middle">
                                                        R$ {{entrada.valor | formaMoeda}}
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        {{entrada.data_pagamento | date}}
                                                    </td>
                                                    <td class="align-middle">
                                                        {{entrada.descricao}}
                                                    </td>
                                                </tr>

                                                <tr v-if="entradas.length == 0">
                                                    <td colspan="8" class="text-center">
                                                        <b>{{mensagem_retorno}}</b>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
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
        name: 'FormBaixaColetiva',
        props: ['entrada'],
        data() {
            return {
                mensagem_retorno : 'Preencha os campos para buscar as entradas!',
                loaderAll : false,
                titulo: 'Salvar entrada',
                entradas      : [],
                areas_atuacao : [],
                lista_tipos_pagamento : [],
                status        : [],
                listaAssociados: [],
                meses : '',
                associado : '',
                competencia : '',
                baixa_coletiva  : {
                    area_atuacao_id : '',
                    data_pagamento  : '',
                    competencia     : '',
                    tipo_pagamento_id : '',
                    entrada_id      : [],
                },
                chackAll : false,
            }
        },
        methods : {
            selectAll : function() {
                this.chackAll = false;
            },
            selecionarTodos : function() {
                let self = this;
                let select = self.entradas;
                self.idsSelecionados = [];
                self.chackAll = (self.chackAll == true) ? false : true;
                if (self.chackAll) {
                    // console.log(self.entradas);
                    self.entradas.forEach(function(entrada) {
                        // console.log(entrada.entrada_id);
                        self.baixa_coletiva.entrada_id.push(entrada.entrada_id);
                        // console.log(self.baixa_coletiva.entrada_id);
                    });
                    // self.baixa_coletiva.entrada_id = self.entradas;
                }else {
                    self.baixa_coletiva.entrada_id = [];
                }
            },
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

                if (self.baixa_coletiva.entrada_id.length != 0) {
                    self.baixa_coletiva.competencia = moment(self.competencia).format('YYYY-MM-DD');

                    let url = urlBase+"/financeiro/entrada/baixa-coletiva";
                    // console.log(url);
                    // self.salvarDados("Dar baixa nas entradas selecionadas?", url, self.baixa_coletiva);
                    Swal({
                        title: "Tem certeza que quer realiza esse procedimento?",
                        type: 'question',
                        showCancelButton: true,
                        showLoaderOnConfirm: true,
                        preConfirm: () => {
                            return self.$http.post(url, self.baixa_coletiva).then((response) => {
                                self.retorno = response.body;
                                self.getEntradas();
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
                                html: self.retorno.texto,
                            });
                        }

                    }).catch(Swal.noop)
                }else{
                    Swal.fire({
                        type: 'error',
                        title: 'Seleciona pelo menos uma entrada!',
                        animation: false,
                        customClass: 'animated tada'
                    })
                }
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
            getEntradas: function(){
                self = this;
                let url = urlBase+'/financeiro/entrada/baixa-coletiva/busca';
                // Nenhum registro foi encontrado!
                self.loaderAll = true;
                if (self.competencia && self.baixa_coletiva.area_atuacao_id && self.baixa_coletiva.tipo_pagamento_id) {
                    self.baixa_coletiva.competencia = moment(self.competencia).format('YYYY-MM-DD');
                    self.baixa_coletiva.entrada_id = [];
                    self.chackAll                  = false;
                    this.$http.get(url, {params: self.baixa_coletiva}).then(response => {
                        this.entradas = response.data;
                        self.loaderAll = false;

                        if (this.entradas.length == 0) {
                            this.mensagem_retorno = "Nenhum registro foi encontrado!";
                        }
                    });
                }else{
                    // Swal.fire({
                    //     type: 'error',
                    //     title: 'Selecione o mês de referência!',
                    //     animation: false,
                    //     customClass: 'animated tada'
                    // })
                    self.loaderAll = false;
                }
            },
            getTiposPagamento : function() {
                this.$http.get(urlBase+'/api/tipos-pagamento').then(response => {
                    this.lista_tipos_pagamento = response.data;
                });
            },
        },
        filters : {
            formatCompetencia : function(competencia){
                return moment(competencia).format('MM/YYYY');
            },
        },
        created () {
            // this.trataDados();
            this.getAreasAtuacao();
            this.getTiposPagamento();
        },
    };
</script>

<style scoped>
    .label-entrada {
        padding-top: 45px;
    }
</style>
