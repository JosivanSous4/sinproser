export default {
	data() {
		return {
            money: {
                decimal: ',',
                thousands: '.',
                precision: 2,
                masked: false
            },
            form_errors : {},
            status_requisicao: false,
            urlBase: window.location.protocol + "//" + window.location.host
		}
	},
	methods : {
		formErros : function(erros) {
			var retorno = '';
			var cmpFormRequest = new Array();

			var arr = ((JSON.stringify(self.formRequest)).replace(/{|}/g,'')).replace(/"|"/g,"");
			var cmpEValores = arr.split(",");
			var arrAux = null;

			cmpEValores.forEach(function(value) {
				arrAux = value.split(":");
				cmpFormRequest.push(arrAux[0]);
			});

			cmpFormRequest.forEach(function(value) {
				if (erros[value]) {
					erros[value].forEach(function(erro) {
						retorno += erro+' <br>';
					});
				}
			});
			return retorno;
		},
		mountErrors : function(erros) {
			var retorno = '';
			var cmpFormRequest = new Array();
			var replace = ['dados_funcionais\.', 'locais_de_trabalho\.', 'locais_de_trabalho\.', 'endereco\.', 'dados_pessoais\.'];
			var strErrors = ((JSON.stringify(self.formRequest)).replace(/{|}/g,'')).replace(/"|"/g,"").replace(/[\[]/g, '').replace(/[\]]/g, '');

			var arrayErrors = strErrors.split(",");
			var strJson = '{';
			for (var i = 0; i < arrayErrors.length; i++) {
				var aux = arrayErrors[i].split(":");
				var atributo = aux[0];
				var valor = aux[1];

				if(atributo.indexOf(".") != -1){
					var aux2 = atributo.split('.');
					atributo = aux2[1];
				}

				strJson += '\"' + atributo + '\":\"' + valor + '\"';

				if((i+1) < arrayErrors.length){
					strJson += ',';
				}
			}

			strJson += '}';
			return JSON.parse(strJson);
		},
		sleep: function(milliseconds) {
			var start = new Date().getTime();
			for (var i = 0; i < 1e7; i++) {
				if ((new Date().getTime() - start) > milliseconds) {
					break;
				}
			}
		},
		contatosErrors: function(contatos, formRequest) {
            if(formRequest['contatos.contatos']){
                return 'contatos.contatos';
            } else {
                for(i = 0; i < contatos.length; i++ ) {
                    if(formRequest['contatos.contatos.'+i+'.contato'] || formRequest['contatos.contatos.'+i+'.tipo_contato']) {
                        return 'contatos.contatos.'+i;
                    }
                }
            }
		},
		countPaginate : function(lista) {
            var j = lista.from;
            var qtdeItens = lista.length;

            for (var i = 0; i < qtdeItens; i++) {
                lista.data[i].index = j++;
            }

            return lista;
        },
		salvarDados: function(pergunta, urlRequest, dados) {
			var self = this;

            Swal({
                title: pergunta,
                type: 'question',
                showCancelButton: true,
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    return self.$http.post(urlBase+urlRequest, dados).then((response) => {
                        self.retorno = response.body;
                        self.formRequest = {};
                    }, response => {
                        var form = response.body;
                        self.formRequest = form.errors;
                        self.retorno = 0;
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (self.retorno == 0) {
                	self.form_errors = self.mountErrors(self.formRequest);
                	var msg = self.formErros(self.formRequest);
                    return Swal({
                        type: 'error',
                        title: 'Corrija as inconformidades e tente novamente!',
                        html: msg,
                    });
                }

                return Swal({
                    type: self.retorno.status,
                    title: self.retorno.msg,
                });
            }).catch(Swal.noop)
		},
		excluirDados: function(pergunta, urlRequest, dados) {
            Swal({
                title: pergunta,
                type: 'question',
                showCancelButton: true,
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    return this.$http.post(urlBase+urlRequest, dados).then((response) => {
                        this.retorno = response.body;
                        this.status_requisicao = true;
                    }, response => {
                        this.status_requisicao = false;
                        this.retorno = response.body;
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                return Swal({
                    type: this.retorno.status,
                    title: this.retorno.msg,
                });
            }).catch(Swal.noop)
		},
		isNow: function(data) {
			var hoje = new Date;

			data = moment(data).format('DD/MM');
			hoje = moment(hoje).format('DD/MM')

			return data == hoje;
		}
	},

	filters : {
		date : function(data) {
			if (data) {
				return moment(data).format('DD/MM/YYYY');
			}

			return '';
        },
		dataAniversario : function(data) {
			if (data) {
				var now = new Date;
				return data + '/' + now.getFullYear();
			}

			return '';
        },
		dateTime : function(data) {
			if (data) {
				return moment(data).format('DD/MM/YYYY - HH:mm');
			}

			return  '';
        },
        dateInFull: function(data) {
            var dia = moment(data).format('DD');
            var mes = moment(data).format('M');
            var meses = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];

            return dia + ' ' + meses[mes-1];
        },
		time : function(data) {
            return moment(data).format('HH:mm');
        },
        maskCpf : function(cpf){
        	if(cpf){
	            var cpf = cpf.replace(/[^0-9]/g, '');
	            var length = cpf.length;

	            if (length > 2 && length < 12) {
	                cpf = '0'.repeat(11 - length) + cpf;
	                cpf = cpf.substr(0, 3) + '.' + cpf.substr(3, 3) + '.' + cpf.substr(6, 3) + '-' + cpf.substr(9, 2);
	            }

	            return cpf;
            }
        },
        maskCnpj : function(cnpj) {
        	if (cnpj.length <= 14) {
	            cnpj = cnpj.replace(/^(\d{2})(\d)/, "$1.$2");
	            cnpj = cnpj.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3");
	            cnpj = cnpj.replace(/\.(\d{3})(\d)/, ".$1/$2");
	            cnpj = cnpj.replace(/(\d{4})(\d)/, "$1-$2");
        	}

            return cnpj;
        },
		formaMoeda : function(value){
			var valor = parseFloat(value);
			var numero = valor.toFixed(2).split('.');
			numero[0] = numero[0].split(/(?=(?:...)*$)/).join('.');
			return numero.join(',');
		},
	}
}
