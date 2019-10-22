<template>
    <div id="FormTipoPagamento">
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
                                    {{ titulo }}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <form v-on:submit.prevent="salvar" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                        <div class="m-portlet__body">
                            <div class="form-group m-form__group row">
                                <div class="col-lg-6">
                                    <label>
                                        Nome:
                                    </label>
                                    <input type="text" v-model="tipo_pagamento.nome" class="form-control m-input" placeholder="Digite o nome do tipo de pagamento">
                                </div>
                                <div class="col-lg-6">
                                    <label class="">
                                        Descrição:
                                    </label>
                                    <textarea v-model="tipo_pagamento.descricao" class="form-control m-input"></textarea>
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
        name: 'FormTipoPagamento',
        props: ['dados'],
        data() {
            return {
                titulo: '',
                tipo_pagamento : {
                    tipo_pagamento_id: '',
                    nome: '',
                    descricao: '',
                }
            }
        },
        methods : {
            salvar: function() {
                self = this;
                // self.$swal('Hello Vue world!!!');
                let url = urlBase+"/configuracoes/cadastro/tipos-de-pagamento/cadastrar-tipo-pagamento";

                Swal({
                    title: this.titulo + '?',
                    type: 'question',
                    showCancelButton: true,
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                        return self.$http.post(url, self.tipo_pagamento).then((response) => {
                            self.retorno = response.body;
                            self.formRequest = {};
                        }, response => {
                            var form = response.body;
                            self.formRequest = form;
                            self.retorno = 0;
                        });
                    },
                    allowOutsideClick: () => !swal.isLoading()
                }).then((result) => {
                    if (self.retorno == 0) {

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
                })
            },
            trataDados : function(){
                if (this.dados) {
                    var dados = JSON.parse(this.dados);
                    this.tipo_pagamento.tipo_pagamento_id = dados.tipo_pagamento_id;
                    this.tipo_pagamento.nome = dados.nome;
                    this.tipo_pagamento.descricao = dados.descricao;

                    this.titulo = "Atualizar tipo de Pagamento"
                }else{
                    this.titulo = "Cadastrar tipo de Pagamento"
                }
            },
        },
        created () {
            this.trataDados();
        },
    };
</script>

<style scoped>

</style>
