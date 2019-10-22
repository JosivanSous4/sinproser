<template>
    <div id="dadosPessoais">
        <div class="col-lg-6 form-group">
            <label>
                Nome <span class="required">*</span>
            </label>
            <input type="text" required maxlength="120" :disabled="bol_disabled" :class="'form-control m-input '+ (errors.nome ? 'is-invalid' : '')" v-model="dados_pessoais.nome" placeholder="Digite o nome completo">
            <div class="invalid-feedback">
                {{errors.nome}}
            </div>
        </div>
        <div class="col-lg-3 col-md-6 form-group">
            <label class="">
                Sexo <span class="required">*</span>
            </label>
            <select required :class="'form-control m-input m-input--square '+ (errors.sexo ? 'is-invalid' : '')" :disabled="bol_disabled" v-model="dados_pessoais.sexo" id="exampleSelect1">
                <option selected value="">
                    Selecione
                </option>
                <option value="Maculino">
                    Maculino
                </option>
                <option value="Feminino">
                    Feminino
                </option>
            </select>
            <div class="invalid-feedback">
                {{errors.sexo}}
            </div>
        </div>
        <div class="col-lg-3 col-md-6 form-group">
            <label>
                Estado Civil <span class="required">*</span>
            </label>
            <select required :disabled="bol_disabled" :class="'form-control m-input m-input--square '+ (errors.estado_civil ? 'is-invalid' : '')" v-model="dados_pessoais.estado_civil" id="exampleSelect1">
                <option selected value="">
                    Selecione
                </option>
                <option value="Solteiro(a)">
                    Solteiro(a)
                </option>
                <option value="Casado(a)">
                    Casado(a)
                </option>
                <option value="Divorciado(a)">
                    Divorciado(a)
                </option>
            </select>
            <div class="invalid-feedback">
                {{errors.estado_civil}}
            </div>
        </div>
        <div class="col-lg-6 col-md-6 form-group">
            <label class="">
                CPF <span class="required">*</span>
            </label>
            <input type="text" :disabled="bol_disabled" required v-input-mask data-inputmask="'mask': '999.999.999-99'" v-model="dados_pessoais.cpf" :class="'form-control m-input '+ (errors.cpf ? 'is-invalid' : '')" placeholder="CPF">
            <div class="invalid-feedback">
                {{errors.cpf}}
            </div>
        </div>
        <div class="col-lg-6 col-md-6 form-group">
            <label class="">
                Data de Nascimento <span class="required">*</span>
            </label>
            <input type="date" :disabled="bol_disabled" required v-model="dados_pessoais.data_nascimento" :class="'form-control m-input '+ (errors.data_nascimento ? 'is-invalid' : '')" placeholder="Enter contact number">
            <div class="invalid-feedback">
                {{errors.data_nascimento}}
            </div>
        </div>
        <div class="col-lg-4 col-md-4 form-group">
            <label class="">
                RG <span class="required">*</span>
            </label>
            <input type="text" :disabled="bol_disabled" required v-model="dados_pessoais.rg" maxlength="15" :class="'form-control m-input '+ (errors.rg ? 'is-invalid' : '')" placeholder="RG">
            <div class="invalid-feedback">
                {{errors.rg}}
            </div>
        </div>
        <div class="col-lg-4 col-md-4 form-group">
            <label class="">
                Data de Emissao <span class="required">*</span>
            </label>
            <input type="date" :disabled="bol_disabled" required v-model="dados_pessoais.data_emissao_rg" :class="'form-control m-input '+ (errors.data_emissao_rg ? 'is-invalid' : '')" placeholder="Enter contact number">
            <div class="invalid-feedback">
                {{errors.data_emissao_rg}}
            </div>
        </div>
        <div class="col-lg-4 col-md-4 form-group">
            <label class="">
                Órgão emissor <span class="required">*</span>
            </label>
            <input type="text" :disabled="bol_disabled" required v-model="dados_pessoais.orgao_emissor_rg"  maxlength="5" :class="'form-control m-input '+ (errors.data_emissao_rg ? 'is-invalid' : '')" placeholder="Órgão emissor">
            <div class="invalid-feedback">
                {{errors.orgao_emissor_rg}}
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            dados:{
                default: null
            }, 
            errors: {
                default: {}
            }, 
            bol_disabled: {
                type: Boolean,
                default: false
            }
        },
        name: 'dados_pessoais',
        data () {
            return {
            	dados_pessoais: {
                    dados_pessoais_id: '',
	                nome: '',
	                sexo: '',
	                estado_civil: '',
	                cpf: '',
	                data_nascimento: '',
	                rg: '',
	                data_emissao_rg: '',
	                orgao_emissor_rg: '',
                    ssp_rg          : '',
            	}
            }
        },
        methods: {
            checkEdit: function() {
                var dados_pessoais = null;

                if(this.dados) {
                    dados_pessoais = JSON.parse(this.dados).has_dados_pessoais;

                    this.dados_pessoais.dados_pessoais_id   =   dados_pessoais.dados_pessoais_id;
                    this.dados_pessoais.nome                =   dados_pessoais.nome;
                    this.dados_pessoais.sexo                =   dados_pessoais.sexo;
                    this.dados_pessoais.estado_civil        =   dados_pessoais.estado_civil;
                    this.dados_pessoais.cpf                 =   dados_pessoais.cpf;
                    this.dados_pessoais.data_emissao_rg     =   dados_pessoais.data_emissao_rg;
                    this.dados_pessoais.rg                  =   dados_pessoais.rg;
                    this.dados_pessoais.data_nascimento     =   dados_pessoais.data_nascimento;
                    this.dados_pessoais.orgao_emissor_rg              =   dados_pessoais.orgao_emissor_rg;
                }
            }
        },
        mounted() {
            this.checkEdit();
        }
    };
</script>
