<template>
    <div id="lista-carteirinhas">
        <div class="m-content">
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Lista de Carteirinhas
                            </h3>
                        </div>
                    </div>
                </div>

                <div class="m-portlet__body">
                    <div class="m-section">
                        <form :action="urlBase + '/associados/carteirinhas'" method="GET">
                            <div class="row col-md-12">
                                <div class="form-group row col-md-8">
                                    <label>Ações</label>
                                    <select class="form-control m-input m-input--square" name="acao" v-model="acao_selecionada">
                                        <option v-if="relatorio_associados.qtd_associados_com_carteirinha > 0" value="lapc" selected title="Exibe apenas os associados que possuem carteirinha. Obs.: não emite carteirinha">Listar associados que possuem carteirinha</option>
                                        <option v-if="relatorio_associados.qtd_associados_sem_carteirinha > 0" value="lanpc" title="Exibe apenas os associados que não possuem carteirinha. Obs.: não emite carteirinha">Listar associados que não possuem carteirinha</option>
                                        <option v-if="relatorio_associados.qtd_carteirinhas_nao_impressas > 0" value="ltcni" title="Listar todas as carteirinhas que ainda não foram impressas">Listar carteirinhas não impressas</option>
                                        <option v-if="relatorio_associados.qtd_carteirinhas_impressas > 0" value="ltci" title="Listar todas as carteirinhas que foram impressas">Listar carteirinhas impressas</option>
                                        <option v-if="relatorio_associados.qtd_associados_com_carteirinha > 0" value="extce" title="Exibe todas as carteirinhas emitidas até o momento. Obs.: não emite carteirinha">Exibir carteirinhas já emitidas</option>
                                        <option v-if="relatorio_associados.qtd_carteirinhas_nao_impressas > 0" value="extcni" title="Exibe todas as carteirinhas que ainda não foram impressas">Exibir carteirinhas não impressas</option>
                                        <option v-if="relatorio_associados.qtd_carteirinhas_impressas > 0" value="extci" title="Exibe todas as carteirinhas que foram impressas">Exibir carteirinhas impressas</option>
                                        <option v-if="relatorio_associados.qtd_associados_sem_carteirinha > 0" value="emcanp" title="Emite a carteirinha para associados que ainda não possuem uma">Emitir carteirinha para associados que não possuem</option>
                                        <option v-if="relatorio_associados.qtd_associados_com_carteirinha > 0" value="emsvtce" title="Atualiza a data de emissão APENAS das carteirinhas já emitidas, tornando-as segunda via">Emitir segunda via de carteirinhas já emitidas</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-success" style="margin-top: 25px">Executar ação</button>
                                </div>
                            </div>
                        </form>
                        <div class="m-section__content">
                            <table class="table table-bordered table-hover siga-data-table">
                                <thead>
                                    <tr>
                                        <th>
                                            #
                                        </th>
                                        <th>
                                             Associado
                                        </th>
                                        <th>
                                             Data da Associação
                                        </th>
                                        <th>
                                            Carteirinha impressa?
                                        </th>
                                        <th>
                                            Mais opções
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-if="listaAssociados.length < 1">
                                        <td colspan="8">
                                            <p class="text-center">
                                                Nenhum registro encontrado!
                                            </p>
                                        </td>
                                    </tr>
                                    <tr v-else v-for="(associado, index) in listaAssociados">
                                        <td scope="row">
                                            {{ associado.associado_id }}
                                        </td>
                                        <td>
                                            {{ associado.nome }}
                                        </td>
                                        <td>
                                            {{ associado.data_associacao|date }}
                                        </td>
                                        <td>
                                            <template v-if="associado.carteinha_id">
                                                <div class="custom-control custom-checkbox mb-3">
                                                    <div class="checkbox checkbox-slider--b-flat checkbox-slider-md" >
                                                        <label>
                                                            <input type="checkbox" :checked="associado.bol_carteinha_impressa" @click="marcarDesmarcarComoImpresso(associado.carteinha_id)"><span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </template>
                                        </td>
                                        <td class="text-center">
                                            <template v-if="associado.carteinha_id"> 
                                                <a :href="this.urlBase + '/associados/carteirinha/' + associado.associado_id" class="m-nav__link" title="Ver carteirinha">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </template>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['dados', 'acao', 'relatorio'],
        name: 'lista-carteirinhas',
        data() {
            return {
                show : false,
                urlBase : urlBase,
                listaAssociados : this.dados.length ? JSON.parse(this.dados) : [],
                acao_selecionada: this.acao.length ? this.acao : 'lapc',
                relatorio_associados: JSON.parse(this.relatorio)
            }
        },
        methods : {
            marcarDesmarcarComoImpresso : function(carteirinha_id) {        
                this.$http.get(this.urlBase+'/associados/carteirinha/marcar-como-impresso/' + carteirinha_id).then(response => {
                    console.log(response.data);
                });
            },
        },
        mounted () {
        },
    };
</script>

<style scoped>

</style>
