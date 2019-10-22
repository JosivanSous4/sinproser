<template>
    <div id="PaginaCnpj">
        <div class="m-content">
            <h6>REPÚBLICA FEDERATIVA DO BRASIL</h6>
            <h5>CADASTRO NACIONAL DA PESSOA JURÍDICA</h5>

            <form class="text-left" v-if="sindicato">
                <div class="row">
                    <div class="form-group col-md-12">
                        <label><small>NOME EMPRESARIAL</small></label>
                        <input disabled type="text" class="form-control" v-model="sindicato.nome">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label><small>NÚMERO DE INSCRIÇÃO</small></label>
                        <input disabled type="text" class="form-control" v-model="sindicato.cnpj">
                    </div>
                    <div class="form-group col-md-6">
                        <label><small>TIPO</small></label>
                        <input disabled type="text" class="form-control" v-model="sindicato.tipo">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label><small>DATA DE ABERTURA</small></label>
                        <input disabled type="text" class="form-control" v-model="sindicato.abertura">
                    </div>
                    <div class="form-group col-md-4">
                        <label><small>SITUAÇÃO CADASTRAL</small></label>
                        <input disabled type="text" class="form-control" v-model="sindicato.situacao">
                    </div>
                    <div class="form-group col-md-4">
                        <label><small>PORTE</small></label>
                        <input disabled type="text" class="form-control" v-model="sindicato.porte">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label><small>CÓDIGO E DESCRIÇÃO DA NATUREZA JURÍDICA</small></label>
                        <input disabled type="text" class="form-control" v-model="sindicato.natureza_juridica">
                    </div>
                    <div class="form-group col-md-6">
                        <label><small>CÓDIGO E DESCRIÇÃO DA ATIVIDADE ECONÔMICA PRINCIPAL </small></label>
                        <input disabled type="text" class="form-control" v-model="sindicato.atividade_principal[0].code + ' - '+ sindicato.atividade_principal[0].text">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-5">
                        <label><small>LOGRADOURO</small></label>
                        <input disabled type="text" class="form-control" v-model="sindicato.logradouro">
                    </div>
                    <div class="form-group col-md-2">
                        <label><small>NÚMERO</small></label>
                        <input disabled type="text" class="form-control" v-model="sindicato.numero">
                    </div>
                    <div class="form-group col-md-5">
                        <label><small>BAIRRO/DISTRITO</small></label>
                        <input disabled type="text" class="form-control" v-model="sindicato.bairro">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-5">
                        <label><small>MUNICÍPIO</small></label>
                        <input disabled type="text" class="form-control" v-model="sindicato.municipio">
                    </div>
                    <div class="form-group col-md-2">
                        <label><small>UF</small></label>
                        <input disabled type="text" class="form-control" v-model="sindicato.uf">
                    </div>
                    <div class="form-group col-md-5">
                        <label><small>CEP</small></label>
                        <input disabled type="text" class="form-control" v-model="sindicato.cep">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label><small>ENDEREÇO ELETRÔNICO </small></label>
                        <input disabled type="text" class="form-control" v-model="sindicato.email">
                    </div>
                    <div class="form-group col-md-6">
                        <label><small>TELEFONE </small></label>
                        <input disabled type="text" class="form-control" v-model="sindicato.telefone">
                    </div>
                </div>
            </form>

            <template v-else>
                <br>
                <br>
                <br>
                <br>
                <br>
                <h4 style="color: blue">Obtendo Dados de Registro...</h4>
            </template>
        </div>                
    </div>
</template>

<script>
    export default {
        name: 'PaginaCnpj',
        data() {
            return {
                sindicato : null
            }
        },
        methods : {
            getSituacaoCnpj: function() {
                self = this;

                var url = "https://www.receitaws.com.br/v1/cnpj/07799644000130";
                
                self.$http.get(url).then((response) => {
                    self.sindicato = response.body;
                }, response => {
                    self.sindicato = JSON.parse('{"atividade_principal": [{"text": "Atividades de organizações sindicais","code": "94.20-1-00"}],"data_situacao": "26/08/2005","nome": "SINDICATO DOS PROFESSORES E SERVIDORES MUNICIPAIS DE SAO JOAO DO CARU - MA","uf": "MA","email": "raimundinha1@hotmail.com","telefone": "(98) 3653-1958","text": "raimundinha1@hotmail.com","situacao": "ATIVA","bairro": "SONRIZAL","logradouro": "R 1º DE DEZEMBRO","numero": "SN","cep": "65.385-000","municipio": "SAO JOAO DO CARU","abertura": "26/08/2005","natureza_juridica": "313-1 - Entidade Sindical","porte": "DEMAIS","cnpj": "07.799.644/0001-30","ultima_atualizacao": "2018-12-13T13:39:34.980Z","status": "OK","tipo": "MATRIZ","fantasia": "","complemento": "","efr": "","motivo_situacao": "","situacao_especial": "","data_situacao_especial": "","atividades_secundarias": [{"code": "00.00-0-00","text": "Não informada"}],"capital_social": "0.00","qsa": [],"extra": {}, "billing": {"free": true,"database": true}}');
                });
            }
        },
        created () {
            this.getSituacaoCnpj();
        },
    };
</script>

<style scoped>

</style>