<template>
    <div id="form-criar-noticia">
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
										Criar notícia
									</h3>
								</div>
							</div>
						</div>
						<form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" v-on:submit.prevent="salvarNoticia" id="form_noticia">
                            <div class="m-portlet__body">
                                <div class="row form-group m-form__group">
                                    <input type="hidden" name="noticia_id" :value="noticia.noticia_id">
                                    <div class="col-lg-12 form-group">
                                        <label>
                                            Título da notícia:
                                        </label>
                                        <input type="text" name="titulo" v-model="noticia.titulo" :class="'form-control m-input '+ (form_errors.titulo ? 'is-invalid' : '')" placeholder="Informe o título da noticia">
                                        <div class="invalid-feedback">
                                            {{ form_errors.titulo }}
                                        </div>
                                    </div>
                                    <div class="row col-lg-12">
                                        <div class="col-lg-6 form-group">
                                            <label>
                                                Capa da notícia:
                                            </label>
                                            <input type="file" id="files" ref="files" name="imagem_capa" :class="(form_errors.imagem_capa ? 'is-invalid' : '')"/>
                                            <div class="error">
                                                {{ form_errors.imagem_capa }}
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-lg-12 form-group">
                                        <label>
                                            Resumo da notícia:
                                        </label>
                                        <textarea  :class="'form-control '+ (form_errors.descricao_rapida ? 'is-invalid' : '')" name="descricao_rapida" v-model="noticia.descricao_rapida" placeholder="Resuma a notícia em poucas linhas. 1 (linha inteira) a 3 linhas são suficientes"></textarea>
                                        <div class="invalid-feedback">
                                            {{ form_errors.descricao_rapida }}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="form-group col-lg-12">
                                        <label class="">
                                            Conteúdo da notícia:
                                        </label>
                                        <wysiwyg v-model="noticia.conteudo" name="conteudo" id="conteudo" placeholder="Crie aqui a sua noticia"/>
                                        <textarea name="conteudo" hidden :class="(form_errors.conteudo ? 'is-invalid' : '')" >{{ noticia.conteudo }}</textarea>
                                        <div class="error">
                                            {{ form_errors.conteudo }}
                                        </div>
                                    </div>
                                    <div class="col-lg-3 form-group">
                                        <label class="col-md-12 control-label text-left"><strong>Publicar agora?</strong></label>
                                        <div class="col-md-4 text-center">
                                            <label class="radio-inline" for="bol_ativo-1">
                                                <input type="radio" :checked="noticia.bol_ativo ? true : false" name="bol_ativo" id="bol_ativo-1" value="1">
                                                Sim
                                            </label>
                                            <label class="radio-inline" for="bol_ativo-0">
                                                <input type="radio" :checked=" !noticia.bol_ativo ? true : false" name="bol_ativo" id="bol_ativo-0" value="0">
                                                Não
                                            </label>
                                            <div class="invalid-feedback">
                                                {{ form_errors.bol_ativo }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 form-group">
                                        <label class="col-md-12 control-label text-left"><strong>Publicar como comunicado?</strong></label>
                                        <div class="col-md-4 text-center">
                                            <label class="radio-inline" for="bol_comunicado-1">
                                                <input type="radio" :checked="noticia.bol_comunicado ? true : false" name="bol_comunicado" id="bol_comunicado-1" value="1">
                                                Sim
                                            </label>
                                            <label class="radio-inline" for="bol_comunicado-0">
                                                <input type="radio" :checked=" !noticia.bol_comunicado ? true : false" name="bol_comunicado" id="bol_comunicado-0" value="0">
                                                Não
                                            </label>
                                            <div class="invalid-feedback">
                                                {{ form_errors.bol_comunicado }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 form-group">
                                        <label class="col-md-12 control-label text-left"><strong>Publicar como destaque?</strong></label>
                                        <div class="col-md-4 text-center">
                                            <label class="radio-inline" for="bol_destaque-1">
                                                <input type="radio" :checked="noticia.bol_destaque ? true : false" name="bol_destaque" id="bol_destaque-1" value="1">
                                                Sim
                                            </label>
                                            <label class="radio-inline" for="bol_destaque-0">
                                                <input type="radio" :checked=" !noticia.bol_destaque ? true : false" name="bol_destaque" id="bol_destaque-0" value="0">
                                                Não
                                            </label>
                                            <div class="invalid-feedback">
                                                {{ form_errors.bol_destaque }}
                                            </div>
                                        </div>
                                    </div>
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
        name: 'form-criar-noticia',
        props: ['dados'],
        data() {
            return {
                urlBase: urlBase,
                titulo: 'Cadastrar notícia',
                btn: {
                    action  : '',
                    icon    : '', 
                },
                formRequest : '',
                form_errors: {},
                noticia: {
                    noticia_id : '',
                    titulo : '',
                    conteudo : '',
                    descricao_rapida : '',
                    num_views : '',
                    bol_ativo : '',
                    bol_comunicado : '',
                    bol_destaque : '',
                },
                urlRequest: '/configuracoes/gerenciar-site/criar-noticia'
            }
        },
        methods : {
        	salvarNoticia : function() {
                self = this;
                self.form_errors = {};

                if(this.noticia.noticia_id){
                    this.urlRequest = '/configuracoes/gerenciar-site/editar-noticia';
                }

                var formulario = document.getElementById('form_noticia');
                var form = new FormData(formulario);

                form.append('foto', self.$refs.files.files[0]);

                self.salvarDados(self.titulo + '?', self.urlRequest, form);
            },
            checkEdit : function() {
                var dados = null;

                if (this.dados) {
                    dados = JSON.parse(this.dados);

                    this.noticia.noticia_id         = dados.noticia_id;
                    this.noticia.titulo             = dados.titulo;
                    this.noticia.conteudo           = dados.conteudo;
                    this.noticia.descricao_rapida   = dados.descricao_rapida;
                    this.noticia.num_views          = dados.num_views;
                    this.noticia.bol_ativo          = dados.bol_ativo;
                    this.noticia.bol_destaque       = dados.bol_destaque;
                    this.noticia.bol_comunicado     = dados.bol_comunicado;

                    this.titulo = 'Editar notícia';

                    this.btn.action = "Salvar";
                    this.btn.icon   = "fa fa-check";
                } else {
                    this.titulo = 'Criar notícia';

                    this.btn.action = "Criar notícia";
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
</style>