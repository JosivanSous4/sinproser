<template>
    <div id="ListaEntrada">
        <div class="m-content">
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Lista de saída
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">
                                <button type="button" @click="showFilter = !showFilter" class="m-portlet__nav-link btn btn-primary m-btn m-btn--pill m-btn--air">
                                    <span>
                                        <i class="la la-filter"></i>
                                        <span class="mobile-hide">
                                            Pesquisar
                                        </span>
                                    </span>
                                </button>
                            </li>

                            <li class="m-portlet__nav-item">
                                <a :href="urlBase+'/financeiro/saida/form-saida'" class="m-portlet__nav-link btn btn-accent m-btn m-btn--pill m-btn--air">
                                    <span>
                                        <i class="la la-plus"></i>
                                        <span class="mobile-hide">
                                            Novo saída
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
                                    <div class="row form-group">
                                        <div class="col-lg-5">
                                            <label>
                                                Tipo de saída:
                                            </label>
                                            <select  class="form-control m-input text-uppercase" v-model="pesquisar.tipo_saida_id" id="exampleSelect1">
                                                <option v-for="tipo_saida in tipos_saida" :value="tipo_saida.tipo_saida_id">
                                                    {{tipo_saida.nome}}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <label>
                                                    Período de pagamento:
                                                </label>

                                                <div class="input-daterange input-group" id="m_datepicker_5">
                                                    <input type="date" v-model="pesquisar.dtainicial" class="form-control m-input" name="start">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"> à </span>
                                                    </div>
                                                    <input type="date" v-model="pesquisar.dtafinal" class="form-control" name="end">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label>
                                                Digite o nome do beneficiário:
                                            </label>
                                            <input type="text" v-model="pesquisar.beneficiario" class="form-control m-input" placeholder="Digite o nome">
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
                                        Beneficiario
                                    </th>
                                    <th>
                                        Tipo saída
                                    </th>
                                    <th>
                                        Valor
                                    </th>
                                    <th>
                                        Data
                                    </th>
                                    <th class="text-center">
                                        Opções
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="qtdeSaidas == 0">
                                    <td colspan="6">
                                        <p class="text-center">
                                            Nenhum registro encontrado!
                                        </p>
                                    </td>
                                </tr>
                                <tr v-for="(saida, index) in saidas.data">
                                    <td scope="row" class="align-middle">
                                        {{ index +  1 }}
                                    </td>
                                    <td class="align-middle">
                                        {{saida.beneficiario}}
                                    </td>
                                    <td class="align-middle">
                                        {{saida.has_tipo_saida.nome}}
                                    </td>
                                    <td class="align-middle">
                                        R$ {{saida.valor | formaMoeda}}
                                    </td>
                                    <td class="align-middle">
                                        {{saida.data_saida | date}}
                                    </td>
                                    <td nowrap="" style="" class="text-center align-middle">
                                        <a :href="urlBase+'/configuracoes/cadastro/tipos-de-entrada/form-tipo-entrada/'+saida.saida_id" v-tooltip="'Imprimir recibo'" class="btn btn-primary m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill btn-sm">
                                            <i class="flaticon-file"></i>
                                        </a>
                                        <button type="button" v-tooltip="'Excluir saída'" v-if="per == 1" @click="excluirSaida(saida)" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill btn-sm">
                                            <i class="la la-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <pagination v-if="saidas.data" class="justify-content-center" :data="saidas" @pagination-change-page="getSaidas">
                        <span slot="prev-nav">&lt; </span>
                        <span slot="next-nav"> &gt;</span>
                    </pagination>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'ListaEntrada',
        data() {
            return {
                saidas : [],
                qtdeSaidas : '',
                urlBase       : urlBase,
                showFilter : false,
                tipos_saida : [],
                pesquisar : {
                    tipo_saida_id : '',
                    beneficiario  : '',
                    status_id     : '',
                    dtainicial    : '',
                    dtafinal      : '',
                },
                per               : '',
            }
        },
        methods : {
            fecharPesquisa : function(){
                this.showFilter = !this.showFilter;

                this.pesquisar.tipo_saida_id    = '';
                this.pesquisar.beneficiario     = '';
                this.pesquisar.status_id        = '';
                this.pesquisar.dtainicial       = '';
                this.pesquisar.dtafinal         = '';
            },
            excluirSaida : function(saida) {
                self = this;
                let url = urlBase+"/financeiro/saida/excluir";
                let retorno;
                Swal({
                    title: 'Excluir saída?',
                    type: 'question',
                    inputAttributes: {
                        autocapitalize: 'off'
                    },
                    showCancelButton: true,
                    confirmButtonText: 'Sim',
                    showLoaderOnConfirm: true,
                    preConfirm: (login) => {
                        return self.$http.post(url, saida).then((response) => {
                            retorno = response.body;
                            self.getSaidas();
                        }, response => {
                            retorno = response.body;
                        });
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    return Swal({
                        type: retorno.status,
                        title: retorno.msg,
                    });
                })
            },
            pesquisarEntrada : function(){
                let self = this;
                let url = urlBase+"/financeiro/saida/buscar-saida";

                this.$http.get(url, {params: self.pesquisar}).then(response => {
                    self.saidas = response.body;
                    self.qtdeSaidas = self.saidas.data.length;
                }, response => {
                    return Swal({
                        type: response.body.status,
                        title: response.body.msg,
                    });
                });
            },
            getSaidas: function(page = 1) {
                self = this;
                let url = '';
                if (!this.saidas.data) {
                    url = urlBase+"/api/saida?page=" + page;
                }else {
                    url = this.saidas.path+"?page=" + page;
                }
                self.$http.get(url).then((response) => {
                    self.saidas = response.body;
                    self.qtdeSaidas = self.saidas.data.length;
                }, response => {
                    return self.$swal({
                        type: self.response.status,
                        title: self.response.msg,
                    });
                });
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
            getUsuario : function(){
                this.$http.get(urlBase+'/usuarios/get-usuario-logado').then(response => {
                    this.per = response.data;
                });
            },

        },
        created () {
            this.getSaidas();
            this.getTiposSaida();
            this.getStatusFinanceiro();
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
