<template>
    <div id="contatos" class="row">
        <div class="col-md-12">
            <div class="row box-contato" v-if="!disabled">
                <div class="col-md-5 form-group">
	                <label class="">
	                    Tipo de Contato <span class="required">* </span>
	                </label>
	                <select class="form-control m-input m-input--square" id="tipo_contato" v-model="contato.tipo" @change="atualizarEstiloContato()" name="tipo_contato">
                        <option value="" selected>Selecione</option>
	                	<option value="Telefone Fixo">Telefone Fixo</option>
	                	<option value="Celular">Celular</option>
	                	<option value="Email">Email</option>
	                	<option value="Facebook">Facebook</option>
	                	<option value="Instagram">Instagram</option>
	                </select>
	            </div>

                <div class="col-md-5">
                    <div class="form-group">
                        <label for="" class="control-label">Contato <span class="required">* </span></label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i :class="contato.icon"></i>
                            </span>
                            <template v-if="contato.tipo == 'Telefone Fixo' || contato.tipo == 'Celular'">
                                <input v-input-mask data-inputmask="'mask': ['(99) 9999-9999', '(99) 99999-9999']" class="form-control input-circle-right" v-model="contato.contato" name="contato" id="contato" :placeholder="contato.tipo"/>
                            </template>
                            <template v-else>
                                <input type="text" name="" maxlength="120" v-model="contato.contato" class="form-control input-circle-right" :placeholder="contato.tipo">
                            </template>
                        </div>
                    </div>
                </div>

                <div class="col-md-2 div-btn-add-contato text-right">
                    <button type="button"  title="Adicionar contato" class="btn" @click="addContato()"><i class="fa fa-plus"></i> Registrar</button>
                </div>
            </div>

    		<div>
		        <table class="table table-striped- table-bordered table-hover table-checkable">
		            <thead>
		                <tr>
		                    <th>
		                        Tipo de Contato
		                    </th>
		                    <th>
		                        Contato
		                    </th>
		                    <th class="text-center" v-if="!disabled">
		                        Ação
		                    </th>
		                </tr>
		            </thead>
		            <tbody>
                        <template v-if="contatos.length">
    		                <tr v-for="(contato, index) in contatos">
    		                    <td class="align-middle">
    		                        {{ contato.tipo }}
    		                    </td>
    		                    <td class="align-middle">
    		                        {{ contato.contato }}
    		                    </td>
    		                    <td class="text-center" v-if="!disabled">
    		                        <button type="button" title="Descartar este contato" @click="descartarContato(index)" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
    		                            <i class="la la-trash"></i>
    		                        </button>
    		                    </td>
    		                </tr>
                        </template>
                        <template v-else>
                            <tr>
                                <td colspan="4" class="text-center" v-if="errors">
                                    <p>
                                        Registre contatos
                                    </p>
                                </td>

                                <td colspan="4" class="text-center" v-else>
                                    <p>Registre contatos</p>
                                </td>
                            </tr>
                        </template>
		            </tbody>
		        </table>
                <template v-if="errors">
                    <div style="color: #f4516c" v-if="errors.contatos">
                        {{ errors.contatos }}
                    </div>
                </template>
	        </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['dados', 'errors', 'disabled'],
        data () {
            return {
                tipo_aux     : '',
                contatos: [],
            	contato: {
                    contato_id          : '',
                    tipo                : '',
                    contato             : '',
                    icon: 'glyphicon glyphicon-phone'
                },
                contatos_delete: []
            }
        },
        methods : {
            addContato: function() {

                if(this.contato.tipo && this.contato.contato){

                    this.contatos.push({
                        contato_id: this.contato.contato_id,
                        tipo: this.contato.tipo,
                        contato: this.contato.contato,
                    });

                    this.contato = {
                        contato_id : '',
                        tipo : '',
                        contato : '',
                        inpContatoEstilo : {
                            icon: 'glyphicon glyphicon-phone'
                        }
                    };
                }
            },
            atualizarEstiloContato: function(value, index){

                if(value){
                    if(value == 'Telefone Fixo' || value == 'Celular'){
                        if(value == 'Celular'){
                            this.contatos.icon = 'fa fa-tablet';
                        }else{
                            this.contatos.icon = 'glyphicon glyphicon-phone-alt';
                        }
                    }else if(value == 'Email'){
                        this.contatos.icon = 'fa fa-envelope-open';
                    }else if(value == 'Facebook'){
                        this.contatos.icon = 'fa fa-facebook';
                    }else if(value == 'Instagram'){
                        this.contatos.icon = 'fa fa-instagram';
                    }

                    this.contatos.tipo = value;
                }else{
                    this.contatos.icon = 'fa fa-question';
                    this.contatos.tipo = 'Contato';

                }
            },
            descartarContato: function(index){
                if(this.contatos[index].contato_id){
                    this.contatos_delete.push(this.contatos[index].contato_id);
                }

                this.contatos.splice(index, 1);
            },
            checkEdit: function(){
                var dados = null;

                if(this.dados){
                    dados = JSON.parse(this.dados);

                    if(dados.has_contatos){
                        dados = dados.has_contatos;

                        for(var i = 0; i < dados.length; i++) {
                            this.contato.contato_id = dados[i].contato_id;
                            this.contato.tipo = dados[i].tipo;
                            this.contato.contato = dados[i].contato;

                            this.addContato();
                        }
                    }
                }
            }
        },
        mounted: function(){
            this.checkEdit();
        }
    };
</script>

<style scoped>
    .box-contato{
        padding-bottom: 10px;
    }

    .btn-descartar{
        height: 60px;
        padding-top: 25px;
    }

    .btn-descartar button{
        border: none;
        background-color: #f55d5d;
        color: #ffffff;
    }

    .btn-descartar button:hover{
        background-color: #f31818;
    }

    .div-btn-add-contato {
    	padding-top: 25px;
    }

</style>
