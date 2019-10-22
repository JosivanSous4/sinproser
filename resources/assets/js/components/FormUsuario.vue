<template>
    <div id="FormUsuario">
        <div class="m-content">
            <div class="row">
                <div class="col-lg-12">
                <div class="m-portlet">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon m--hide">
                                    <i class="la la-gear"></i>
                                </span>
                                <h3 class="m-portlet__head-text">
                                    {{titulo}}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <form v-on:submit.prevent="salvar" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                        <div class="m-portlet__body">
                            
                            <div class="m-form__group form-group">
                                <div class="row col-lg-6">
                                    <label>
                                        Usuário associado?
                                    </label>
                                    <select v-model="usuario.associado_id" @change="getDadosAssociado(usuario.associado_id)" id="associado_id" name="associado_id" :class="'form-control m-input m-input--square ' + (form_errors.associado_id ? 'is-invalid' : '')">
                                        <option value="">Selecione um associado</option>
                                        <option v-for="associado in associados" :value="associado.associado_id">
                                            {{ associado.nome }}
                                        </option>
                                    </select>
                                    <div class="invalid-feedback">
                                        {{ form_errors.associado_id }}
                                    </div>
                                    <div v-if="usuario.associado_id">
                                        <p>
                                            Caso queira atualizar dados do associado, clique
                                            <a :href="urlLocal+'/associados/editar-associado/'+usuario.associado_id" target="_blank">aqui</a>.
                                        </p>
                                    </div>
                                </div>
                                <br>
                                <div class="row col-lg-6">
                                    <b>Obs.: Caso o futuro usuário não seja associado, ignore a seleção e preencha os dados pessoais manualmente</b>
                                </div>
                            </div>
                            <dados-pessoais  ref="dados_pessoais" :bol_disabled="usuario.associado_id? true : false" :dados="usuario.dados_pessoais" :errors="form_errors" class="row m-form__group"></dados-pessoais>
                            <contatos ref="contatos" :dados="usuario.contatos" :errors="form_errors" :disabled="usuario.associado_id? true : false" class="row m-form__group"></contatos>

                            <div class="m-form__group form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="email">
                                            E-mail (Usado para login)
                                        </label>
                                        <input type="text" required name="email" @keyup="verificaUsuario()" :class="'form-control m-input '+ (form_errors.email ? 'is-invalid' : '')" v-model="usuario.email" placeholder="Digite o e-mail">
                                        <div class="has-danger" v-if="bolusuarioexiste == 1">
                                            <div class="form-control-feedback">
                                                Já existe um usuário cadastro com esse e-mail, por favor, insira outro e-mail.
                                            </div>
                                        </div>
                                        <div class="invalid-feedback" v-if="bolusuarioexiste == 0">
                                            {{form_errors.email}}
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="usuario.perfil_id">
                                            Perfil
                                        </label>
                                        <select required :class="'form-control m-input text-uppercase '+ (form_errors.perfil_id ? 'is-invalid' : '')" name="usuario.perfil_id" v-model="usuario.perfil_id">
                                            <option v-for="perfil in perfis" :value="perfil.perfil_id">
                                                {{perfil.nome}}
                                            </option>
                                        </select>
                                        <div class="invalid-feedback">
                                            {{form_errors.perfil_id}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="m-form__group form-group" v-if="!usuario.user_id">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label>
                                            Senha:
                                        </label>
                                        <input required type="password" :class="'form-control m-input '+ (form_errors.password ? 'is-invalid' : '')" v-model="usuario.password" placeholder="Digite a senha">
                                        <div class="invalid-feedback">
                                            {{form_errors.password}}
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <label>
                                            Repita a senha:
                                        </label>
                                        <input required type="password" :class="'form-control m-input '+ (form_errors.password_confirmation ? 'is-invalid' : '')" v-model="usuario.password_confirmation" placeholder="Digite a senha novamente">
                                        <div class="invalid-feedback">
                                            {{form_errors.password_confirmation}}
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                            <div class="m-form__actions m-form__actions--solid">
                                <div class="row">
                                    <div class="col-lg-12 m--align-right">
                                        <button type="submit" class="btn btn-primary">
                                            Salvar
                                        </button>
                                        <button type="reset" class="btn btn-secondary">
                                            Cancelar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
    </div>
</template>

<script>
    import DadosPessoais from './inputs/DadosPessoais.vue'

    import Contatos from './inputs/Contatos.vue'
    export default {
        name: 'FormUsuario',
        props: ['usuario_dados'],
        components: { DadosPessoais , Contatos },
        data() {
            return {
                titulo: 'Salvar usuário',
                urlLocal: urlBase,
                tipos_saida : [],
                retorno : '',
                formRequest : '',
                perfis : [],
                usuario: {
                    user_id : '',
                    email : '',
                    password : '',
                    password2: '',
                    dados_pessoais_id : '',
                    associado_id : '',
                    perfil_id : '',
                    dados_pessoais : '',
                    contatos : '',
                },
                bolusuarioexiste : 0,
                money: {
                    decimal: ',',
                    thousands: '.',
                    // prefix: 'R$ ',
                    // suffix: ' #',
                    precision: 2,
                    masked: false
                },
                associados: [],
                form_errors: {}
            }
        },
        methods : {
            salvar: function() {
                self = this;
                let url = "/usuarios/salvar-usuario";

                this.bolusuarioexiste = 0;
                this.form_errors = {};

                this.getDadosPessoais();
                this.getContatos();
                self.salvarDados(self.titulo + '?', url, self.usuario);

                // Swal({
                //     title: self.titulo + ' ?',
                //     type: 'question',
                //     showCancelButton: true,
                //     showLoaderOnConfirm: true,
                //     preConfirm: () => {
                //         return self.$http.post(url, self.usuario).then((response) => {
                //             self.retorno = response.body;
                //             self.formRequest = {};
                //         }, response => {
                //             var form = response.body;
                //             self.formRequest = form;
                //             self.retorno = 0;
                //         });
                //     },
                //     allowOutsideClick: () => !swal.isLoading()
                // }).then((result) => {
                //     if (self.retorno == 0) {
                //         var msg = self.formErros(self.formRequest);
                //
                //         return Swal({
                //             type: 'error',
                //             title: 'Oops...',
                //             text: 'Há campos em brancos!',
                //         });
                //     }
                //
                //     console.log(self.retorno);
                //
                //     if (self.retorno) {
                //         return Swal({
                //             type: self.retorno.status,
                //             title: self.retorno.msg,
                //         });
                //     }
                // })

            },
            getPerfil: function() {
                self = this;
                let url = urlBase+"/api/lista-perfil";
                self.$http.get(url).then((response) => {
                    self.perfis = response.body;
                }, response => {
                    return Swal({
                        type: self.response.status,
                        title: self.response.msg,
                    });
                });
            },
            verificaUsuario: function() {
                self = this;
                let url = urlBase+"/usuarios/verifica-usuario/"+self.usuario.email;
                self.$http.get(url).then((response) => {
                    self.bolusuarioexiste = response.body;
                }, response => {
                    return Swal({
                        type: self.response.status,
                        title: self.response.msg,
                    });
                });
            },
            getDadosPessoais: function() {
                var self = this;
                // self.usuario.dados_pessoais = JSON.stringify(self.$refs.dados_pessoais.dados_pessoais);
                self.usuario.dados_pessoais = self.$refs.dados_pessoais.dados_pessoais;
            },
            getContatos: function() {
                var self = this;

                if(self.$refs.contatos.contatos.length){
                    // self.usuario.contatos = JSON.stringify(self.$refs.contatos.contatos);
                    self.usuario.contatos = self.$refs.contatos.contatos;
                } else {
                    // document.getElementById('dados_contatos').value = '';
                }
            },

            trataDados : function(){
                self = this;
                if (self.usuario_dados.user_id) {
                    self.usuario.user_id = self.usuario_dados.user_id;
                    self.usuario.email = self.usuario_dados.email;
                    // self.usuario.password = self.usuario_dados.password;
                    self.usuario.dados_pessoais_id = self.usuario_dados.dados_pessoais_id;
                    self.usuario.associado_id = self.usuario_dados.associado_id;
                    self.usuario.perfil_id = self.usuario_dados.perfil_id;

                    self.usuario.perfil_id = self.usuario_dados.perfil_id;
                    self.usuario.dados_pessoais = JSON.stringify(self.usuario_dados);
                    self.usuario.contatos = JSON.stringify(self.usuario_dados);

                    this.titulo = "Atualizar usuário";
                }else{
                    this.titulo = "Cadastrar usuário";
                    self.usuario.password = '';
                }

                // console.log(self.usuario);
            },
            getDadosAssociado: function(id_associado){
                // console.log(id_associado);
                this.$http.get(urlBase+'/associados/get-associado/'+id_associado).then(response => {
                    var associado = response.data;
                    this.usuario.dados_pessoais = associado.has_dados_pessoais;
                    this.$refs.dados_pessoais.dados_pessoais = associado.has_dados_pessoais;
                    this.$refs.contatos.contatos = associado.has_contatos;
                });
            },
            getAssociados: function() {
                this.$http.get(urlBase+'/api/lista-de-associados').then(response => {
                    this.associados = response.data;
                });
            },
        },
        created () {
            this.getAssociados();
            this.trataDados();
            this.getPerfil();
        },
    };
</script>

<style scoped>

</style>
