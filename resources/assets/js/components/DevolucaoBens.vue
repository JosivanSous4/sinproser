<template>
    <div id="DevolucaoBens">
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
                                        Objeto de devolução
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" v-on:submit.prevent="registrarDevolucao">
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6 form-group">
                                        <label class="">
                                            Nome do bem:
                                        </label>
                                        <input type="text" v-model="produto.nome" disabled :class="'form-control m-input '+ (form_errors.nome ? 'is-invalid' : '')" placeholder="Digite o nome do bem" title="Digite o nome do bem">
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <label>
                                            Descrição:
                                        </label>
                                        <textarea v-model="produto.descricao" name="descricao" disabled :class="'form-control m-input '+ (form_errors.descricao ? 'is-invalid' : '')" placeholder="Digite a descrição" title="Descreva o bem"></textarea>
                                    </div>

                                    <div class="col-lg-4 form-group">
                                        <label>
                                            Data da aquisição:
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon2">
                                                    <i class="flaticon-calendar-3"></i>
                                                </span>
                                            </div>
                                            <input type="date" v-model="produto.data_aquisicao" disabled :class="'form-control m-input '+ (form_errors.data_aquisicao ? 'is-invalid' : '')" name="data_aquisicao" title="Data em que recebeu o bem"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 form-group">
                                        <label class="">
                                            Valor Unitário
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon2">
                                                    R$
                                                </span>
                                            </div>
                                            <money v-model="produto.valor_unitario" name="valor_unitario" v-bind="money" disabled :class="'form-control m-input money '+ (form_errors.valor_unitario ? 'is-invalid' : '')" title="Valor unitário do bem"></money>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 form-group">
                                        <label class="">
                                            Quantidade de bens:
                                        </label>
                                        <input type="number" v-model="produto.qtde_bem" disabled :class="'form-control m-input '+ (form_errors.qtde_bem ? 'is-invalid' : '')" placeholder="Digite a quantidade de bens" title="O sindicato possui quantos itens iguais a este?">
                                    </div>

                                    <!-- <div class="col-lg-4 offset-4 form-group">
                                        <label class="">
                                            Quantidade de disponível:
                                        </label>
                                        <input type="number" :value="produto.qtde_disponivel" disabled :class="'form-control m-input '+ (form_errors.qtde_bem ? 'is-invalid' : '')" placeholder="Digite a quantidade de bens" title="O sindicato possui quantos itens iguais a este?">
                                    </div> -->
                                </div>

                                <div class="form-group flutuante rigth">
                                    Emprestar {{ emprestimo.qtde_emprestar }} itens
                                </div>

                                <div class="table-responsive col-md-12 form-group m-form__group">
                                    <br>
                                    <h5 class="msg-emprestar-bem text-center">
                                        Selecione apenas os que estão sendo <span class="danger">DEVOLVIDO</span>
                                    </h5>
                                    <table class="table table-striped- table-bordered table-hover table-checkable siga-data-table">
                                        <thead>
                                            <tr>
                                                <th v-tooltip="'Selecionar todos'">
                                                    <label class="m-checkbox m-checkbox--state-primary" style="padding-left: 10px !important;margin-bottom: 15px !important;">
                                                        <input type="checkbox" @click="selecionarTodos()" v-model="checkAll">
                                                        <span></span>
                                                    </label>
                                                </th>
                                                <th>
                                                    Codigo do bem
                                                </th>
                                                <th>
                                                    Nome
                                                </th>
                                                <th>
                                                    Situação
                                                </th>
                                                <th>
                                                    Data da Devolução
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-if="lista_bens.length != 0" v-for="bem in lista_bens">
                                                <td class="align-middle">
                                                    <template v-if="!bem.pivot.bol_devolvido">
                                                        <label class="m-checkbox m-checkbox--state-primary align-middle" style="padding-left: 10px !important; margin-top: -25px">
                                                            <input type="checkbox" v-model="emprestimo.bens_selecionados" :value="bem.bem_id" @click="selectAll()" @change="atualizarQuantidade()">
                                                            <span></span>
                                                        </label>
                                                    </template>
                                                    <template v-else>
                                                        <label class="m-checkbox m-checkbox--state-primary align-middle" style="padding-left: 10px !important; margin-top: -25px">
                                                            <input type="checkbox" checked class="disabled" disabled>
                                                            <span></span>
                                                        </label>
                                                    </template>
                                                </td>
                                                <td class="align-middle">
                                                    {{ bem.bem_id }}
                                                </td>
                                                <td class="align-middle">
                                                    {{ produto.nome }}
                                                </td>
                                                <td class="align-middle">
                                                    {{ bem.pivot.bol_devolvido == 1? 'Devolvido' : 'Emprestado' }}
                                                </td>

                                                <td class="align-middle">
                                                    {{ bem.pivot.data_devolucao|date }}
                                                </td>
                                            </tr>

                                            <tr v-if="lista_bens.length == 0">
                                                <td colspan="8" class="text-center">
                                                    <b>Nenhum registro foi encontrado!</b>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="m-portlet">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <span class="m-portlet__head-icon m--hide">
                                        <i class="la la-gear"></i>
                                    </span>
                                    <h3 class="m-portlet__head-text">
                                        Dados do responsável
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <form  v-on:submit.prevent="registrarDevolucao">
                                <div class="row form-group">
                                    <div class="col-md-4">
                                        <label>
                                            Nome <span class="required">*</span>
                                        </label>
                                        <input type="text" disabled maxlength="120" :class="'form-control m-input '" v-model="emprestimo.dados_responsavel.nome_responsavel" placeholder="Digite o nome completo">
                                        <div class="invalid-feedback">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="">
                                            CPF <span class="required">*</span>
                                        </label>
                                        <input type="text" disabled v-input-mask data-inputmask="'mask': '999.999.999-99'" v-model="emprestimo.dados_responsavel.cpf_responsavel" :class="'form-control m-input '" placeholder="CPF">
                                        <div class="invalid-feedback">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>
                                            Data da devolução
                                        </label>
                                        <input type="date" required name="data_devolucao" title="Selecione a data da devolução" v-model="emprestimo.data_devolucao" class="form-control m-input" placeholder="Digite o nome completo">
                                    </div>
                                </div>

                                <endereco ref="endereco" :dados="dados_responsavel" :disabled="true"  :errors="form_errors" class="row m-form__group"></endereco>
                                <contatos ref="contatos" :dados="dados_responsavel" :disabled="true" :errors="form_errors" class="row m-form__group"></contatos>

                                <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                                    <div class="m-form__actions m-form__actions--solid">
                                        <div class="row">
                                            <div class="col-lg-12 m--align-right">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ btn.action }}
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
    </div>
</template>

<script>
import Endereco from './inputs/Endereco.vue'
import Contatos from './inputs/Contatos.vue'
    export default {
        components: { Endereco, Contatos },
        props : ['dados'],
        name: 'DevolucaoBens',
        data() {
            return {
                urlBase: urlBase,
                titulo: 'Devolver bem',
                btn: {
                    action  : '',
                    icon    : '',
                },
                formRequest : '',
                form_errors: {},
                produto: {
                    produto_id : '',
                    nome : '',
                    descricao : '',
                    qtde_bem : 1,
                    qtde_disponivel : 0,
                    data_aquisicao : '',
                    valor_unitario : '',
                    bens_selecionados: []
                },
                emprestimo: {
                    emprestimo_bem_id: '',
                    produto_id: 0,
                    qtde_emprestar: 0,
                    data_devolucao: '',
                    bens_selecionados: [],
                    dados_responsavel: {
                        nome_responsavel: '',
                        cpf_responsavel: '',
                        endereco: [],
                        contatos: []
                    }
                },
                qtde_acrescentar: 0,
                qtd_bens: 1,
                checkAll : false,
                lista_bens: [],
                // urlRequest: '/bens/emprestar-bem',
                listaAssociados: [],
                listaResponsaveis: [],
                associado_selecionado: 0,
                responsavel_selecionado: 0,
                dados_responsavel: ''
            }
        },
        methods : {
            getAssociados: function(){
                this.$http.get(urlBase+'/api/lista-de-associados').then(response => {
                    this.listaAssociados = response.data;
                });
            },
            getResponsaveis: function(){
                this.$http.get(urlBase+'/api/lista-de-responsaveis').then(response => {
                    this.listaResponsaveis = response.data;
                });
            },
            getAssociado: function(){
                this.$http.get(urlBase+'/associados/get-associado/'+this.associado_selecionado).then(response => {
                    var associado = response.data;

                    this.emprestimo.dados_responsavel.nome_responsavel = associado.has_dados_pessoais.nome;
                    this.emprestimo.dados_responsavel.cpf_responsavel = associado.has_dados_pessoais.cpf;
                    this.dados_responsavel = associado;

                    this.$refs.endereco.endereco = associado.has_endereco;
                    this.$refs.contatos.contatos = associado.has_contatos;

                    console.log(this.$refs.endereco.endereco);
                });
            },
            registrarDevolucao : function() {
                self = this;
                self.getEndereco();
                self.getContatos();
                let url = "/bens/devolver";
                console.log(url);

                self.salvarDados(this.titulo + '?', url, this.emprestimo);
            },
            getEndereco: function() {
                this.emprestimo.dados_responsavel.endereco = this.$refs.endereco.endereco;
            },
            getResponsavel: function() {
                this.$http.get(this.urlBase+'/api/get-responsavel/'+this.responsavel_selecionado).then(response => {
                    var responsavel = response.data;

                    this.emprestimo.dados_responsavel.nome_responsavel = responsavel.nome_responsavel;
                    this.emprestimo.dados_responsavel.cpf_responsavel = responsavel.cpf_responsavel;
                    this.dados_responsavel = responsavel;

                    console.log(responsavel.has_endereco);
                    this.$refs.endereco.endereco = responsavel.has_endereco;
                    this.$refs.endereco.endereco.cidade_id = responsavel.has_endereco.cidade_id;
                    this.$refs.contatos.contatos = responsavel.has_contatos;
                });
            },
            getContatos: function() {
                this.emprestimo.dados_responsavel.contatos = this.$refs.contatos.contatos;
            },
            selecionarTodos : function() {
                let self = this;
                let select = self.lista_bens;
                self.checkAll = (self.checkAll == true) ? false : true;
                if (self.checkAll) {
                    self.lista_bens.forEach(function(bem) {
                        self.emprestimo.bens_selecionados.push(bem.bem_id);
                    });

                    this.emprestimo.qtde_emprestar = this.produto.qtde_disponivel;
                }else {
                    self.emprestimo.bens_selecionados = [];
                    this.emprestimo.qtde_emprestar = 0;
                }
            },
            atualizarQuantidade : function() {
                let self = this;
                this.emprestimo.qtde_emprestar = self.emprestimo.bens_selecionados.length;
            },
            selectAll : function() {
                let self = this;
                self.checkAll = false;
            },
            checkEdit : function() {
                var dados = null;

                if (this.dados) {
                    dados = this.dados;
                    // console.log(dados);

                    this.produto.produto_id       = dados.bens[0].has_produto.produto_id;
                    this.produto.nome             = dados.bens[0].has_produto.nome;
                    this.produto.descricao        = dados.bens[0].has_produto.descricao;
                    this.produto.data_aquisicao   = moment(dados.bens[0].data_aquisicao).format('YYYY-DD-MM');
                    this.produto.valor_unitario   = dados.bens[0].has_produto.valor_unitario;
                    this.produto.qtde_bem         = dados.bens.length;
                    // this.produto.qtde_disponivel         = dados.qtde_bens_disponiveis;
                    //
                    this.qtd_bens                  = dados.bens.length;
                    this.lista_bens               = dados.bens;
                    // this.emprestimo.dados_responsavel               = dados.responsavel;

                    this.emprestimo.dados_responsavel.nome_responsavel = dados.responsavel.nome_responsavel;
                    this.emprestimo.dados_responsavel.cpf_responsavel = dados.responsavel.cpf_responsavel;

                    this.$refs.endereco.endereco = dados.responsavel.has_endereco;
                    this.$refs.contatos.contatos = dados.responsavel.has_contatos;

                    this.emprestimo.produto_id       = dados.bens[0].has_produto.produto_id;
                    this.emprestimo.emprestimo_bem_id = dados.emprestimo_bem_id;

                    this.titulo = 'Devolver bem';

                    this.btn.action = "Registrar Devolução";
                    this.btn.icon   = "fa fa-check";

                } else {
                    this.btn.action = "Realizar Devolução";
                    this.btn.icon   = "fa fa-check";
                }
            },
        },
        mounted () {
            this.getAssociados();
            this.getResponsaveis();
            this.checkEdit();
        },
    };
</script>

<style scoped>

.msg-emprestar-bem {
    margin-left: 10px;
    color: #7b7b7b;
}

.danger {
    color: #d66565;
}

.flutuante {
    position: fixed;
    z-index: 1000;
    background-color: rgba(0,0,0, 0.1);
    padding: 10px 15px;
    border-radius: 8px;
    bottom: 25px;
}

.rigth {
    right: 75px;
}

.margin-zero{
    margin: 0px;
}

.container-responsavel {
    padding-top: 20px;
}

.margin-top-25{
    margin-top: 25px;
}
.padding-zero {
    padding: 0px;
}

.titulo-emprestar-conhecido {
    color: #3f95d4;
}
</style>
