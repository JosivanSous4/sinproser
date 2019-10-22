<template>
    <div id="lista-documentos">
        <div class="m-content">
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Lista de Notícias
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">
                                <a :href="urlBase + '/configuracoes/gerenciar-site/criar-noticia'" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
                                    <span>
                                        <i class="la la-plus"></i>
                                        <span>
                                            Nova Notícia
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
                                            Titulo
                                        </th>
                                        <th class="text-center">
                                            Resumo
                                        </th>
                                        <th class="text-center">
                                            Destaque
                                        </th>
                                        <th class="text-center">
                                            Criado em
                                        </th>
                                        <th class="text-center">
                                            Opções
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-if="qtdeNoticias == 0">
                                        <td colspan="6">
                                            <p class="text-center">
                                                Nenhum registro encontrado!
                                            </p>
                                        </td>
                                    </tr>
                                    <tr v-else v-for="(noticia, index) in listaNoticias">
                                        <td scope="row" class="text-center">
                                            {{ index +  1 }}
                                        </td>
                                        <td class="text-center">
                                            {{ noticia.titulo }}
                                        </td>
                                        <td class="text-center">
                                            {{ noticia.descricao_rapida }}
                                        </td>
                                        <td class="text-center">
                                            {{ noticia.destaque }}
                                        </td>
                                        <td class="text-center">
                                            {{ noticia.dt_criacao }}
                                        </td>
                                        <td class="text-center align-middle">
                                            <a :href="urlBase+'/configuracoes/gerenciar-site/editar-noticia/' + noticia.noticia_id" class="btn btn-primary m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
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
                listaNoticias : [],
                qtdeNoticias : '',
            }
        },
        methods : {
            getNoticias: function(page) {
                this.show = true;
                var url = "/api-site/noticias";
                
                this.$http.get(this.urlBase + url).then((response) => {
                    this.show = false;

                    this.listaNoticias = response.body;
                    this.qtdeNoticias = this.listaNoticias.length;
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
            this.getNoticias();
        },
    };
</script>

<style scoped>

</style>