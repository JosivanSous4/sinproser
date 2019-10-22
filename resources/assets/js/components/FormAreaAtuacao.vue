<template>
    <div id="FormAreaAtuacao">
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
                                    <input type="text" v-model="area_atuacao.nome" class="form-control m-input" placeholder="Digite o nome da área de atuação">
                                </div>
                                <div class="col-lg-6">
                                    <label>
                                        Dia previsto para pagamento:
                                    </label>
                                    <input type="number" v-model="area_atuacao.dia_previsto_pagamento" @change="diaMes()" class="form-control m-input" placeholder="Dia do mês Ex: 07">
                                    <br>
                                </div>
                                <div class="col-lg-12">
                                    <label class="">
                                        Descrição:
                                    </label>
                                    <textarea v-model="area_atuacao.descricao" class="form-control m-input"></textarea>
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
        name: 'FormAreaAtuacao',
        props: ['dados'],
        data() {
            return {
                urlBase: urlBase,
                titulo: '',
                area_atuacao : {
                    area_atuacao_id: '',
                    nome: '',
                    descricao: '',
                    dia_previsto_pagamento: ''
                }
            }
        },
        methods : {
            salvar: function() {
                self = this;

                let url = urlBase+"/configuracoes/cadastro/areas-de-atuacao/cadastrar-area-atuacao";

                Swal({
                    title: this.titulo + '?',
                    type: 'question',
                    showCancelButton: true,
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                        return self.$http.post(url, self.area_atuacao).then((response) => {
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
            diaMes : function() {
                if (this.area_atuacao.dia_previsto_pagamento > 31) {
                    this.area_atuacao.dia_previsto_pagamento = 31;
                } else if(this.area_atuacao.dia_previsto_pagamento < 1) {
                    this.area_atuacao.dia_previsto_pagamento = 1;
                }
            },
            trataDados : function(){
                if (this.dados) {
                    var dados = JSON.parse(this.dados);
                    this.area_atuacao.area_atuacao_id = dados.area_atuacao_id;
                    this.area_atuacao.nome = dados.nome;
                    this.area_atuacao.descricao = dados.descricao;
                    this.area_atuacao.dia_previsto_pagamento = dados.dia_previsto_pagamento;

                    this.titulo = "Atualizar área de atuação"
                }else{
                    this.titulo = "Cadastrar área de atuação"
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
