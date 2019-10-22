<template>
    <div id="endereco">
        <div class="col-lg-6 col-md-6 form-group">
            <label class="">
                Estado <span class="required">*</span>
            </label>
            <select :disabled="disabled" :class="'form-control m-input m-input--square '+ (errors.estado_id? 'is-invalid' : '')" id="exampleSelect1" v-model="endereco.estado_id" @change="getCidades">
                <option value="">{{ estado.msg }}</option>
                <template v-for="estado in listaEstados">
                    <option :value="estado.estado_id"> {{ estado.estado }} </option>
                </template>
            </select>
            <div class="invalid-feedback">
                {{errors.estado_id}}
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="form-group">
                <label for="cidade" class="control-label">
                    Cidade <span class="required">* </span>
                </label>
                <select :disabled="disabled" :class="'form-control m-input m-input--square '+(errors.cidade_id? ' is-invalid' : '') + ' ' + cidade.class" id="exampleSelect1" v-model="endereco.cidade_id">
                    <option value="0">{{ cidade.msg }}</option>
                    <template v-for="cidade in listaCidades">
                        <option :value="cidade.cidade_id"> {{ cidade.cidade }} </option>
                    </template>
                </select>
                <div class="invalid-feedback">
                    {{errors.cidade_id}}
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
                <label for="rua" class="control-label">
                    Rua <span class="required">* </span>
                </label>
                <input type="text" :disabled="disabled" maxlength="120" :class="'form-control input-circle '+ (errors.rua? 'is-invalid' : '')" v-model="endereco.rua" name="rua" id="rua" placeholder="Rua">
                <div class="invalid-feedback">
                    {{errors.rua}}
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="form-group">
                <label for="bairro" class="control-label">
                    Bairro <span class="required">* </span>
                </label>
                <input type="text" :disabled="disabled" maxlength="120" :class="'form-control input-circle '+ (errors.bairro? 'is-invalid' : '')" v-model="endereco.bairro" name="bairro" id="bairro" placeholder="Bairro">
                <div class="invalid-feedback">
                    {{errors.bairro}}
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-6">
            <div class="form-group">
                <label for="numero" class="control-label">
                    Número de residência <span class="required">* </span>
                </label>
                <input type="text" :disabled="disabled" maxlength="10" :class="'form-control input-circle '+ (errors.numero_residencia? 'is-invalid' : '')" v-model="endereco.numero_residencia" name="numero" id="numero" placeholder="ou S/N">
                <div class="invalid-feedback">
                    {{errors.numero_residencia}}
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="form-group">
                <label for="cep" class="control-label">
                    CEP <span class="required">* </span>
                </label>
                <input type="text"  :disabled="disabled" v-input-mask data-inputmask="'mask': '99999-999'" :class="'form-control input-circle '+ (errors.cep? 'is-invalid' : '')" v-model="endereco.cep" name="cep" id="cep" placeholder="CEP">
                <div class="invalid-feedback">
                    {{errors.cep}}
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 form-group">
            <label class="">
                Zona <span class="required">*</span>
            </label>
            <select :disabled="disabled" :class="'form-control m-input m-input--square '+ (errors.zona? 'is-invalid' : '')" id="exampleSelect1" v-model="endereco.zona">
                <option value="" selected>Selecione</option>
                <option value="Urbana">Urbana</option>
                <option value="Rural">Rural</option>
            </select>
            <div class="invalid-feedback">
                {{errors.zona}}
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="form-group">
                <label for="complemento" class="control-label">Complemento</label>
                <textarea type="text" :disabled="disabled" class="form-control" v-model="endereco.complemento" name="complemento" id="complemento" placeholder="Complemento"></textarea>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        props: ['dados', 'errors', 'disabled'],
        data () {
            return {
                disabilitar : '',
                endereco: {
                    endereco_id: '',
                    estado_id: 10,
                    cidade_id: 1308,
                    rua: '',
                    bairro: '',
                    numero_residencia: '',
                    complemento: '',
                    cep: '',
                    zona: ''
                },
                cidade: {
                    msg: '',
                    class: ''
                },
                estado: {
                    msg: ''
                },
                estado_id_aux: '',
                listaEstados: [],
                listaCidades: [],
            }
        },
        methods: {
            getEstados : function() {
            	this.estado.msg = "Carregando.."
                this.$http.get(urlBase+'/api/lista-estados').then(response => {
                    this.listaEstados = response.data;
                    this.estado.msg = "Selecione um estado";
                });
            },
            getCidades : function(dados) {
                this.cidade.class = "";

                if(this.endereco.estado_id == 0){
                    this.cidade.msg = "";
                    this.endereco.cidade_id = 0;
                    this.listaCidades = [];

                    return false;
                }

                if(this.endereco.estado_id == 10){
                    this.endereco.cidade_id = 1308;
                } else{
                    this.endereco.cidade_id = 0;
                }

            	this.cidade.msg = "Carregando.."
                this.$http.get(urlBase+'/api/lista-cidades/'+this.endereco.estado_id).then(response => {
                    this.listaCidades = response.data;
                    this.cidade.msg = "Selecione uma cidade";
                }, response => {
                    this.endereco.cidade_id = 0;
                    this.cidade.msg = "Erro ao carregar as cidades";
                    this.cidade.class = "error";
                });

            },
            checkEdit: function() {
                var dados = null;
                var self = this;
                
                if (self.dados) {
                    dados = JSON.parse(self.dados);
                    dados = dados.has_endereco;

                    self.endereco.endereco_id       = dados.endereco_id;
                    self.endereco.estado_id         = dados.has_cidade.estado_id;
                    self.endereco.cidade_id         = dados.has_cidade.cidade_id;
                    self.endereco.rua               = dados.rua;
                    self.endereco.bairro            = dados.bairro;
                    self.endereco.numero_residencia = dados.numero_residencia;
                    self.endereco.complemento       = dados.complemento;
                    self.endereco.cep               = dados.cep;
                    self.endereco.zona              = dados.zona;
                }
            }
        },
        mounted: function(){
            this.checkEdit();
            this.getEstados();
            this.getCidades();
        }
    };
</script>
<style scoped>
     .error{
        color: #f96b6b;
     }
</style>
