<template>
    <div id="form-criar-documento">
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
						<form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" v-on:submit.prevent="salvarDocumento">
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-12">
                                        <label class="">
                                            Título do documento:
                                        </label>
                                        <input type="text" v-model="documento.nome" :class="'form-control m-input '+ (form_errors.nome ? 'is-invalid' : '')" placeholder="Digite o título do documento">
                                        <div class="invalid-feedback">
                                            {{ form_errors.nome }}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
	                                <div class="col-md-12">
		                                <label class="control-label">Copie e Cole as seguintes tags onde deseja exibir:</label>
		                                <div class="row">
		                                    <div class="col-md-4">
                                                <p>{lacuna} - <span class="text-danger">Exibe um campo para digitar outros valores;</span></p>
                                                <p>{nome_associado} - <span class="text-danger">Exibir nome do associado;</span></p>
                                                <p>{sexo_associado} - <span class="text-danger">Exibe o sexo do associado;</span></p>
                                                <p>{estado_civil} - <span class="text-danger">Exibir CPF do associado;</span></p>
                                            </div>
                                            <div class="col-md-4">
                                                <p>{data_nascimento} - <span class="text-danger">Exibe a data de nascimento;</span></p>
                                                <p>{cpf_associado} - <span class="text-danger">Exibir CPF do associado;</span></p>
                                                <p>{rg_associado} - <span class="text-danger">Exibir RG do associado;</span></p>
                                                <p>{orgao_emissor_rg} - <span class="text-danger">Exibir orgão emissor RG;</span></p>
                                            </div>
                                            <div class="col-md-4">
                                                <p>{data_emissao_rg} - <span class="text-danger">Exibe a data de emissão RG;</span></p>
                                                <p>{data_associacao} - <span class="text-danger">Exibir data associação;</span></p>
                                                <p>{salario_associado} - <span class="text-danger">Exibir salário associado;</span></p>
                                            </div>
		                                </div>
		                            </div>
		                        </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-12">
                                        <label class="">
                                            Texto:
                                        </label>

                                        <wysiwyg v-model="documento.template_documento"/>

                                        <div class="invalid-feedback">
                                            {{ form_errors.template_documento }}
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
        props : ['dados'],
        name: 'form-criar-documento',
        data() {
            return {
                urlBase: '',
                titulo: 'Cadastrar Documento',
                btn: {
                    action  : '',
                    icon    : '',
                },
                formRequest : '',
                form_errors: {},
                documento: {
                    documento_id : '',
                    nome : '',
                    template_documento : '',
                },
            }
        },
        methods : {
        	salvarDocumento : function() {
                self = this;

                Swal({
                    title: this.titulo+'?',
                    type: 'question',
                    showCancelButton: true,
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                        return self.$http.post(urlBase+'/documentos/criar-documento', self.documento).then((response) => {
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
            checkEdit : function() {
                var dados = null;

                if (this.dados) {
                    dados = JSON.parse(this.dados);

                    this.documento.documento_id  	  = dados.documento_id;
                    this.documento.nome      		  = dados.nome;
                    this.documento.template_documento = dados.template_documento;

                    this.titulo = 'Editar Documento';

                    this.btn.action = "Editar";
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

</style>
