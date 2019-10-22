<template>
    <div id="dashboard">
        <div class="m-content">
            <div class="m-portlet">
                <div class="m-portlet ">
                    <div class="m-portlet__body  m-portlet__body--no-padding">
                        <div class="row m-row--no-padding m-row--col-separator-xl">
                            <div class="col-md-12 col-lg-6 col-xl-4">
                                <div class="m-widget24">
                                    <div class="m-widget24__item">
                                        <h4 class="m-widget24__title">
                                            Total de associados
                                        </h4>
                                        <br>
                                        <span class="m-widget24__desc">
                                            Soma de todos os associados
                                        </span>
                                        <span class="m-widget24__stats m--font-brand">
                                            {{ total_associados }} 
                                        </span>
                                        <div class="m--space-10"></div>
                                        <div class="progress m-progress--sm">
                                            <template v-if="total_associados > 0">
                                                <div class="progress-bar m--bg-brand" role="progressbar" style="width: 100%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                            </template>
                                            <template v-else>
                                                <div class="progress-bar m--bg-brand" role="progressbar" style="width: 0%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                            </template>
                                        </div>
                                        <span class="m-widget24__change">
                                            Equivalente a
                                        </span>
                                        <span class="m-widget24__number">
                                            <template v-if="total_associados > 0">
                                                100%
                                            </template>
                                            <template v-else>
                                                0%
                                            </template>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6 col-xl-4">
                                <div class="m-widget24">
                                    <div class="m-widget24__item">
                                        <h4 class="m-widget24__title">
                                            Professores
                                        </h4>
                                        <br>
                                        <span class="m-widget24__desc">
                                            Número total de professores
                                        </span>
                                        <span class="m-widget24__stats m--font-info">
                                            {{ total_professores }}
                                        </span>
                                        <div class="m--space-10"></div>
                                        <div class="progress m-progress--sm">
                                            <template v-if="total_professores > 0">
                                                <div class="progress-bar m--bg-info" role="progressbar" :style="'width: ' + percentual_professores +'%'" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                            </template>
                                            <template v-else>
                                                <div class="progress-bar m--bg-info" role="progressbar" style="width: 0%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                            </template>
                                        </div>
                                        <span class="m-widget24__change">
                                            Equivalente a
                                        </span>
                                        <span class="m-widget24__number">
                                            <template v-if="total_professores > 0">
                                                {{ percentual_professores }}%
                                            </template>
                                            <template v-else>
                                                0%
                                            </template>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6 col-xl-4">
                                <div class="m-widget24">
                                    <div class="m-widget24__item">
                                        <h4 class="m-widget24__title">
                                            Servidores
                                        </h4>
                                        <br>
                                        <span class="m-widget24__desc">
                                            Número total de servidores
                                        </span>
                                        <span class="m-widget24__stats total-servidores">
                                            {{ total_nao_professores }}
                                        </span>
                                        <div class="m--space-10"></div>
                                        <div class="progress m-progress--sm">
                                            <template v-if="total_nao_professores > 0">
                                                <div class="progress-bar barra-servidor" role="progressbar" :style="'width: ' + percentual_nao_professores + '%'" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                            </template>
                                            <template v-else>
                                                <div class="progress-bar barra-servidor" role="progressbar" style="width: 0%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                            </template>
                                        </div>
                                        <span class="m-widget24__change">
                                            Equivalente a
                                        </span>
                                        <span class="m-widget24__number">
                                            <template v-if="total_nao_professores.length > 0">
                                                {{ percentual_nao_professores }}%
                                            </template>
                                            <template v-else>
                                                0%
                                            </template>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 col-lg-12">
                    <!--Begin::Portlet-->
                    <div class="m-portlet  m-portlet--full-height ">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                        Aniversariantes do mês
                                    </h3>
                                </div>
                            </div>
                            <div class="m-portlet__head-tools">
                                <ul class="m-portlet__nav">
                                    <li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
                                        <a href="#" class="m-portlet__nav-link m-portlet__nav-link--icon m-portlet__nav-link--icon-xl m-dropdown__toggle">
                                            <i class="la la-ellipsis-h m--font-brand"></i>
                                        </a>
                                        <div class="m-dropdown__wrapper">
                                            <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                            <div class="m-dropdown__inner">
                                                <div class="m-dropdown__body meses-aniversario">
                                                    <div class="m-dropdown__content">
                                                        <ul class="m-nav">
                                                            <li class="m-nav__section m-nav__section--first">
                                                                <span class="m-nav__section-text">
                                                                    Selecione um mês
                                                                </span>
                                                            </li>
                                                            <li v-for="(mes, index) in meses" class="m-nav__item">
                                                                <a @click="getAniversariantesDoMes(index + 1)" class="m-nav__link clicavel">
                                                                    <span class="m-nav__link-text">
                                                                        {{ mes }}
                                                                    </span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <div v-if="aniversariantes.length" class="m-scrollable mCustomScrollbar _mCS_5 mCS-autoHide" data-scrollbar-shown="true" data-scrollable="true" data-max-height="380" style="overflow: visible; height: 380px; max-height: 380px; position: relative;">
                                <div class="m-timeline-2">
                                    <div class="m-timeline-2__items  m--padding-top-25 m--padding-bottom-30">
                                        <template v-for="(aniversariante, index) in aniversariantes">
                                            <div class="m-timeline-2__item content-aniversariante">
                                                <template v-if="isNow(aniversariante.data_aniversario)">
                                                    <span class="m-timeline-4__item-time cor-ativo">
                                                        {{ aniversariante.data_aniversario|dataAniversario }}
                                                    </span>
                                                    <div class="m-timeline-2__item-cricle circulo">
                                                        <i class="fa fa-genderless cor-ativo"></i>
                                                    </div>
                                                </template>
                                                <template v-else>
                                                    <span class="m-timeline-4__item-time">
                                                        {{ aniversariante.data_aniversario|dataAniversario }}
                                                    </span>
                                                    <div class="m-timeline-2__item-cricle circulo">
                                                        <i class="fa fa-genderless cor-inativo"></i>
                                                    </div>
                                                </template>
                                                <div class="m-list-pics m-list-pics--sm padding-left-40 div-foto-associado">
                                                    <a :href="urlBase + '/associados/perfil-associado/' + aniversariante.associado_id + '/' + aniversariante.nome" target="_blank">
                                                        <template v-if="aniversariante.foto">
                                                            <img class="foto-aniversariante" :src="urlBase+'/storage/uploads/'+aniversariante.foto" title="">
                                                        </template>
                                                        <template v-else>
                                                            <img class="foto-aniversariante" :src="urlBase+'/assets/img/icon-profile.png'" title="">
                                                        </template>
                                                    </a>
                                                    <br><span class="nome-aniversariante">{{ aniversariante.nome }}</span>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>
                            <div v-else class="col-md-12 text-center padding-0">
                                <h2 class="msg-nao-ha-aniversariantes">Não há aniversariantes</h2>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="m-portlet  m-portlet--full-height ">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                        Gráfico de adimplência
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                        <!-- <div class="col-md-12 form-group">
                                <select class="pull-right select-dash">
                                    <template v-for="(ano, index) in anos">
                                        <option :value="ano">{{ ano }}</option>
                                    </template>
                                </select>
                                <select class="pull-right select-dash">
                                    <template v-for="(mes, index) in meses">
                                        <option :value="index+1">{{ mes }}</option>
                                    </template>
                                </select>
                            </div> -->
                            <div class="row align-items-center col-md-12">
                                <pie class="col-md-12" :chartData="grafico_adimplencia.data"  :options="grafico_adimplencia.options" style="height:300px"></pie>
                            </div>       
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="m-portlet  m-portlet--full-height ">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                        Rendimentos do ano
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <!-- <div class="col-md-12 form-group">
                                <select class="pull-right select-dash">
                                    <template v-for="(ano, index) in anos">
                                        <option :value="index+1">{{ ano }}</option>
                                    </template>
                                </select>
                            </div> -->
                            <div class="row align-items-center col-md-12">
                                <line-chart class="col-md-12" :chartData="grafico_rendimento.data"  :options="grafico_rendimento.options" style="height:300px;"></line-chart>
                            </div>       
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Bar from './Charts/Bar'
    import LineChart from './Charts/LineChart'
    import Pie from './Charts/Pie'

    export default {
        props: ['dados_grafico_rendimento', 'dados_grafico_adimplencia', 'lista_anos'],
        name: 'dashboard',
        components: { Bar, LineChart, Pie },
        data() {
            return {
                urlBase : urlBase,
                total_associados: 0,
                total_professores: 0,
                percentual_professores: 0,
                total_nao_professores: 0,
                percentual_nao_professores: 0,
                aniversariantes: [],
                meses: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                dados_rendimento: {},
                anos: JSON.parse(this.lista_anos),
                grafico_adimplencia: {
                    data: {},
                    options: {}
                },
                grafico_rendimento : {
                    data: {},
                    options: {}
                },
                grafico : {
                    data: {},
                    options: {}
                },
            }
        },
        methods : {
            getQuantidadeDeAssociados: function(){
                this.$http.get(this.urlBase+'/api/total-de-associados').then(response => {
                    this.total_associados = response.data;
                    this.getQuantidadeDeAssociadosProfessores();
                    this.getQuantidadeDeAssociadosNaoProfessores();
                });
            },
            getDadosGraficoRendimento: function(){
                this.$http.get(this.urlBase+'/api/dados-grafico-rendimento').then(response => {
                    this.dados_rendimento = response.data;
                    this.gerarGraficoRendimento();
                });
            },
            getQuantidadeDeAssociadosProfessores: function() {
                var self = this;
                self.$http.get(self.urlBase+'/api/total-de-associados-professores').then(response => {
                    self.total_professores = response.data;
                    self.percentual_professores = self.percentualAssociado(self.total_professores);
                });
            },
            getQuantidadeDeAssociadosNaoProfessores: function(){
                var self = this;
                self.$http.get(self.urlBase+'/api/total-de-associados-nao-professores').then(response => {
                    self.total_nao_professores = response.data;
                    self.percentual_nao_professores = self.percentualAssociado(self.total_nao_professores);
                });
            },
            percentualAssociado: function(numero){
                if(numero > 0){                
                    var percentualAux = (numero * 100) / this.total_associados;
                    var percentual = Infinity;

                    while(percentual == Infinity){
                        percentual = parseFloat(percentualAux.toFixed(2));
                    }

                    return percentual;
                } else {
                    return 0;
                }
            },
            getAniversariantesDoMes: function(mes){
                var self = this;
                var url = '/api/aniversariantes-do-mes';
                if( mes ){
                    url += '/' + mes;
                } 

                self.$http.get(self.urlBase+url).then(response => {
                    self.aniversariantes = response.data;
                    self.aniversariantes = self.aniversariantes.aniversariantes;
                });
            },
            gerarGraficoRendimento: function(){
                var grafico = this.newGrafico();

                grafico.data.labels = this.meses;

                var dados = JSON.parse(this.dados_grafico_rendimento);

                grafico.data = {
                    labels: this.meses,
                    datasets: [
                        {
                            label: 'Saídas',
                            backgroundColor: 'rgba(236,57,57,1)',
                            borderColor: 'rgba(236,57,57,0.0)',
                            data: dados.saida
                        },
                        {
                            label: 'Entradas',
                            backgroundColor: 'rgba(47,162,208,1)',
                            borderColor: 'rgba(47,162,208,0.0)',
                            data: dados.entrada
                        }
                    ]
                };
                // grafico.data.datasets[1].data = [2,10,12,11,12,13,15,16,18,45,22,33];
                grafico.options.title.text = 'Rendimentos do ano';

                this.grafico_rendimento.data = grafico.data;
                this.grafico_rendimento.options = grafico.options;
            },
            gerarGraficoAdimplentes: function(){
                var grafico = this.newGrafico();

                var dados = JSON.parse(this.dados_grafico_adimplencia);
                console.log(dados);

                grafico.data = {
                    labels: ['Adimplentes', 'Inadimplentes'],
                    datasets: [
                        {
                            backgroundColor: ['rgba(45,180,195,0.4)', '#f4516c'],
                            borderColor: 'rgba(45,180,195,0.0)',
                            data: [dados.adimplentes.total_adimplentes, dados.inadimplentes.total_inadimplentes]
                        }
                    ]
                };

                grafico.options.title.text = 'Gráfico referente a '+ this.meses[dados.mes-1] + ' de ' + dados.ano;

                this.grafico_adimplencia.data = grafico.data;
                this.grafico_adimplencia.options = grafico.options;
            },
            criarGrafico: function(){
                var grafico = this.newGrafico();

                grafico.data.labels = ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"];
                
                grafico.data.datasets[0].backgroundColor = [                                
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ];

                grafico.data.datasets[0].borderColor = [                                
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ];

                grafico.data.datasets[0].data = [12, 19, 3, 5, 2, 3];
                grafico.options.title.text = 'Homens e Mulheres';

                this.grafico.data = grafico.data;
                this.grafico.options = grafico.options;
            },
            newGrafico: function(){
                var grafico = {
                    data : {
                        labels:[],
                        datasets: [
                            {
                                label: '',
                                backgroundColor: '',
                                borderColor: '#ffffff',
                                data: [],
                                borderWidth: 1,
                                lineTension: 0.3,
                                pointHoverBackgroundColor: "rgba(75,192,192,1)",
                                pointHoverBorderColor: "rgba(220,220,220,1)",
                            }
                        ] 
                    },
                    options : {
                        responsive: true, 
                        maintainAspectRatio: false,
                        title: {
                            display: true,
                            position: 'bottom',
                            text: 'Homens e Mulheres'
                        }
                    },
                }

                return grafico;
            },
        },
        created () {
            this.getAniversariantesDoMes();
            this.getQuantidadeDeAssociados();
            this.gerarGraficoRendimento();
            this.gerarGraficoAdimplentes();
            this.criarGrafico();
        },
    };
</script>

<style scoped>
    .foto-aniversariante {
        width: 150px;
    }

    .padding-left-40 {
        padding-left: 40px;
    }

    .div-foto-associado a {
        text-decoration: none;
    }

    .content-aniversariante {
        margin-top: 55px;
    }

    .cor-inativo {
        color: #b7beec;
    }

    .cor-ativo {
        color: #54bd14;
    }

    .circulo {
        height: 11px;
        width: 11px;
        background-color: #fff;
        margin-top: -3px;
        margin-left: -5px;
    }

    .nome-aniversariante {
        color: #b9b9b9;
        font-size: 12pt;
        padding-top: 15px;
    }

    .msg-nao-ha-aniversariantes {
        color: #cecece;
    }

    .padding-0 {
        padding: 0px;
    }

    .meses-aniversario {
        overflow-y: auto; 
        max-height: 200px;
    }

    .clicavel {
        cursor: pointer;
    }

    .barra-servidor {
        background-color: #f4c251;
    }

    .total-servidores {
        color: #f4c251;
    }

    .select-dash {
        border-color: #fff;
    }
</style>