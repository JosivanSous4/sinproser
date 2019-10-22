<template>
    <div id="ListaUsuario">
        <div class="m-content">
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Lista de usuarios
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <!-- <li class="m-portlet__nav-item">
                                <button type="button" @click="showFilter = !showFilter" class="m-portlet__nav-link btn btn-primary m-btn m-btn--pill m-btn--air">
                                    <span>
                                        <i class="la la-filter"></i>
                                        <span class="mobile-hide">
                                            Pesquisar
                                        </span>
                                    </span>
                                </button>
                            </li> -->

                            <li class="m-portlet__nav-item">
                                <a :href="urlBase+'/usuarios/form-usuario'" class="m-portlet__nav-link btn btn-accent m-btn m-btn--pill m-btn--air">
                                    <span>
                                        <i class="la la-plus"></i>
                                        <span class="mobile-hide">
                                            Novo usuario
                                        </span>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="table-responsive m_datatable" id="local_data">
                        <table class="table table-bordered table-striped table-hover siga-data-table">
                            <thead>
                                <tr>
                                    <th>
                                        Cod
                                    </th>
                                    <th>
                                        Nome
                                    </th>
                                    <th>
                                        Usuário
                                    </th>
                                    <th>
                                        Perfil
                                    </th>
                                    <th class="text-center">
                                        Ação
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="usuario in usuarios">
                                    <td class="align-middle">
                                        {{usuario.user_id}}
                                    </td>
                                    <td class="align-middle">
                                        {{usuario.has_dados_pessoais.nome}}
                                    </td>
                                    <td class="align-middle">
                                        {{usuario.name}}
                                    </td>
                                    <td class="align-middle">
                                        {{usuario.has_perfil.nome}}
                                    </td>
                                    <td nowrap="" style="" class="text-center align-middle">
                                        <a :href="urlBase+'/usuarios/form-usuario/'+usuario.user_id" v-tooltip="'Editar dados de '+usuario.has_dados_pessoais.nome" class="btn btn-primary m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill btn-sm">
                                            <i class="flaticon-edit"></i>
                                        </a>
                                        <a :href="'#'" @click="modalResetSenha(usuario)" v-tooltip="'Resetar senha de '+usuario.has_dados_pessoais.nome" data-toggle="modal" data-target="#modalResetSenha" class="btn btn-default m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill btn-sm">
                                            <i class="flaticon-refresh"></i>
                                        </a>
                                        <a :href="'#'" @click="desativarUser(usuario)" v-tooltip="'Desativar usuário '+usuario.has_dados_pessoais.nome" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill btn-sm">
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

        <div class="modal fade" id="modalResetSenha" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Resetar senha de {{resetSenhaUser.nome}}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="m-form__section m-form__section--first">
                            <div class="form-group m-form__group">
                                <label for="example_input_full_name">
                                    Digite a nova senha:
                                </label>
                                <input type="password" v-model="resetSenhaUser.password" class="form-control m-input">
                            </div>
                            <div class="form-group m-form__group">
                                <label>
                                    Repita a nova senha:
                                </label>
                                <input type="password" v-model="resetSenhaUser.password_confirmation" class="form-control m-input">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" @click="limpaResetSenha()" class="btn btn-secondary" data-dismiss="modal">
                            Fechar
                        </button>
                        <button type="button" @click="resetarSenha()" class="btn btn-primary">
                            Salvar senha
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props : ['dados'],
        name: 'ListaUsuario',
        data() {
            return {
                usuarios : [],
                urlBase       : urlBase,
                showFilter : false,
                tipos_saida : [],
                resetSenhaUser : {
                    user_id        : '',
                    nome           : '',
                    password       : '',
                    password_confirmation : '',
                },
                pesquisar : {
                    tipo_saida_id : '',
                    beneficiario  : '',
                    status_id     : '',
                    dtainicial    : '',
                    dtafinal      : '',
                },
            }
        },
        methods : {
            desativarUser : function(user){
                self = this;
                let url = urlBase+"/usuarios/desativar-usuario";
                // self.salvarDados('Desativar usuário '+user.has_dados_pessoais.nome+' ?', url, user);

                Swal({
                    title: 'Desativar usuário '+user.has_dados_pessoais.nome+' ?',
                    type: 'question',
                    inputAttributes: {
                        autocapitalize: 'off'
                    },
                    showCancelButton: true,
                    confirmButtonText: 'Sim',
                    showLoaderOnConfirm: true,
                    preConfirm: (login) => {
                        return self.$http.post(url, user).then((response) => {
                            self.retorno = response.body;
                            self.formRequest = {};
                            self.getUsuarios();
                        }, response => {
                            var form = response.body;
                            self.formRequest = form;
                            self.retorno = 0;
                        });
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    if (self.retorno == 0) {

                        var msg = self.formErros(self.formRequest);

                        return Swal({
                            type: 'error',
                            title: 'Oops...',
                            text: 'Há campos em brancos!',
                        });
                    }

                    if (self.retorno) {
                        return Swal({
                            type: self.retorno.status,
                            title: self.retorno.msg,
                        });
                    }
                })

            },
            resetarSenha : function(){
                self = this;
                let url = "/usuarios/resetar-usuario";

                self.salvarDados('Salvar nova senha?', url, self.resetSenhaUser);
            },
            limpaResetSenha : function(){
                this.resetSenhaUser.user_id         = '';
                this.resetSenhaUser.nome            = '';
                this.resetSenhaUser.password        = '';
                this.resetSenhaUser.password_confirmation  = '';
            },
            modalResetSenha : function(resetSenhaUser) {
                // console.log(resetSenhaUser);
                this.resetSenhaUser.nome = resetSenhaUser.has_dados_pessoais.nome;
                this.resetSenhaUser.user_id = resetSenhaUser.user_id;
            },
            pesquisarEntrada : function(){
                let self = this;
                let url = urlBase+"/financeiro/saida/buscar-saida";

                this.$http.get(url, {params: self.pesquisar}).then(response => {
                    self.saidas = response.body;
                }, response => {
                    return Swal({
                        type: response.body.status,
                        title: response.body.msg,
                    });
                });
            },
            getUsuarios: function() {
                self = this;

                let url = urlBase+"/api/lista-usuarios";

                self.$http.get(url).then((response) => {
                    self.usuarios = response.body;
                }, response => {
                    return self.$swal({
                        type: self.response.status,
                        title: self.response.msg,
                    });
                });
            },
            getTiposSaida: function() {
                self = this;

                let url = urlBase+"/api/tipos-saida";

                self.$http.get(url).then((response) => {
                    self.tipos_saida = response.body;
                }, response => {
                    return self.$swal({
                        type: self.response.status,
                        title: self.response.msg,
                    });
                });
            },
            getStatusFinanceiro : function(){
                self = this;

                let url = urlBase+"/financeiro/entrada/get-status";

                self.$http.get(url).then((response) => {
                    self.status = response.body;
                }, response => {
                    return self.$swal({
                        type: self.response.status,
                        title: self.response.msg,
                    });
                });
            },
            checkEdit : function() {
                var dados = null;

                if (this.dados) {
                    dados = JSON.parse(this.dados);
                    this.usuarios = dados;
                }
            },

        },
        created () {
            this.checkEdit();
            this.getTiposSaida();
            this.getStatusFinanceiro();
        },
    };
</script>

<style scoped>
    .m-form{
        background: #fbf5f5;
    }
    .fade-enter-active, .fade-leave-active {
      transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active em versões anteriores a 2.1.8 */ {
      opacity: 0;
    }
</style>
