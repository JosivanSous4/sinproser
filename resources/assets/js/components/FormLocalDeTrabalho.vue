<template>
    <div id="formLocalDeTrabalho">
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
                                        Cadastro de Local de trabalho
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                            <div class="m-portlet__body">
                                <div class="row m-form__group">
                                    <div class="col-lg-12 form-group">
                                        <label>
                                            Nome:
                                        </label>
                                        <input type="text" class="form-control m-input" placeholder="Digite o nome completo" v-model="localDeTrabalho.nome">
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="complemento" class="control-label">Descrição</label>
                                            <textarea type="text" class="form-control" name="complemento" id="complemento" placeholder="Você pode fazer uma breve descrição deste local de trabalho. (opcional)"  v-model="localDeTrabalho.descricao"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <endereco ref="endereco" :dados="local_trabalho" :errors="form_errors" class="row m-form__group"></endereco>
                                <contatos ref="contatos" :dados="local_trabalho" :errors="form_errors" class="row m-form__group"></contatos>
                            </div>
                            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                                <div class="m-form__actions m-form__actions--solid">
                                    <div class="row">
                                        <div class="col-lg-12 m--align-right">
                                            <button type="button" class="btn btn-primary" @click="salvarLocalDeTrabalho()">
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

    import Endereco from './inputs/Endereco.vue'
    import Contatos from './inputs/Contatos.vue'

    export default {
        props: ['local_trabalho'],
        components: { Endereco, Contatos },
        data () {
            return{
                localDeTrabalho: {
                    local_de_trabalho_id: '',
                    nome: '',
                    descricao: '',
                    endereco: '',
                    contatos: []
                }
            }
        },
        methods: {
            getEndereco: function() {
                this.localDeTrabalho.endereco = this.$refs.endereco.endereco;
            },
            getContatos: function() {
                this.localDeTrabalho.contatos = this.$refs.contatos.contatos;
            },
            salvarLocalDeTrabalho: function(){
                
                this.getEndereco();
                this.getContatos();

                this.salvarDados( 'Confirmar operação?', '/configuracoes/cadastro/locais-de-trabalho/cadastro-de-local-de-trabalho', this.localDeTrabalho);
            },
            checkEdit : function() {
                var local_trabalho = null;

                if (this.local_trabalho) {
                    local_trabalho = JSON.parse(this.local_trabalho);
                    this.localDeTrabalho.local_de_trabalho_id = local_trabalho.local_de_trabalho_id;
                    this.localDeTrabalho.nome = local_trabalho.nome;
                    this.localDeTrabalho.descricao = local_trabalho.descricao;
                }
            },
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