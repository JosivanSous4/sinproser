// The following line loads the standalone build of Vue instead of the runtime-only build,
// so you don't have to do: import Vue from 'vue/dist/vue'
// This is done with the browser options. For the config, see package.json
import Vue from 'vue'
import VueResource from 'vue-resource'
import Mixins from './Mixin.js'
import money from 'v-money'
import Swal from 'sweetalert2'
import VueTheMask from 'vue-the-mask'
import Chart from 'chart.js'
import VTooltip from 'v-tooltip'
import wysiwyg from "vue-wysiwyg"

window.Inputmask = require('inputmask');

Vue.directive('input-mask', {
    bind: function(el) {
        new Inputmask({
            mask: $(el).attr('mask'),
        }).mask(el);
    },
});

Vue.use(wysiwyg);
Vue.mixin(Mixins)
Vue.use(VueResource)
Vue.use(money, {precision: 2})
Vue.use(VTooltip)
Vue.component('pagination', require('laravel-vue-pagination'));

Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#csrf-token').getAttribute('content');

// Componentes de Gráficos
import Doughnut from './components/Charts/Doughnut'
import Pie from './components/Charts/Pie'
import Bar from './components/Charts/Bar'
import LineChart from './components/Charts/LineChart'

// Componentes Comuns
import Alert from './components/Alert.vue'
import SubCabecalho from './components/SubCabecalho.vue'
import FormLocalDeTrabalho from './components/FormLocalDeTrabalho.vue'
import DadosPessoais from './components/inputs/DadosPessoais.vue'
import DadosFuncionais from './components/inputs/DadosFuncionais.vue'
import Endereco from './components/inputs/Endereco.vue'
import Contatos from './components/inputs/Contatos.vue'
import Formacoes from './components/inputs/Formacoes.vue'
import LocaisDeTrabalho from './components/inputs/LocaisDeTrabalho.vue'

// Home
import Dashboard from './components/Dashboard.vue'

// Bens
import EmprestarBens from './components/EmprestarBens.vue'
import FormBens from './components/FormBens.vue'
import ListaBens from './components/ListaBens.vue'

// Documentos
import FormCriarDocumento from './components/FormCriarDocumento.vue'
import ListaDocumentos from './components/ListaDocumentos.vue'
import EmitirDocumento from './components/EmitirDocumento.vue'

// Financeiro / Config / Tipo entrada / Tipo saida
import FormTipoEntrada from './components/FormTipoEntrada.vue'
import ListaTipoEntrada from './components/ListaTipoEntrada.vue'
import FormTipoSaida from './components/FormTipoSaida.vue'
import ListaTipoSaida from './components/ListaTipoSaida.vue'
import ListaEntrada from './components/ListaEntrada.vue'
import FormEntrada from './components/FormEntrada.vue'
import ListaSaida from './components/ListaSaida.vue'
import FormSaida from './components/FormSaida.vue'
import FormBaixaColetiva from './components/FormBaixaColetiva.vue'

// Associados
import FormAssociado from './components/FormAssociado.vue'
import ListaAssociados from './components/ListaAssociados.vue'
import PerfilAssociado from './components/PerfilAssociado.vue'

// Usuarios
import ListaUsuario from './components/ListaUsuario.vue'
import FormUsuario from './components/FormUsuario.vue'

// Configurações
import ListaLocaisTrabalho from './components/ListaLocaisTrabalho.vue'

// Relatorios
import RelatorioEntrada from './components/RelatorioEntrada.vue'
import RelatorioSaida from './components/RelatorioSaida.vue'


//Tipos de Pagamento
import FormTipoPagamento from './components/FormTipoPagamento.vue'
import ListaTiposPagamento from './components/ListaTiposPagamento.vue'

//Area de atuação
import ListaAreasAtuacao from './components/ListaAreasAtuacao.vue'
import FormAreaAtuacao from './components/FormAreaAtuacao.vue'

//Opções de Formulário
import Cadastros from './components/Cadastros.vue'

//tipos de formacao
import FormTipoFormacao from './components/FormTipoFormacao.vue'
import ListaTiposFormacoes from './components/ListaTiposFormacoes.vue'

//emprestimos
import ListaEmprestimos from './components/ListaEmprestimos.vue'
import DevolucaoBens from './components/DevolucaoBens.vue'

//site
import CadastrosSite from './components/CadastrosSite.vue'
import ListaNoticias from './components/site/ListaNoticias.vue'
import FormNoticia from './components/site/FormNoticia.vue'
import ListaParceiro from './components/site/ListaParceiro.vue'
import FormParceiro from './components/site/FormParceiro.vue'
import FormInformacoesSindicato from './components/site/FormInformacoesSindicato.vue'

import ListaDiretor from './components/site/ListaDiretor.vue'
import FormDiretor from './components/site/FormDiretor.vue'

import ListaLinkUtil from './components/site/ListaLinkUtil.vue'
import FormLinkUtil from './components/site/FormLinkUtil.vue'

import ListaCarteirinhas from './components/ListaCarteirinhas.vue'
import PaginaCnpj from './components/PaginaCnpj.vue'



new Vue({ // eslint-disable-line no-new
    el: '#app',
    components: {
        Dashboard,
        SubCabecalho,
        FormBens,
        ListaBens,
        EmprestarBens,
        FormTipoEntrada,
        ListaTipoEntrada,
        ListaTipoSaida,
        FormTipoSaida,
        SubCabecalho,
        FormAssociado,
        FormLocalDeTrabalho,
        DadosPessoais,
        DadosFuncionais,
        Endereco,
        Contatos,
        Formacoes,
        LocaisDeTrabalho,
        ListaEntrada,
        FormEntrada,
        ListaSaida,
        FormSaida,
        ListaAssociados,
        Alert,
        PerfilAssociado,
        ListaUsuario,
        FormUsuario,
        Doughnut,
        Pie,
        Bar,
        LineChart,
        FormCriarDocumento,
        ListaDocumentos,
        EmitirDocumento,
        RelatorioEntrada,
        ListaLocaisTrabalho,
        FormTipoPagamento,
        ListaTiposPagamento,
        ListaAreasAtuacao,
        FormAreaAtuacao,
        Cadastros,
        RelatorioSaida,
        FormTipoFormacao,
        ListaTiposFormacoes,
        FormBaixaColetiva,
        ListaEmprestimos,
        CadastrosSite,
        DevolucaoBens,
        ListaNoticias,
        FormNoticia,
        ListaParceiro,
        FormParceiro,
        FormInformacoesSindicato,
        ListaDiretor,
        FormDiretor,
        ListaLinkUtil,
        FormLinkUtil,
        ListaCarteirinhas,
        PaginaCnpj
    },
})
