<template>
    <div id="FormDiretor">
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
                        <form :action="urlAtual" method="POST" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" id="form_diretor">
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group ">
                                	<div class="row">
                                        <div class="col-lg-6">
	                                        <label class="">
	                                            Nome:
	                                        </label>
                                            <input type="text" name="nome" v-model="diretor.nome" class="form-control m-input" placeholder="Digite o nome do parceiro">
	                                    </div>
	                                    <div class="col-lg-6">
	                                        <label class="">
	                                            Foto:
	                                        </label>
                                            <input type="file" id="files" ref="files" v-on:change="handleFiles()" class="form-control m-input"/>
	                                    </div>
                                    </div>
                                </div>

                                <input type="hidden" name="diretor_id" id="diretor_id" class="form-control m-input">
                                
                                <input type="hidden" name="cargo" id="cargo" class="form-control m-input">

                                <div class="m-form__group form-group">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label class="">
                                                Cargo:
                                            </label>
                                            <input type="text" name="cargo" v-model="diretor.cargo" class="form-control m-input" placeholder="Digite o cargo do diretor">
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
    import FileUpload from 'v-file-upload'

    export default {
        props: ['dados'],
        data () {
            return {
                urlBase : urlBase,
                titulo_formulario: 'Cadastrar diretor',
                diretor: {
                    diretor_id  : '',
                    foto        : '',
                    nome        : '',
                    cargo       : '',
                },
                urlRequest: '/associados/cadastro-de-associado',
            }
        },
        methods: {
            handleFiles: function() {
                this.diretor.foto = this.$refs.files.files[0];
            },
            prepararAssociado: function(){
                var self = this;

                document.getElementById('diretor_id').value = self.diretor.diretor_id;
                document.getElementById('cargo').value = self.diretor.cargo;

                return true;
            },
            submit: function(){
                self = this;
                self.form_errors = {};
                self.prepararAssociado();

                var formulario = document.getElementById('form_diretor');
                var form = new FormData(formulario);
                form.append('foto', self.diretor.foto);

                let url = "/configuracoes/gerenciar-site/diretor/salvar-diretor";

                self.salvarDados(this.titulo_formulario + '?', url, form);

            },
            checkEdit: function() {
                var diretor = null;

                if(this.dados) {
                    this.diretor.diretor_id   =   this.dados.diretor_id;
                    this.diretor.foto         =   this.dados.foto;
                    this.diretor.nome         =   this.dados.nome;
                    this.diretor.cargo        =   this.dados.cargo;

                    this.titulo_formulario = "Editar diretor";
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
