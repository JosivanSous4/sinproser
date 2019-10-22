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
                                <input type="hidden" name="associado_id" v-model="associado.associado_id">
                                <div class="offset-4" style="margin-bottom: -15px; margin-top: 15px">
                                    <label class="col-md-4 control-label text-center" for="radios"><strong>Este associado é professor?</strong></label>
                                    <div class="col-md-4 text-center">
                                        <label class="radio-inline" for="radios-0">
                                            <input type="radio" :checked="associado.bool_professor? true : false" name="bool_professor" id="radios-0" value="1">
                                            Sim
                                        </label> &nbsp;
                                        <label class="radio-inline" for="radios-1">
                                            <input type="radio" :checked="!associado.bool_professor? true : false" name="bool_professor" id="radios-1" value="0" checked="checked">
                                            Não
                                        </label>
                                    </div>
                                </div>

                                <dados-pessoais ref="dados_pessoais" :dados="dados_associado" :errors="form_errors" class="row m-form__group"></dados-pessoais>
                                <endereco ref="endereco" :dados="dados_associado" :errors="form_errors" class="row m-form__group"></endereco>
                                <contatos ref="contatos" :dados="dados_associado" :errors="form_errors" class="row m-form__group"></contatos>
                                <div class="m-form__group">
                                	<div class="row">
	                                    <div class="col-lg-4 offset-4 form-group">
	                                        <label class="">
	                                            Foto:
	                                        </label>
                                            <input type="file" id="files" ref="files" v-on:change="handleFiles()"/>
	                                    </div>
                                    </div>
                                    <div class="row">
	                                    <div class="col-lg-3 form-group">
	                                        <label>
	                                            Data de associação
	                                        </label>
	                                        <input type="date" name="data_associacao" v-model="associado.data_associacao" class="form-control m-input" placeholder="Digite o nome completo">
	                                    </div>
	                                    <div class="col-lg-3 form-group">
		                                    <label class="">
		                                        Tipo de pagamento <span class="required">*</span>
		                                    </label>
                                            <select :class="'form-control m-input m-input--square '+ (form_errors.tipo_pagamento_id? 'is-invalid' : '')" name="tipo_pagamento_id" v-model="associado.tipo_pagamento_id" id="exampleSelect1">
                                                <option selected value="">Selecione</option>
                                                <template v-for="tipo_pagamento in lista_tipos_pagamento">
                                                    <option :value="tipo_pagamento.tipo_pagamento_id">
                                                        {{ tipo_pagamento.nome }}
                                                    </option>
                                                </template>
                                            </select>
                                            <div class="invalid-feedback">
                                                {{form_errors.tipo_pagamento_id}}
                                            </div>
		                                </div>
		                                <div class="col-lg-3">
		                                    <label class="">
		                                        Área de atuação <span class="required">*</span>
		                                    </label>
		                                    <select :class="'form-control m-input m-input--square '+ (form_errors.area_atuacao_id? 'is-invalid' : '')" name="area_atuacao_id" v-model="associado.area_atuacao_id" id="exampleSelect1">
                                                <option selected value="">Selecione</option>
                                                <template v-for="area_atuacao in lista_areas_atuacao">
                                                    <option :value="area_atuacao.area_atuacao_id">
                                                        {{ area_atuacao.nome }}
                                                    </option>
                                                </template>
                                            </select>
                                            <div class="invalid-feedback">
                                                {{form_errors.area_atuacao_id}}
                                            </div>
		                                </div>
                                        <div class="col-lg-3 form-group">
                                            <label class="">
                                                Salário <span class="required">*</span>
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon2">
                                                        R$
                                                    </span>
                                                </div>
                                                <money v-model="associado.salario" v-bind="money"  name="salario" :class="'form-control m-input money '+ (form_errors.salario? 'is-invalid' : '')"></money>
                                                <div class="invalid-feedback">
                                                    {{form_errors.salario}}
                                                </div>
                                            </div>
                                        </div>
	                                </div>
                                </div>
                                <div class="col-lg-12 text-center div-grau-instrucao">
	                                <div class="col-lg-4 offset-lg-4">
	                                    <label class="">
	                                        Grau de instrução <span class="required">*</span>:
	                                    </label>
	                                    <select :class="'form-control m-input m-input--square '+ (form_errors.grau_instrucao_id? 'is-invalid' : '')" name="grau_instrucao_id" v-model="associado.grau_instrucao_id" id="exampleSelect1">
                                            <option selected value="">Selecione</option>
                                            <template v-for="grau_instrucao in lista_graus_instrucao">
                                                <option :value="grau_instrucao.grau_instrucao_id">
                                                    {{ grau_instrucao.nome }}
                                                </option>
                                            </template>
	                                    </select>
                                        <div class="invalid-feedback">
                                            {{form_errors.grau_instrucao_id}}
                                        </div>
	                                </div>
                                </div>

                                <formacoes ref="formacoes" :dados="dados_associado" :errors="form_errors" class="row m-form__group"></formacoes>
                                <dados-funcionais ref="dados_funcionais" :dados="dados_associado" :errors="form_errors" class="row form-group m-form__group"></dados-funcionais>
                                <locais-de-trabalho ref="locais_de_trabalho" :dados="dados_associado" :errors="form_errors" class="row form-group m-form__group"></locais-de-trabalho>

                                <textarea style="display: none" name="dados_pessoais" id="dados_pessoais"></textarea>
                                <textarea style="display: none" name="endereco" id="dados_endereco"></textarea>
                                <textarea style="display: none" name="contatos" id="dados_contatos"></textarea>
                                <textarea style="display: none" name="formacoes" id="dados_formacoes"></textarea>
                                <textarea style="display: none" name="dados_funcionais" id="dados_funcionais"></textarea>
                                <textarea style="display: none" name="locais_de_trabalho" id="locais_de_trabalho"></textarea>
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

    import DadosPessoais from './inputs/DadosPessoais.vue'
    import DadosFuncionais from './inputs/DadosFuncionais.vue'
    import Endereco from './inputs/Endereco.vue'
    import Contatos from './inputs/Contatos.vue'
    import Formacoes from './inputs/Formacoes.vue'
    import LocaisDeTrabalho from './inputs/LocaisDeTrabalho.vue'
    import FileUpload from 'v-file-upload'

    export default {
        props: ['dados_associado'],
        components: { DadosPessoais , DadosFuncionais, Endereco, Contatos, Formacoes, LocaisDeTrabalho },
        data () {
            return {
                urlBase : urlBase,
                titulo_formulario: 'Cadastrar associado',
                associado: {
                    associado_id: '',
                    foto: '',
                    area_atuacao_id: '',
                    bool_professor: false,
                    salario: '',
                    data_associacao: '',
                    grau_instrucao_id: '',
                    tipo_pagamento_id: '',
                    dados_pessoais: '',
                    endereco: '',
                    contatos: '',
                    formacoes: '',
                    dados_funcionais: '',
                    locais_de_trabalho: ''
                },
                lista_graus_instrucao: '',
                lista_tipos_pagamento: '',
                lista_areas_atuacao: '',
                urlRequest: '/associados/cadastro-de-associado',
            }
        },
        methods: {
            getGrausInstrucao : function() {
                this.$http.get(this.urlBase+'/api/graus-instrucao').then(response => {
                    this.lista_graus_instrucao = response.data;
                });
            },
            getTiposPagamento : function() {
                this.$http.get(this.urlBase+'/api/tipos-pagamento').then(response => {
                    this.lista_tipos_pagamento = response.data;
                });
            },
            getAreasAtuacao : function() {
                this.$http.get(this.urlBase+'/api/areas-atuacao').then(response => {
                    this.lista_areas_atuacao = response.data;
                });
            },
            getDadosPessoais: function() {
                var self = this;
                self.associado.dados_pessoais = JSON.stringify(self.$refs.dados_pessoais.dados_pessoais);
                document.getElementById('dados_pessoais').value = self.associado.dados_pessoais;
            },
            getEndereco: function() {
                var self = this;
                self.associado.endereco = JSON.stringify(self.$refs.endereco.endereco);
                document.getElementById('dados_endereco').value = self.associado.endereco;
            },
            getContatos: function() {
                var self = this;

                if(self.$refs.contatos.contatos.length){
                    self.associado.contatos = JSON.stringify(self.$refs.contatos.contatos);
                    document.getElementById('dados_contatos').value = self.associado.contatos;
                } else {
                    document.getElementById('dados_contatos').value = '';
                }
            },
            getFormacoes: function() {
                var self = this;
                self.associado.formacoes = JSON.stringify(self.$refs.formacoes.formacoes);
                document.getElementById('dados_formacoes').value = self.associado.formacoes;
            },
            getDadosFuncionais: function() {
                var self = this;
                self.associado.dados_funcionais = JSON.stringify(self.$refs.dados_funcionais.dados_funcionais);
                document.getElementById('dados_funcionais').value = self.associado.dados_funcionais;
            },
            getLocaisDeTrabalho: function() {
                var self = this;

                if(self.$refs.locais_de_trabalho.locais_de_trabalho.length){
                    self.associado.locais_de_trabalho = JSON.stringify(self.$refs.locais_de_trabalho.locais_de_trabalho);
                    document.getElementById('locais_de_trabalho').value = self.associado.locais_de_trabalho;
                } else {
                    document.getElementById('locais_de_trabalho').value = '';
                }
            },
            handleFiles: function() {
                this.associado.foto = this.$refs.files.files[0];
            },
            prepararAssociado: function(){
                var self = this;

                self.getDadosPessoais();
                self.getEndereco();
                self.getContatos();
                self.getFormacoes();
                self.getDadosFuncionais();
                self.getLocaisDeTrabalho();

                return true;
            },
            submit: function(){
                self = this;
                self.form_errors = {};
                self.prepararAssociado();

                var formulario = document.getElementById('form_associado');
                var form = new FormData(formulario);
                form.append('foto', self.associado.foto);

                self.salvarDados(this.titulo_formulario + '?', this.urlRequest, form);

            },
            checkEdit: function() {
                var associado = null;

                if(this.dados_associado) {
                    associado = JSON.parse(this.dados_associado);

                    this.associado.associado_id        =   associado.associado_id;
                    this.associado.foto                =   associado.nome;
                    this.associado.bool_professor      =   associado.bool_professor;
                    this.associado.area_atuacao_id     =   associado.area_atuacao_id;
                    this.associado.data_associacao     =   associado.data_associacao;
                    this.associado.grau_instrucao_id   =   associado.grau_instrucao_id;
                    this.associado.tipo_pagamento_id   =   associado.tipo_pagamento_id;
                    this.associado.salario             =   associado.salario;

                    this.associado.dados_pessoais   =   associado.has_dados_pessoais;

                    this.titulo_formulario = "Editar associado";

                    this.urlRequest = '/associados/editar-associado';
                }
            }
        },
        mounted() {
            this.getGrausInstrucao();
            this.getTiposPagamento();
            this.getAreasAtuacao();
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
