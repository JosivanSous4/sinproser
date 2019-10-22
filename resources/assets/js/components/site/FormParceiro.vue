<template>
    <div id="formAssociado">
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
                                        {{ titulo_formulario }}
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <form :action="urlAtual" method="POST" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" id="form_associado">
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group ">
                                	<div class="row">
                                        <div class="col-lg-6">
	                                        <label class="">
	                                            Nome:
	                                        </label>
                                            <input type="text" name="nome" v-model="parceiro.nome" class="form-control m-input" placeholder="Digite o nome do parceiro">
	                                    </div>
	                                    <div class="col-lg-6">
	                                        <label class="">
	                                            Foto:
	                                        </label>
                                            <input type="file" id="files" ref="files" v-on:change="handleFiles()" class="form-control m-input"/>
	                                    </div>
                                    </div>
                                </div>
                                <endereco ref="endereco" :dados="parceiro.endereco" :errors="form_errors" class="row m-form__group"></endereco>
                                <contatos ref="contatos" :dados="parceiro.contatos" :errors="form_errors" class="row m-form__group"></contatos>
                                <textarea style="display: none" name="endereco" id="dados_endereco"></textarea>
                                <textarea style="display: none" name="contatos" id="dados_contatos"></textarea>
                                <textarea style="display: none" name="descricao" id="descricao"></textarea>
                                <input type="hidden" name="parceiro_id" id="parceiro_id" class="form-control m-input">

                                <div class="m-form__group form-group">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label class="">
                                                Descrição dos serviços prestados:
                                            </label>
                                            <textarea required class="form-control m-input" v-model="parceiro.descricao"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                                <div class="m-form__actions m-form__actions--solid">
                                    <div class="row">
                                        <div class="col-lg-12 m--align-right">
                                            <button type="button" @click="submit()" class="btn btn-primary">
                                                Salvar
                                            </button>
                                            <a style="border-color: transparent;" :href="this.urlBase + '/associados/lista-de-associados'" type="reset" class="btn btn-secondary">
                                                Cancelar
                                            </a>
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
    import FileUpload from 'v-file-upload'

    export default {
        props: ['dados'],
        components: { Endereco, Contatos },
        data () {
            return {
                urlBase : urlBase,
                titulo_formulario: 'Cadastrar parceiro',
                parceiro: {
                    parceiro_id : '',
                    foto: '',
                    nome: '',
                    endereco: '',
                    contatos: '',
                    descricao: '',
                },
                lista_graus_instrucao: '',
                lista_tipos_pagamento: '',
                lista_areas_atuacao: '',
                urlRequest: '/associados/cadastro-de-associado',
            }
        },
        methods: {
            getEndereco: function() {
                var self = this;

                self.parceiro.endereco = JSON.stringify(self.$refs.endereco.endereco);
                document.getElementById('dados_endereco').value = self.parceiro.endereco;

            },
            getContatos: function() {
                var self = this;

                if(self.$refs.contatos.contatos.length){
                    self.parceiro.contatos = JSON.stringify(self.$refs.contatos.contatos);
                    document.getElementById('dados_contatos').value = self.parceiro.contatos;
                } else {
                    document.getElementById('dados_contatos').value = '';
                }

            },
            handleFiles: function() {
                this.parceiro.foto = this.$refs.files.files[0];
            },
            prepararAssociado: function(){
                var self = this;

                self.getEndereco();
                self.getContatos();
                document.getElementById('descricao').value = self.parceiro.descricao;

                return true;
            },
            submit: function(){
                self = this;
                self.form_errors = {};
                self.prepararAssociado();
                document.getElementById('parceiro_id').value = self.parceiro.parceiro_id;

                var formulario = document.getElementById('form_associado');
                var form = new FormData(formulario);
                form.append('foto', self.parceiro.foto);

                let url = "/configuracoes/gerenciar-site/parceiros/salvar-parceiro";
                self.salvarDados(this.titulo_formulario + '?', url, form);

            },
            checkEdit: function() {
                var associado = null;

                if(this.dados) {

                    this.parceiro.parceiro_id   =   this.dados.parceiro_id;
                    this.parceiro.foto          =   this.dados.foto;
                    this.parceiro.nome          =   this.dados.nome;
                    this.parceiro.endereco      =   this.dados.has_endereco;
                    this.parceiro.contatos      =   this.dados.has_contatos;
                    this.parceiro.descricao     =   this.dados.descricao;
                    this.$refs.contatos.contatos = this.dados.has_contatos;

                    this.$refs.endereco.endereco.endereco_id         = this.dados.has_endereco.endereco_id;
                    this.$refs.endereco.endereco.estado_id           = this.dados.has_endereco.has_cidade.estado_id;
                    this.$refs.endereco.endereco.cidade_id           = this.dados.has_endereco.cidade_id;
                    this.$refs.endereco.endereco.rua                 = this.dados.has_endereco.rua;
                    this.$refs.endereco.endereco.bairro              = this.dados.has_endereco.bairro;
                    this.$refs.endereco.endereco.numero_residencia   = this.dados.has_endereco.numero_residencia;
                    this.$refs.endereco.endereco.complemento         = this.dados.has_endereco.complemento;
                    this.$refs.endereco.endereco.cep                 = this.dados.has_endereco.cep;
                    this.$refs.endereco.endereco.zona                 = this.dados.has_endereco.zona;
                                                
                    this.titulo_formulario = "Editar associado";

                    this.urlRequest = '/associados/editar-associado';
                }
            }
        },
        mounted() {
            this.checkEdit();
        }
    };
</script>

<style scoped>
	.div-grau-instrucao {
		margin-top: 15px;
		padding-bottom: 0px;
	}
</style>
