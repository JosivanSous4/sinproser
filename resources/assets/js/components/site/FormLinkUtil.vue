<template>
    <div id="FormLinkUtil">
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
	                                            Destino:
	                                        </label>
                                            <input type="text" name="nome" v-model="link.link" class="form-control m-input" placeholder="Digite o nome do link">
	                                    </div>
                                        <div class="col-lg-6">
	                                        <label class="">
	                                            Link:
	                                        </label>
                                            <input type="text" name="nome" v-model="link.destino" class="form-control m-input" placeholder="Digite o link">
	                                    </div>
                                    </div>
                                </div>
                                <div class="m-form__group form-group">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label class="">
                                                Descrição:
                                            </label>
                                            <textarea class="form-control m-input" v-model="link.descricao"></textarea>
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
                titulo_formulario: 'Cadastrar link',
                link: {
                    link_id     : '',
                    link        : '',
                    destino     : '',
                    descricao   : '',
                },
                urlRequest: '/associados/cadastro-de-associado',
            }
        },
        methods: {
            // handleFiles: function() {
            //     this.diretor.foto = this.$refs.files.files[0];
            // },
            submit: function(){
                self = this;
                self.form_errors = {};

                let url = "/configuracoes/gerenciar-site/links-uteis/salvar-link";
                self.salvarDados(this.titulo_formulario + '?', url, self.link);

            },
            checkEdit: function() {
                var link = null;

                // console.log(this.dados);
                if(this.dados) {
                    this.link.link_id   =   this.dados.link_id;
                    this.link.link         =   this.dados.link;
                    this.link.destino         =   this.dados.destino;
                    this.link.descricao    =   this.dados.descricao;

                    this.titulo_formulario = "Editar link";
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
