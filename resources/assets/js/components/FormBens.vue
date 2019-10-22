<template>
    <div id="form-bens">
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
                                        Cadastro de Bens
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" v-on:submit.prevent="salvarBem">
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6 form-group">
                                        <label class="">
                                            Nome do bem:
                                        </label>
                                        <input type="text" v-model="produto.nome" :class="'form-control m-input '+ (form_errors.nome ? 'is-invalid' : '')" placeholder="Digite o nome do bem" title="Digite o nome do bem">
                                        <div class="invalid-feedback">
                                            {{ form_errors.nome }}
                                        </div>
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <label>
                                            Descrição:
                                        </label>
                                        <textarea v-model="produto.descricao" name="descricao" :class="'form-control m-input '+ (form_errors.descricao ? 'is-invalid' : '')" placeholder="Digite a descrição" title="Descreva o bem"></textarea>
                                        <div class="invalid-feedback">
                                            {{ form_errors.descricao }}
                                        </div>
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
                                            <input type="date" v-model="produto.data_aquisicao" :class="'form-control m-input '+ (form_errors.data_aquisicao ? 'is-invalid' : '')" name="data_aquisicao" title="Data em que recebeu o bem"/>
                                            <div class="invalid-feedback">
                                                {{ form_errors.data_aquisicao }}
                                            </div>
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
                                            <money v-model="produto.valor_unitario" name="valor_unitario" v-bind="money" :class="'form-control m-input money '+ (form_errors.valor_unitario ? 'is-invalid' : '')" title="Valor unitário do bem"></money>
                                            <div class="invalid-feedback">
                                                {{ form_errors.valor_unitario }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 form-group">
                                        <label class="">
                                            Quantidade de bens:
                                        </label>
                                        <template v-if="produto.produto_id">
                                            <input type="number" v-model="produto.qtde_bem" disabled :class="'form-control m-input '+ (form_errors.qtde_bem ? 'is-invalid' : '')" placeholder="Digite a quantidade de bens" title="O sindicato possui quantos itens iguais a este?">
                                        </template>
                                        <template v-else>
                                            <input type="number" v-model="produto.qtde_bem" :class="'form-control m-input '+ (form_errors.qtde_bem ? 'is-invalid' : '')" placeholder="Digite a quantidade de bens" title="O sindicato possui quantos itens iguais a este?">
                                        </template>
                                        <div class="invalid-feedback">
                                            {{ form_errors.qtde_bem }}
                                        </div>
                                    </div>

                                    <div class="col-lg-4 offset-4 form-group" v-if="produto.produto_id">
                                        <label class="">
                                            Adicionar {{ produto.nome }}
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon2">
                                                    +
                                                </span>
                                            </div>
                                            <input type="number" v-model="qtde_acrescentar" :class="'form-control m-input '+ (form_errors.qtde_bem ? 'is-invalid' : '')" placeholder="Digite a quantidade a ser acrescentada" title="O sindicato possui quantos itens iguais a este?">
                                        </div>
                                    </div>
                                    <template v-if="produto.produto_id">
                                        <div class="table-responsive col-md-12">
                                            <br>
                                            <h5 class="msg-remover-bem">Selecione apenas os que deseja <span class="danger">REMOVER</span></h5>
                                            <table class="table table-striped- table-bordered table-hover table-checkable">
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
                                                            Status
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-if="lista_bens.length != 0" v-for="bem in lista_bens">
                                                        <td class="align-middle">
                                                            <label class="m-checkbox m-checkbox--state-primary align-middle" style="padding-left: 10px !important;">
                                                                <input type="checkbox" v-model="produto.bens_selecionados" :value="bem.bem_id" @click="selectAll()" @change="atualizarQuantidade()">
                                                                <span></span>
                                                            </label>
                                                        </td>
                                                        <td class="align-middle">
                                                            {{ bem.bem_id }}
                                                        </td>
                                                        <td class="align-middle">
                                                            {{ produto.nome }}
                                                        </td>
                                                        <td class="align-middle">
                                                            {{ bem.has_status.status }}
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
                                    </template>
                                </div>
                            </div>
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
</template>

<script>
    export default {
        props : ['dados'],
        name: 'form-bens',
        data() {
            return {
                urlBase: urlBase,
                titulo: 'Cadastrar Bem',
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
                    data_aquisicao : '',
                    valor_unitario : '',
                    bens_selecionados: []
                },
                qtde_acrescentar: 0,
                qtd_bens: 1,
                checkAll : false,
                lista_bens: [],
            }
        },
        methods : {
            salvarBem : function() {
                self = this;

                if(this.produto.produto_id && this.qtde_acrescentar > 0){
                    this.produto.qtde_bem = parseInt(this.produto.qtde_bem) + parseInt(this.qtde_acrescentar);
                }

                Swal({
                    title: this.titulo+'?',
                    type: 'question',
                    showCancelButton: true,
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                        return self.$http.post(urlBase+'/bens/cadastro-de-bens', self.produto).then((response) => {
                            self.retorno = response.body;
                            self.formRequest = {};
                        }, response => {
                            var form = response.body;
                            self.formRequest = form.errors;
                            self.retorno = 0;
                        });
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    if (self.retorno == 0) {
                        self.form_errors = self.mountErrors(self.formRequest);
                        var msg = self.formErros(self.formRequest);

                        return Swal({
                            type: 'error',
                            title: 'Há campos em brancos!',
                            html: msg,
                        });
                    }

                    return Swal({
                        type: self.retorno.status,
                        title: self.retorno.msg,
                    });
                }).catch(Swal.noop)
            },
            selecionarTodos : function() {
                let self = this;
                let select = self.lista_bens;
                self.checkAll = (self.checkAll == true) ? false : true;
                if (self.checkAll) {
                    self.lista_bens.forEach(function(bem) {
                        self.produto.bens_selecionados.push(bem.bem_id);
                    });

                    self.produto.qtde_bem = 0;
                }else {
                    self.produto.bens_selecionados = [];
                    self.produto.qtde_bem = self.qtd_bens - self.produto.bens_selecionados.length;
                }
            },
            atualizarQuantidade : function() {
                let self = this;
                self.produto.qtde_bem = self.qtd_bens - self.produto.bens_selecionados.length;
            },
            selectAll : function() {
                let self = this;
                self.checkAll = false;
            },
            checkEdit : function() {
                var dados = null;

                if (this.dados) {
                    dados = JSON.parse(this.dados);

                    this.produto.produto_id       = dados.produto_id;
                    this.produto.nome             = dados.nome;
                    this.produto.descricao        = dados.descricao;
                    this.produto.data_aquisicao   = moment(dados.data_aquisicao).format('YYYY-DD-MM');
                    this.produto.valor_unitario   = dados.valor_unitario;
                    this.produto.qtde_bem         = dados.qtde_bem;

                    this.qtd_bens                  = dados.qtde_bem;
                    this.lista_bens               = dados.has_bens;

                    this.titulo = 'Editar Bem';

                    this.btn.action = "Salvar";
                    this.btn.icon   = "fa fa-check";
                } else {
                    this.btn.action = "Cadastrar";
                    this.btn.icon   = "fa fa-check";
                }
            },
        },
        mounted () {
            this.checkEdit();
        },
    };
</script>

<style scoped>

.msg-remover-bem {
    margin-left: 10px;
    color: #7b7b7b;
}

.danger {
    color: #d66565;
}
</style>
