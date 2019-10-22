<template>
    <div id="lista-bens">
        <div class="m-content">
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Lista de Bens
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">
                                <a :href="urlBase + '/bens/cadastro-de-bens'" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
                                    <span>
                                        <i class="la la-plus"></i>
                                        <span>
                                            Novo Bem
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
                                             N.º Patrimônio
                                        </th>
                                        <th>
                                            Nome
                                        </th>
                                        <th>
                                            Descrição
                                        </th>
                                        <th>
                                            Quantidade
                                        </th>
                                        <th>
                                            Valor Unitário
                                        </th>
                                        <th>
                                            Valor Total
                                        </th>
                                        <th>
                                            Opções
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-if="listaProdutos.length < 1">
                                        <td colspan="8">
                                            <p class="text-center">
                                                Nenhum registro encontrado!
                                            </p>
                                        </td>
                                    </tr>
                                    <tr v-else v-for="(produto, index) in listaProdutos">
                                        <td scope="row">
                                            {{ index +  1 }}
                                        </td>
                                        <td width="50px">
                                            {{ produto.produto_id }}
                                        </td>
                                        <td>
                                            {{ produto.nome }}
                                        </td>
                                        <td>
                                            {{ produto.descricao }}
                                        </td>
                                        <td>
                                            {{ produto.qtde_bem }}
                                        </td>
                                        <td>
                                            R$ {{ produto.valor_unitario|formaMoeda }}
                                        </td>
                                        <td>
                                            R$ {{ produto.valor_total|formaMoeda }}
                                        </td>
                                        <td class="text-center">
                                            <a :href="this.urlBase + '/bens/editar-bem/' + produto.produto_id" data-toggle="tooltip" data-placement="top" :title="'Editar dados de ' + produto.nome" class="btn btn-sm btn-primary m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
                                                <i class="la la-edit"></i>
                                            </a>

                                            <a v-if="produto.qtde_bens_disponiveis != 0"  :href="this.urlBase + '/bens/emprestar-bem/' + produto.produto_id" data-toggle="tooltip" data-placement="top" :title="'Emprestar ' + produto.nome" class="btn btn-sm btn-success m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
                                                <i class="fa fa-handshake-o"></i>
                                            </a>

                                            <button type="submit" @click="excluirProduto(produto.produto_id)" data-toggle="tooltip" data-placement="top" :title="'Excluir ' + produto.nome" class="btn btn-sm btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
                                                <i class="la la-trash"></i>
                                            </button>
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
        name: 'lista-bens',
        data() {
            return {
                show : false,
                urlBase : urlBase,
                listaProdutos : [],
                qtdeBens : '',
            }
        },
        methods : {
            getBens: function(page) {
                this.show = true;
                var url = "/bens/api-lista/";

                this.$http.get(urlBase + url).then((response) => {
                    this.show = false;

                    this.listaProdutos = response.body;
                }, response => {
                    this.show = false;

                    return Swal({
                        type: this.response.status,
                        title: this.response.msg,
                    });
                });
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
                    this.getBens();
                    return Swal({
                        type: this.retorno.status,
                        title: this.retorno.msg,
                    });
                }).catch(Swal.noop)
            }

        },
        mounted () {
            this.getBens();
        },
    };
</script>

<style scoped>

</style>
