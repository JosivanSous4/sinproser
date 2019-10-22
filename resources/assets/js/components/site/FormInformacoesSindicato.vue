<template>
    <div id="form-informacoes-sindicato">
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
                        <form id="form_sindicato" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" v-on:submit.prevent="salvar">
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-7">
                                        <label class="">
                                            Nome:
                                        </label>
                                        <input type="text" v-model="sindicato.nome" :class="'form-control m-input '+ (form_errors.nome ? 'is-invalid' : '')" placeholder="Digite o nome do sindicato">
                                        <div class="invalid-feedback">
                                            {{ form_errors.nome }}
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="">
                                            Imagem:
                                        </label>
                                        <input type="file" id="files" ref="files" v-on:change="handleFiles()" class="form-control m-input"/>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-12">
                                        <label class="">
                                            Sobre Nós:
                                        </label>

                                        <wysiwyg v-model="sindicato.descricao"/>

                                        <div class="invalid-feedback">
                                            {{ form_errors.descricao }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" id="nome" name="nome">
                            <input type="hidden" id="sindicato_id" name="sindicato_id">
                            <textarea style="display: none" name="endereco" id="endereco"></textarea>
                            <textarea style="display: none" name="contatos" id="contatos"></textarea>
                            <textarea style="display: none" name="descricao" id="descricao"></textarea>

                            <endereco ref='endereco' :errors="form_errors" class="row m-form__group"></endereco>
                            <contatos ref='contatos' :errors="form_errors" class="row m-form__group"></contatos>

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
    import Endereco from './../inputs/Endereco.vue'
    import Contatos from './../inputs/Contatos.vue'

    export default {
        props : ['dados'],
        components: { Endereco, Contatos },
        name: 'form-informacoes-sindicato',
        data() {
            return {
                urlBase: '',
                titulo: 'Informações Sindicato',
                formRequest : '',
                form_errors: {},
                sindicato: {
                    sindicato_id : '',
                    foto : '',
                    nome : '',
                    descricao : '',
                    endereco: {},
                    contatos: [{}],
                },
            }
        },
        methods : {
            prepararSindicato: function(){
                var self = this;

                document.getElementById('nome').value           = self.sindicato.nome;
                document.getElementById('sindicato_id').value   = self.sindicato.sindicato_id;
                document.getElementById('descricao').value      = self.sindicato.descricao;
            },
            handleFiles: function() {
                this.sindicato.foto = this.$refs.files.files[0];
            },
            salvar : function() {
                self = this;

                self.getEndereco();
                self.getContatos();
                self.prepararSindicato();
                var formulario = document.getElementById('form_sindicato');
                var form = new FormData(formulario);
                form.append('foto', self.sindicato.foto);

                Swal({
                    title: 'Salvar Informações?',
                    type: 'question',
                    showCancelButton: true,
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                        return self.$http.post(urlBase+'/configuracoes/gerenciar-site/informacoes-sindicato', form).then((response) => {
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
            getEndereco: function() {
                this.sindicato.endereco = this.$refs.endereco.endereco;
                document.getElementById('endereco').value      = JSON.stringify(this.sindicato.endereco);

            },
            getContatos: function() {
                this.sindicato.contatos = this.$refs.contatos.contatos;
                document.getElementById('contatos').value      = JSON.stringify(this.sindicato.contatos);
            },
            checkEdit : function() {
                var dados = null;

                if (this.dados) {
                    dados = JSON.parse(this.dados);

                    this.sindicato.sindicato_id  = dados.sindicato_id;
                    this.sindicato.nome          = dados.nome;
                    this.sindicato.descricao     = dados.descricao;

                    this.sindicato.endereco      =   dados.has_endereco;
                    this.sindicato.contatos      =   dados.has_contatos;

                    this.$refs.contatos.contatos           = dados.has_contatos;
                    this.$refs.endereco.endereco           = dados.has_endereco;
                    this.$refs.endereco.endereco.estado_id = dados.has_endereco.has_cidade.estado_id;

                }
            },
        },
        mounted () {
            this.checkEdit();
        },
    };
</script>

<style scoped>
</style>
