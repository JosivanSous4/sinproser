<template>
	<div class="formacoes">
        <div class="col-lg-3 form-group">
            <label class="">
                Tipos de Formação
            </label>
            <select class="form-control m-input m-input--square" id="tipo_contato" v-model="formacao.tipo_formacao_id"   name="tipo_contato">
                <option selected value="">Selecione</option>
            	<template v-for="tipo_formacao in listaFormacoes">
            		<option :title="tipo_formacao.descricao" :value="tipo_formacao.tipo_formacao_id">{{ tipo_formacao.nome }}</option>
            	</template>
            </select>
        </div>
		<div class="col-lg-4 form-group">
			<label class="control-label formacao">Formação</label>
			<input type="text" class="form-control" v-model="formacao.formacao" id="formacao_input" name="formacao_input" value="" placeholder="Formação" />
		</div>
        <div class="col-lg-3 form-group">
            <label class="control-label">
                Situação da Formação
            </label>
            <select class="form-control m-input m-input--square" v-model="formacao.situacao_formacao" id="tipo_contato" name="tipo_contato">
                <option selected value="">Selecione</option>
            	<option value="Completo">Completo</option>
            	<option value="Incompleto">Incompleto</option>
            </select>
        </div>
		<div class="col-lg-2 col-sm-12 form-group form-actions text-right div-btn-inserir-formacao">
			<button type="button" @click="registrarFormacao()" class="btn default" id="inserir_formacao"><i class="fa fa-plus"></i> Registrar</button>
		</div>

		<div class="col-lg-12">	
	        <table class="table table-striped- table-bordered table-hover table-checkable">
	            <thead>
	                <tr>
	                    <th>
	                        Tipo de Formação
	                    </th>
	                    <th>
	                        Formação
	                    </th>
	                    <th>
	                        Situação da Formação
	                    </th>
	                    <th class="text-center">
	                        Opções
	                    </th>
	                </tr>
	            </thead>
	            <tbody>
                    <template v-if="formacoes.length">
    	                <tr v-for="(formacao, index) in formacoes">
    	                    <td class="align-middle">
    	                        {{ formacao.tipo_formacao }}
    	                    </td>
    	                    <td class="align-middle">
    	                        {{ formacao.formacao }}
    	                    </td>
    	                    <td class="align-middle">
    	                        {{ formacao.situacao_formacao }}
    	                    </td>
    	                    <td class="text-center">
    	                        <button title="Descartar esta formação" @click="descartarFormacao(index)" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill" type="button">
    	                            <i class="la la-trash"></i>
    	                        </button>
    	                    </td>
    	                </tr>
                    </template>
                    <template v-else>                        
                        <tr>
                            <td colspan="4" class="text-center">
                                <p>Registre Formações</p>
                            </td>
                        </tr>
                    </template>
	            </tbody>
	        </table>
        </div>
	</div>
</template>

<script>
    export default {
        props: ['dados'],
        data () {
        	return {
        		formacoes: [],
        		formacao: {
                    formacao_id: '',
        			tipo_formacao_id: '',
        			situacao_formacao: '',
        			formacao: ''
        		},
        		listaFormacoes: []
        	}
        },
        methods : {
            getTiposFormacoes : function() {
                this.$http.get(urlBase+'/api/tipos-formacoes').then(response => {
                    this.listaFormacoes = response.data;
                });
            },
            registrarFormacao: function(){
            	var tipo_formacao = '';
            	var formacao = this.formacao;

            	for(var i = 0; i < this.listaFormacoes.length; i++){
            		if( formacao.tipo_formacao_id == this.listaFormacoes[i].tipo_formacao_id ){
            			tipo_formacao = this.listaFormacoes[i].nome;
                        break;
            		}
            	};

                if(formacao.tipo_formacao_id && formacao.situacao_formacao && formacao.formacao){
                	this.formacoes.push({
                        formacao_id: formacao.formacao_id,
                		tipo_formacao_id: formacao.tipo_formacao_id,
                		tipo_formacao : tipo_formacao,
                		situacao_formacao: formacao.situacao_formacao,
                		formacao: formacao.formacao
                	});

                	formacao.tipo_formacao_id = '';
                	formacao.situacao_formacao = '';
                	formacao.formacao = '';
                }
            },
        	descartarFormacao: function(index){
                this.formacoes.splice(index, 1);
            },
            checkEdit: function(){
                var dados = null;

                if(this.dados){
                    dados = JSON.parse(this.dados);

                    if(dados.has_formacoes){                    
                        dados = dados.has_formacoes;

                        for(var i = 0; i < dados.length; i++) {
                            this.formacoes.push({
                                formacao_id: dados[i].formacao_id,
                                tipo_formacao_id: dados[i].tipo_formacao_id,
                                tipo_formacao : dados[i].has_tipo_formacao.nome,
                                situacao_formacao: dados[i].situacao_formacao,
                                formacao: dados[i].formacao
                            });
                        }
                    }
                }
            }
        },
        mounted() {
            this.getTiposFormacoes();
            this.checkEdit();
        }
    };
</script>


<style scoped>
	.div-btn-inserir-formacao {
	    padding-top: 24px;
	}
</style>