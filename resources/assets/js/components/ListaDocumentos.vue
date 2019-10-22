<template>
    <div id="lista-documentos">
        <div class="m-content">
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Lista de Documentos
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">
                                <a :href="urlBase + '/documentos/criar-documento'" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
                                    <span>
                                        <i class="la la-plus"></i>
                                        <span>
                                            Novo Documento
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
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            #
                                        </th>
                                        <th class="text-center">
                                            Documento
                                        </th>
                                        <th class="text-center">
                                            Data Alteração
                                        </th>
                                        <th class="text-center">
                                            Opções
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-if="qtdeDocumentos == 0">
                                        <td colspan="4">
                                            <p class="text-center">
                                                Nenhum registro encontrado!
                                            </p>
                                        </td>
                                    </tr>
                                    <tr v-else v-for="(documento, index) in listaDocumentos">
                                        <td scope="row" class="text-center">
                                            {{ index +  1 }}
                                        </td>
                                        <td class="text-center">
                                            {{ documento.nome }}
                                        </td>
                                        <td class="text-center">
                                            {{ documento.updated_at | date }}
                                        </td>
                                        <td class="text-center align-middle">
                                            <a :href="urlBase+'/documentos/editar-documento/' + documento.documento_id" class="btn btn-primary m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
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
        </div>
    </div>
</template>

<script>
    export default {
        name: 'lista-documentos',
        data() {
            return {
                show : false,
                urlBase : urlBase,
                listaDocumentos : [],
                qtdeDocumentos : '',
            }
        },
        methods : {
            getDocumentos: function(page) {
                this.show = true;
                var url = "/documentos/api-lista/";
                
                this.$http.get(this.urlBase + url).then((response) => {
                    this.show = false;

                    this.listaDocumentos = response.body;
                    this.qtdeDocumentos = this.listaDocumentos.length;
                }, response => {
                    this.show = false;

                    return Swal({
                        type: this.response.status,
                        title: this.response.msg,
                    });
                });
            }
        },
        mounted () {
            this.getDocumentos();
        },
    };
</script>

<style scoped>

</style>