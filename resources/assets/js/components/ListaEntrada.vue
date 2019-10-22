<template>
    <div id="ListaEntrada">
        <div class="m-content">
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet m-portlet--head-solid-bg m-portlet--rounded">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Lista de entradas
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="m-portlet__nav">
                                <li class="m-portlet__nav-item">
                                    <a :href="'entrada/baixa-coletiva'" class="m-portlet__nav-link btn btn-primary m-btn m-btn--pill m-btn--air">
                                        <span>
                                            <i class="la la la-check"></i>
                                            <span class="mobile-hide">
                                                Imposto Sindical
                                            </span>
                                        </span>
                                    </a>
                                </li>
                                <li class="m-portlet__nav-item">
                                    <button type="button" @click="showFilter = !showFilter" class="m-portlet__nav-link btn btn-default m-btn m-btn--pill m-btn--air">
                                        <span>
                                            <i class="la la-filter"></i>
                                            <span class="mobile-hide">
                                                Pesquisar
                                            </span>
                                        </span>
                                    </button>
                                </li>
                                <li class="m-portlet__nav-item">
                                    <a :href="urlBase+'/financeiro/entrada/form-entrada'" class="m-portlet__nav-link btn btn-accent m-btn m-btn--pill m-btn--air">
                                        <span>
                                            <i class="la la-plus"></i>
                                            <span class="mobile-hide">
                                                Novo entrada
                                            </span>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="m-portlet__body">
                        <transition name="fade">
                            <form class="m-form" v-if="showFilter">
                                <div class="m-portlet__body">
                                    <div class="m-form__group form-group" style="padding-top: 0px;">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <label>
                                                    Tipo de entrada:
                                                </label>
                                                <select  class="form-control m-input text-uppercase" v-model="pesquisar.tipo_entrada_id" id="exampleSelect1">
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
                                                        <input type="radio" v-model="pesquisar.tipo_pagador" name="form_entrada-associado" :value="1">
                                                        Sim
                                                        <span></span>
                                                    </label>
                                                    <label class="m-radio">
                                                        <input type="radio" v-model="pesquisar.tipo_pagador" name="form_entrada-tipo_pagador" :value="2">
                                                        Não
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-5" v-if="pesquisar.tipo_pagador">
                                                <label>
                                                    Selecione o associado:
                                                </label>
                                                <select class="form-control m-input text-uppercase" v-model="pesquisar.associado_id" id="exampleSelect1">
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
                                                <input type="text" v-model="pesquisar.pagador" class="form-control m-input" placeholder="Digite o nome">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="m-form__group form-group" style="padding-top: 0px;">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label>
                                                    Status da entrada:
                                                </label>
                                                <select class="form-control m-input text-uppercase" v-model="pesquisar.status_id">
                                                    <option v-for="statu in status" :value="statu.status_id">{{statu.status}}</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-6">
                                                <label>
                                                    Mês de referência:
                                                </label>
                                                <div class="input-daterange input-group" id="m_datepicker_5">
                                                    <input type='month' v-model="competenciaInicio" class="form-control m-input" name="start">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            à
                                                        </span>
                                                    </div>
                                                    <input type='month' v-model="competenciaFim" class="form-control" name="end">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-form__actions m-form__actions" style="padding-top: 0px;">
                                    <button type="button" @click="pesquisarEntrada()" class="btn btn-primary">
                                        Pesquisar
                                    </button>
                                    <button type="button" @click="fecharPesquisa()" class="btn btn-danger">
                                        Cancelar
                                    </button>
                                </div>
                            </form>
                        </transition>

                        <div v-if="showFilter">
                            <br><hr><br>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped- table-bordered table-hover table-checkable">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            #
                                        </th>
                                        <th>
                                            Status
                                        </th>
                                        <th>
                                            Pagador
                                        </th>
                                        <th>
                                            Tipo de entrada
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
                                        <th class="text-center">
                                            Ação
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-if="qtdEntradas == 0">
                                        <td colspan="9">
                                            <p class="text-center">
                                                Nenhum registro encontrado!
                                            </p>
                                        </td>
                                    </tr>
                                    <tr v-else v-for="entrada in entradas.data">
                                        <td scope="row" class="align-middle">
                                            {{ index +  1 }}
                                        </td>
                                        <td class="align-middle ">
                                            <span class="m-badge m-badge--brand m-badge--wide" :class="{'m-badge--danger' : entrada.status_id == 3, 'm-badge--info' : entrada.status_id == 4}">
                                                {{entrada.has_status.status}}
                                            </span>
                                        </td>
                                        <td class="align-middle">
                                            {{entrada.pagador}}
                                        </td>
                                        <td>
                                            {{entrada.has_tipo_entrada.nome}}
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
                                        <td nowrap="" style="" class="text-center align-middle">
                                            <button @click="modalBaixa(entrada.entrada_id)" v-tooltip="'Dar baixar na entrada'" data-toggle="modal" data-target="#m_modal_1" type="button" v-if="entrada.status_id == 3" class="btn btn-primary m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill btn-sm">
                                                <i class="la la-check"></i>
                                            </button>
                                            <a :href="urlBase+'/financeiro/entrada/recibo/'+entrada.entrada_id" target="_blank" v-if="entrada.status_id == 4" v-tooltip="'Imprimir recibo'" class="btn btn-info m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill btn-sm">
                                                <i class="la la-file-text"></i>
                                            </a>
                                            <a href="#" v-if="per == 1" @click="excluirEntrada(entrada)" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill btn-sm">
                                                <i class="la la-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <pagination v-if="entradas.data" class="justify-content-center" :data="entradas" @pagination-change-page="getEntrada">
                            <span slot="prev-nav">&lt; </span>
                            <span slot="next-nav"> &gt;</span>
                        </pagination>
                    </div>
                </div>
            </div>
        </div>
        <!--begin::Modal Baixa Coletiva-->
        <!-- <div class="modal fade" id="modalBaixaColetiva" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="" v-on:submit.prevent="baixaColetivaSave">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">
                                Baixa por área
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div class="m-form__group form-group">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label>
                                            Data do pagamento:
                                        </label>
                                        <input type="date" required v-model="baixaColetiva.data_pagamento" class="form-control m-input">
                                    </div>
                                </div>
                            </div>
                            <div class="m-form__group form-group">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label>
                                            Mês referência:
                                        </label>
                                        <input type='month' placeholder="01/2019" required v-model="competencia" class="form-control m-input">
                                    </div>
                                </div>
                            </div>
                            <div class="m-form__group form-group">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label for="exampleSelect1">
                                            Área de atual
                                        </label>
                                        <select required class="form-control m-input text-uppercase" v-model="baixaColetiva.area_atuacao_id" id="exampleSelect1">
                                            <option :value="''">
                                                -- SELECIONE ÁREA --
                                            </option>

                                            <option v-for="area in area_atuacao" :value="area.area_atuacao_id">
                                                {{area.nome}}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> -->
        <!--end::Modal Baixa Coletiva-->

        <!--begin::Modal Baixa Individual -->
		<div class="modal fade" id="m_modal_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
                <form class="" v-on:submit.prevent="darBaixa">
	                <div class="modal-content">
    					<div class="modal-header">
    						<h5 class="modal-title" id="exampleModalLabel">
    							Registrar pagamento
    						</h5>
    						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    							<span aria-hidden="true">
    								&times;
    							</span>
    						</button>
    					</div>
    					<div class="modal-body">
                            <div class="m-form__group form-group">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label>
                                            Data do pagamento:
                                        </label>
                                        <input type="date" required v-model="pagamento.data_pagamento" class="form-control m-input">
                                    </div>
                                </div>
                            </div>
    					</div>
    					<div class="modal-footer">
    						<button type="button" class="btn btn-danger" data-dismiss="modal">
    							Fechar
    						</button>
    						<button type="submit" class="btn btn-primary">
    							Salvar
    						</button>
    					</div>
    				</div>
                </form>
            </div>
		</div>
		<!--end::Modal Baixa Individual-->
    </div>
</template>

<script>
    export default {
        name: 'ListaEntrada',
        data() {
            return {
                showFilter : false,
                entradas : [],
                urlBase       : urlBase,
                associados    : [],
                status        : [],
                area_atuacao  : [],
                qtdEntradas   : '',
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
                    competenciaInicio   : '',
                    competenciaFim      : '',
                },
                retorno : '',
                competencia : '',
                competenciaInicio : '',
                competenciaFim    : '',
                baixaColetiva : {
                    data_pagamento : '',
                    competencia    : '',
                    area_atuacao_id: '',
                },
                per : '',
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
                let url = urlBase+"/financeiro/buscar-entrada";

                self.pesquisar.competenciaInicio = moment(self.competenciaInicio).format('YYYY-MM-DD')
                self.pesquisar.competenciaFim    = moment(self.competenciaFim).format('YYYY-MM-DD')

                this.$http.get(url, {params: self.pesquisar}).then(response => {
                    self.entradas = response.body;
                }, response => {
                    return Swal({
                        type: response.body.status,
                        title: response.body.msg,
                    });
                });
            },
            modalBaixa : function(id){
                self = this;
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
            getEntrada: function(page = 1) {
                self = this;

                let url = urlBase+"/api/entradas?page=" + page;

                self.$http.get(url).then((response) => {
                    self.entradas = response.body;
                    this.qtdEntradas = this.entradas.data.length;
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
            getAreasAtuacao : function(){
                this.$http.get(urlBase+'/api/areas-atuacao').then(response => {
                    this.area_atuacao = response.data;
                });
            },
            getUsuario : function(){
                this.$http.get(urlBase+'/usuarios/get-usuario-logado').then(response => {
                    this.per = response.data;
                });
            },
            // baixaColetivaSave : function(){
            //     let self = this;
            //
            //     let url = urlBase+"/financeiro/entrada/baixa-coletiva";
            //
            //     self.baixaColetiva.competencia = moment(self.competencia).format('YYYY-MM-DD');
            //
            //     Swal({
            //         title: "Tem certeza que quer realiza esse procedimento?",
            //         type: 'question',
            //         showCancelButton: true,
            //         showLoaderOnConfirm: true,
            //         preConfirm: () => {
            //             return self.$http.post(url, self.baixaColetiva).then((response) => {
            //                 self.retorno = response.body;
            //                 self.getEntrada();
            //             }, response => {
            //                 return Swal({
            //                     type: self.retorno.status,
            //                     title: self.retorno.msg,
            //                 });
            //             });
            //         },
            //         allowOutsideClick: () => !Swal.isLoading()
            //     }).then((result) => {
            //         if (self.retorno) {
            //             return Swal({
            //                 type: self.retorno.status,
            //                 title: self.retorno.msg,
            //                 text: self.retorno.texto,
            //             });
            //         }
            //
            //     }).catch(Swal.noop)
            // },
            //
        },
        filters : {
            formatCompetencia : function(competencia){
                return moment(competencia).format('MM/YYYY');
            },
        },
        created () {
            this.getEntrada();
            this.getTiposEntrada();
            this.getStatusFinanceiro();
            this.getAssociados();
            this.getAreasAtuacao();
            this.getUsuario();
        },
    };
</script>

<style scoped>
    .m-form{
        background: #fbf5f5;
    }
    .fade-enter-active, .fade-leave-active {
      transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active em versões anteriores a 2.1.8 */ {
      opacity: 0;
    }
</style>
