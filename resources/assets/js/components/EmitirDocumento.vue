<template>
    <div id="emitir-documento">
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
										Emitir Documento
									</h3>
								</div>
							</div>
						</div>
						<form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" ref='form'>
                    		<input type="hidden" name="_token" :value="token">
							<div class="m-portlet__body">
								<div class="form-group m-form__group row">
									<div class="col-lg-6">
										<label>
											Selecione o Associado
										</label>
                                        <select v-model="form_emitir_documento.associado_id" id="associado_id" name="associado_id" :class="'form-control m-input m-input--square ' + (form_errors.associado_id ? 'is-invalid' : '')">
                                            <option value="">Selecione um associado</option>
	                                        <option v-for="associado in associados" :value="associado.associado_id">
	                                            {{ associado.nome }}
	                                        </option>
	                                    </select>
	                                    <div class="invalid-feedback">
                                            {{ form_errors.associado_id }}
                                        </div>
									</div>
									<div class="col-lg-6">
										<label>
											Selecione o Documento
										</label>
										<select v-model="form_emitir_documento.documento_id" id="documento_id" name="documento_id" :class="'form-control m-input m-input--square ' + (form_errors.documento_id ? 'is-invalid' : '')">
	                                        <option value="">Selecione um documento</option>
	                                        <option v-for="documento in documentos" :value="documento.documento_id">
	                                            {{ documento.nome }}
	                                        </option>
                                    	</select>
                                    	<div class="invalid-feedback">
                                            {{ form_errors.documento_id }}
                                        </div>
									</div>
								</div>
							</div>
							<div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
								<div class="m-form__actions m-form__actions--solid">
									<div class="row">
										<div class="col-lg-12 m--align-right">
											<button type="button" @click="imprimir()" class="btn btn-primary">
												Gerar Documento
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
    	props: ['token'],
        name: 'emitir-documento',
        data() {
            return {
            	formRequest : '',
                form_errors: {},
                titulo : 'Emitir Documento',
            	form_emitir_documento : {
            		associado_id : '',
            		documento_id : '',
            	},
            	associados : [],
            	documentos : [],
            }
        },
        methods : {
        	imprimir : function() {
                self = this;

                self.$refs.form.action = urlBase+'/documentos/emitir-documento';
                self.$refs.form.method = 'POST';
                self.$refs.form.target = '_blank';

                Swal({
                    title: this.titulo+'?',
                    type: 'question',
                    showCancelButton: true,
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                        return self.$http.post(urlBase+'/documentos/validar-documento', self.form_emitir_documento).then((response) => {
                            self.retorno = response.body;
                            self.formRequest = {};
                            self.$refs.form.submit();
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
			getDocumentos: function() {
                this.$http.get(urlBase+'/documentos/api-lista').then(response => {
                    this.documentos = response.data;
                });
            },
            getAssociados: function() {
                this.$http.get(urlBase+'/api/lista-de-associados').then(response => {
                    this.associados = response.data;
                });
            },
        },
        created () {
        	this.getDocumentos();
        	this.getAssociados();
        },
    };
</script>

<style scoped>
</style>