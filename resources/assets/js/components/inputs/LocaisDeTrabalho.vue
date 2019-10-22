<template>
    <div class="locaisDeTrabalho">
        <div class="col-lg-9">
            <label class="control-label">
                Locais de Trabalho <span class="required">* </span>
            </label>
            <div class="input-group">
                <select class="form-control m-input m-input--square" id="tipo_contato" v-model="local_trabalho.local_de_trabalho_id">
                    <option selected value="">Selecione</option>
                    <template v-for="local_trabalho in lista_locais_de_trabalho">
                        <option :title="local_trabalho.strLocalTrabalho" :value="local_trabalho.local_de_trabalho_id" v-html="local_trabalho.strLocalTrabalho"></option>
                    </template>
                </select>
                <div class="input-group-prepend">
                    <div class="input-group-text clickable" @click="getLocaisDeTrabalho()" title="Atualizar lista"><i class="fa fa-refresh"></i></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="form-group">
                <label for="numero" class="control-label">Data de vinculo <span class="required">* </span></label>
                <input type="date" class="form-control input-circle" v-model="local_trabalho.data_vinculacao" name="data_vinculacao" id="data_vinculacao" placeholder="Data do viculo">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="rua" class="control-label">Função <span class="required">* </span></label>
                <input type="text" maxlength="120" class="form-control input-circle" v-model="local_trabalho.funcao" name="funcao" id="funcao" placeholder="Função">
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="form-group">
                <label for="bairro" class="control-label">Matricula <span class="required">* </span></label>
                <input type="text" maxlength="120" class="form-control input-circle" v-model="local_trabalho.matricula" name="matricula" id="matricula" placeholder="Matricula">
            </div>
        </div>

        <div class="col-lg-12 form-group form-actions text-right div-btn-inserir-formacao">
            <button type="button" @click="inserirLocalDeTrabalho()" class="btn default" id="inserir_formacao"><i class="fa fa-plus"></i> Registrar</button>
        </div>

        <div class="col-lg-12"> 
            <table class="table table-striped- table-bordered table-hover table-checkable">
                <thead>
                    <tr>
                        <th>
                            Função
                        </th>
                        <th>
                            Matrícula
                        </th>
                        <th>
                            Data de Vínculo
                        </th>
                        <th>
                            Local de trabalho
                        </th>
                        <th class="text-center">
                            Opções
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <template v-if="locais_de_trabalho.length">
                        <tr v-for="(local_trabalho, index) in locais_de_trabalho">
                            <td>
                                {{ local_trabalho.funcao }}
                            </td>
                            <td>
                                {{ local_trabalho.matricula }}
                            </td>
                            <td>
                                {{ local_trabalho.data_vinculacao }}
                            </td>
                            <td v-html="local_trabalho.strLocalTrabalho">
                            </td>
                            <td class="text-center">
                                <button title="Descartar este local de trabalho" @click="descartarLocalDeTrabalho(index)" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill" type="button">
                                    <i class="la la-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </template>
                    <template v-else>                        
                        <tr>
                            <td colspan="5" class="text-center">
                                <p>Registre Locais de Trabalho</p>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
            <div style="color: #f4516c">
                {{errors.locais_de_trabalho}}
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['dados', 'errors'],
        data () {
            return {
                local_trabalho: {
                    associado_local_de_trabalho_id: '',
                    funcao: '',
                    matricula: '',
                    data_vinculacao: '',
                    strLocalTrabalho: '',
                    local_de_trabalho_id: '',
                },
                locais_de_trabalho: [],
                lista_locais_de_trabalho: [],
                local_trabalho_selecionado: ''
            }
        },
        methods : {
            getLocaisDeTrabalho : function() {
                this.$http.get(urlBase+'/api/locais-de-trabalho').then(response => {
                    this.lista_locais_de_trabalho = response.data;
                });
            },
            inserirLocalDeTrabalho: function(){
                for (var i = 0; i < this.lista_locais_de_trabalho.length; i++) {
                    if(this.lista_locais_de_trabalho[i].local_de_trabalho_id == this.local_trabalho.local_de_trabalho_id){
                        this.local_trabalho.strLocalTrabalho = this.lista_locais_de_trabalho[i].strLocalTrabalho;
                    }
                }
                
                if(this.local_trabalho.funcao && this.local_trabalho.matricula && this.local_trabalho.data_vinculacao && this.local_trabalho.strLocalTrabalho){
                    this.locais_de_trabalho.push({
                        associado_local_de_trabalho_id: '',
                        local_de_trabalho_id:           this.local_trabalho.local_de_trabalho_id, 
                        funcao:                         this.local_trabalho.funcao, 
                        matricula:                      this.local_trabalho.matricula, 
                        data_vinculacao:                this.local_trabalho.data_vinculacao, 
                        strLocalTrabalho:               this.local_trabalho.strLocalTrabalho
                    });

                    this.resetInputs();
                }
            },
            descartarLocalDeTrabalho: function(index){
                this.locais_de_trabalho.splice(index, 1);
            },
            resetInputs: function() {
                this.local_trabalho.local_de_trabalho_id = "";
                this.local_trabalho.funcao = "";
                this.local_trabalho.matricula = "";
                this.local_trabalho.data_vinculacao = "";
                this.local_trabalho.strLocalTrabalho = "";
            },
            checkEdit: function() {
                var dados_funcionais = null;

                if(this.dados) {
                    var dados = JSON.parse(this.dados);
                    dados = dados.has_local_trabalho;

                    for(var i = 0; i < dados.length; i++){
                        this.locais_de_trabalho.push({
                            associado_local_de_trabalho_id: dados[i].pivot.associado_local_de_trabalho_id,
                            local_de_trabalho_id:           dados[i].local_de_trabalho_id, 
                            funcao:                         dados[i].pivot.funcao, 
                            matricula:                      dados[i].pivot.matricula, 
                            data_vinculacao:                dados[i].pivot.data_vinculacao, 
                            strLocalTrabalho:               dados[i].strLocalTrabalho
                        });
                    }
                }
            }
        },
        mounted() {
            this.getLocaisDeTrabalho();
            this.checkEdit();
        }
    };
</script>


<style scoped>
    .div-btn-inserir-formacao {
        padding-top: 0px;
        padding-bottom: 10px;
    }
</style>