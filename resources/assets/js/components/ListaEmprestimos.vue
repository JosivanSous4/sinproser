<template>
    <div id="ListaEmprestimos">
        <div class="m-content">
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Lista de Empréstimos
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">
                                <a :href="urlBase + '/bens/cadastro-de-bens'" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air"  data-toggle="modal" data-target="#exampleModal">
                                    <span>
                                        <i class="la la-plus"></i>
                                        <span>
                                            Novo Empréstimo
                                        </span>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="m-portlet__body">
                    <div class="m-section">
                        <div class="m-section__content">
                            <table class="table table-bordered table-hover siga-data-table">
                                <thead>
                                    <tr>
                                        <th>
                                            #
                                        </th>
                                        <th>
                                            Produto
                                        </th>
                                        <th>
                                            Qtd. devolvida
                                        </th>
                                        <th>
                                            Data do empréstimo
                                        </th>
                                        <th>
                                            Responsável
                                        </th>
                                        <th>
                                            Data prevista para devolução
                                        </th>
                                        <th>
                                            Data da devolução
                                        </th>
                                        <th>
                                            Opções
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-if="listaEmprestimos.length < 1">
                                        <td colspan="8">
                                            <p class="text-center">
                                                Nenhum registro encontrado!
                                            </p>
                                        </td>
                                    </tr>
                                    <tr v-else v-for="(emprestimo, index) in listaEmprestimos">
                                        <td scope="row">
                                            {{ index +  1 }}
                                        </td>
                                        <td width="50px">
                                            {{ emprestimo.produto.nome }}
                                        </td>
                                        <td>
                                            {{ emprestimo.qtdBensDevolvidos }} / {{ emprestimo.qtdBens }}
                                        </td>
                                        <td>
                                            {{ emprestimo.dataEmprestimo }}
                                        </td>
                                        <td>
                                            {{ emprestimo.responsavel.nome_responsavel }}
                                        </td>
                                        <td>
                                            {{ emprestimo.data_prevista_devolucao }}
                                        </td>
                                        <td>
                                            {{ emprestimo.dataDevolucao }}
                                        </td>
                                        <td class="text-center">
                                            <a v-if="!emprestimo.bol_devolvido" v-tooltip="'Devolver produto'" :href="this.urlBase + '/bens/devolucao/' + emprestimo.emprestimo_bem_id" data-toggle="tooltip" data-placement="top" class="btn btn-sm btn-primary m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
                                                <i class=" flaticon-refresh"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Selecione um item para prosseguir</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-lg-12 form-group">
                            <label>
                                Selecione o ítem que deseja emprestar
                            </label>
                            <select id="associado_id" class="form-control m-input m-input--square" v-model="item_selecionado" name="associado_id">
                                <option value="">Selecione o responsavel</option>
                                <option v-for="produto in listaProdutos" :value="produto.produto_id">
                                    {{ produto.nome }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <template v-if="item_selecionado == 0">
                            <button type="button" disabled class="btn btn-primary">Prosseguir</button>
                        </template>
                        <template v-else>
                            <button type="button" @click="redirecionarParaEmprestimo()" class="btn btn-primary">Prosseguir</button>
                        </template>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'ListaEmprestimos',
        data() {
            return {
                show : false,
                urlBase : urlBase,
                listaEmprestimos : [],
                qtdeBens : '',
                listaProdutos: [],
                item_selecionado: 0
            }
        },
        methods : {
            getEmprestimos: function(page) {
                this.show = true;
                var url = "/api/emprestimos";

                this.$http.get(urlBase + url).then((response) => {
                    this.show = false;

                    this.listaEmprestimos = response.body;

                    console.log(this.listaEmprestimos);
                }, response => {
                    this.show = false;

                    return Swal({
                        type: this.response.status,
                        title: this.response.msg,
                    });
                });
            },
            getProdutos: function(page) {
                this.show = true;
                var url = "/bens/api-lista/";

                this.$http.get(urlBase + url).then((response) => {
                    this.show = false;

                    this.listaProdutos = response.body;
                    console.log(this.listaProdutos);
                }, response => {
                    this.show = false;

                    return Swal({
                        type: this.response.status,
                        title: this.response.msg,
                    });
                });
            },
            redirecionarParaEmprestimo: function(){
                window.location.href = urlBase + '/bens/emprestar-bem/'+ this.item_selecionado;
            },
            excluirProduto: function(produto_id) {

                var dados = { produto_id: produto_id };
                let url = urlBase + "/configuracoes/cadastro/tipos-de-pagamento/excluir-tipo-pagamento";

                Swal({
                    title: 'Realmente deseja excluir este bem?',
                    type: 'question',
                    showCancelButton: true,
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                        return this.$http.post(url, dados).then((response) => {
                            this.retorno = response.body;
                        }, response => {
                            this.retorno = response.body;
                        });
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    this.getEmprestimos();
                    return Swal({
                        type: this.retorno.status,
                        title: this.retorno.msg,
                    });
                }).catch(Swal.noop)
            }

        },
        mounted () {
            this.getEmprestimos();
            this.getProdutos();
        },
    };
</script>

<style scoped>

</style>
