<template>
    <div id="FormTipoEntrada">
        <div class="m-content">
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Tipos de entrada
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">
                                <a :href="urlBase+'/configuracoes/cadastro/tipos-de-entrada/form-tipo-entrada'" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
                                    <span>
                                        <i class="la la-plus"></i>
                                        <span>
                                            Novo tipo de entrada
                                        </span>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <table class="table table-striped- table-bordered table-hover table-checkable">
                        <thead>
                            <tr>
                                <th>
                                    Cod
                                </th>
                                <th>
                                    Nome
                                </th>
                                <th>
                                    Descrição
                                </th>
                                <th class="text-center">
                                    Ação
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="tipo in tipos_entrada">
                                <td class="align-middle">
                                    {{tipo.tipo_entrada_id}}
                                </td>
                                <td class="align-middle">
                                    {{tipo.nome}}
                                </td>
                                <td class="align-middle">
                                    {{tipo.descricao}}
                                </td>
                                <td nowrap="" style="" class="text-center align-middle">
                                    <a :href="urlBase+'/configuracoes/cadastro/tipos-de-entrada/form-tipo-entrada/'+tipo.tipo_entrada_id" class="btn btn-primary m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
                                        <i class="la la-edit"></i>
                                    </a>
                                    <a href="#" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
                                        <i class="la la-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>                
    </div>
</template>

<script>
    export default {
        name: 'ListaTipoEntrada',
        data() {
            return {
                tipos_entrada : [],
                urlBase       : urlBase,
            }
        },
        methods : {
            getTiposEntrada: function() {
                self = this;

                let url = urlBase+"/api/tipos-entrada";
                
                self.$http.get(url, self.tipo_entrada).then((response) => {
                    self.tipos_entrada = response.body;
                }, response => {
                    return self.$swal({
                        type: self.response.status,
                        title: self.response.msg,
                    });
                });
            }
        },
        created () {
            this.getTiposEntrada();
        },
    };
</script>

<style scoped>

</style>