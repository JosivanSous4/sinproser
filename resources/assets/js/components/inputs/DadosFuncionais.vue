<template>
    <div id="dadosFuncionais">
        <div class="col-lg-4 form-group">
            <label>
                Data de Admissão
            </label>
            <input type="date" v-model="dados_funcionais.data_admissao" class="form-control m-input" placeholder="Digite o nome completo">
        </div>
        <div class="col-lg-4 form-group">
            <label>
                PIS/PASEP <span class="required">*</span>
            </label>
            <input type="text" maxlength="120" v-model="dados_funcionais.pis_pasep" :class="'form-control m-input '+ (errors.pis_pasep ? 'is-invalid' : '')" placeholder="PIS/PASEP" v-input-mask data-inputmask="'mask': '999.99999.99-9'">
            <div class="invalid-feedback">
                {{errors.pis_pasep}}
            </div>
        </div>
        <div class="col-lg-4 form-group">
            <label>
                Portaria <span class="required">*</span>
            </label>
            <input type="text" maxlength="120" v-model="dados_funcionais.portaria" :class="'form-control m-input '+ (errors.portaria ? 'is-invalid' : '')" placeholder="Portaria">
            <div class="invalid-feedback">
                {{errors.portaria}}
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['dados', 'errors'],
        data () {
            return {
                dados_funcionais: {
                    dado_funcional_id: '',
                    data_admissao: '',
                    pis_pasep: '',
                    portaria: ''
                }
            }
        },
        methods: {
            checkEdit: function() {
                var dados_funcionais = null;

                if(this.dados) {
                    var dados = JSON.parse(this.dados);
                    dados = dados.has_dados_funcionais;

                    this.dados_funcionais.dado_funcional_id   =   dados.dado_funcional_id;
                    this.dados_funcionais.data_admissao       =   dados.data_admissao;
                    this.dados_funcionais.pis_pasep           =   dados.pis_pasep;
                    this.dados_funcionais.portaria            =   dados.portaria;
                }
            }
        },
        mounted() {
            this.checkEdit();
        }
    };
</script>