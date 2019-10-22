<template>
    <div id="FormSaida">
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
                                    Cadastro de saída
                                </h3>
                            </div>
                        </div>
                    </div>
                    <form v-on:submit.prevent="salvar" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                        <div class="m-portlet__body">
                            <div class="m-form__group form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="exampleSelect1">
                                            Tipo saída
                                        </label>
                                        <select class="form-control m-input text-uppercase" v-model="form_saida.tipo_saida_id">
                                            <option v-for="tipo_saida in tipos_saida" :value="tipo_saida.tipo_saida_id">
                                                {{tipo_saida.nome}}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>
                                            Beneficiário:
                                        </label>
                                        <input type="text" class="form-control m-input" v-model="form_saida.beneficiario" placeholder="Digite o nome do beneficiário">
                                    </div>
                                </div>
                            </div>
                            <div class="m-form__group form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label>
                                            Data da saída:
                                        </label>
                                        <input type="date" class="form-control m-input" v-model="form_saida.data_saida" placeholder="Digite o valor pago">
                                    </div>

                                    <div class="col-lg-6">
                                        <label class="">
                                            Valor:
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon2">
                                                    R$
                                                </span>
                                            </div>
                                            <money v-model="form_saida.valor"
                                                   v-bind="money"
                                                   class="form-control m-input" placeholder="Digite o valor pago" >
                                            </money>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="m-form__group form-group">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label class="">
                                            Descrição:
                                        </label>
                                        <textarea class="form-control m-input" v-model="form_saida.descricao"></textarea>
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
        name: 'FormSaida',
        props: ['saida'],
        data() {
            return {
                titulo: '',
                tipos_saida : [],
                form_saida  : {
                    saida_id        : '',
                    beneficiario    : '',
                    descricao       : '',
                    valor           : '',
                    tipo_saida_id   : '',
                    recibo_id       : '',
                    data_saida      : '',
                },
                money: {
                    decimal: ',',
                    thousands: '.',
                    // prefix: 'R$ ',
                    // suffix: ' #',
                    precision: 2,
                    masked: false
                }

            }
        },
        methods : {
            salvar: function() {
                self = this;

                let url = urlBase+"/financeiro/saida/form-saida";

                Swal({
                    title: 'Salvar saída?',
                    type: 'question',
                    showCancelButton: true,
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                        return self.$http.post(url, self.form_saida).then((response) => {
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
            }
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
            this.getTiposSaida();
        },
    };
</script>

<style scoped>

</style>
