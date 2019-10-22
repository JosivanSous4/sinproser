<template>
    <div id="perfil-associado">
        <div class="m-content">
            <div class="row">
                <div class="col-lg-4">
                    <div class="m-portlet m-portlet--full-height  ">
                        <div class="m-portlet__body">
                            <div class="m-card-profile">
                                <div class="m-card-profile__title m--hide">
                                    Your Profile
                                </div>
                                <div class="m-card-profile__pic">
                                    <template v-if="associado.foto">
                                        <div class="m-card-profile__pic-wrapper" style="padding: 0px;" >
                                            <img :src="associado.foto" alt=""/>
                                        </div>
                                    </template>
                                    <template v-else>
                                        <i class="icone-usuario flaticon-user"></i>
                                    </template>
                                </div>
                                <div class="m-card-profile__details">
                                    <span class="m-card-profile__name">
                                        {{ associado.has_dados_pessoais.nome }}
                                    </span>
                                    <a href="" class="m-card-profile__email m-link">
                                        {{ associado.has_dados_pessoais.cpf|maskCpf }}
                                    </a>
                                </div>
                            </div>
                            <div class="m-portlet__body-separator"></div>
                            <div class="m-widget1 m-widget1--paddingless">
                                <div class="m-widget1__item">
                                    <div class="row m-row--no-padding align-items-center">
                                        <div class="col">
                                            <h3 class="m-widget1__title">
                                                Total em contribuições
                                            </h3>
                                            <span class="m-widget1__desc">
                                                Total em reais
                                            </span>
                                        </div>
                                        <div class="col m--align-right">
                                            <span class="m-widget1__number m--font-brand">
                                                R$ {{ associado.totalContribuicoes }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-widget1__item">
                                    <div class="row m-row--no-padding align-items-center">
                                        <div class="col">
                                            <h3 class="m-widget1__title">
                                                Saldo devedor
                                            </h3>
                                            <span class="m-widget1__desc">
                                                Total em reais
                                            </span>
                                        </div>
                                        <div class="col m--align-right">
                                            <span class="m-widget1__number m--font-danger">
                                                R$ {{ associado.saldoDevedor.valor_total }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row m-row--no-padding align-items-center" v-if="associado.saldoDevedor.meses.length > 0">
                                        <br>
                                        <table>
                                            <th>
                                                <tr>
                                                    <td>Referente aos meses</td>
                                                </tr>
                                            </th>
                                            <tbody>
                                                <tr v-for="mes in associado.saldoDevedor.meses">
                                                    <td>
                                                        <span class="m-widget1__number m--font-danger" >
                                                           {{ mes }}
                                                        </span>
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
                <div class="col-lg-8 container-informacoes-associado">
                    <div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-tools text-left">
                                <h3 class="m-form__section">
                                    Informações pessoais
                                </h3>
                            </div>
                            <div class="m-portlet__head-tools">
                                <ul class="m-portlet__nav">
                                    <li class="m-portlet__nav-item m-portlet__nav-item--last">
                                        <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
                                            <a href="#" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
                                                <i class="la la-gear"></i>
                                            </a>
                                            <div class="m-dropdown__wrapper">
                                                <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                                <div class="m-dropdown__inner">
                                                    <div class="m-dropdown__body">
                                                        <div class="m-dropdown__content">
                                                            <ul class="m-nav">
                                                                <li class="m-nav__item">
                                                                    <a :href="this.urlBase + '/associados/editar-associado/' + associado.associado_id" class="m-nav__link">
                                                                        <i class="m-nav__link-icon flaticon-edit-1"></i>
                                                                        <span class="m-nav__link-text">
                                                                            Editar informações
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                                <li class="m-nav__item" v-if="associado.has_carteirinha">
                                                                    <a :href="this.urlBase + '/associados/carteirinha/' + associado.associado_id" class="m-nav__link">
                                                                        <i class="m-nav__link-icon flaticon-medical"></i>
                                                                        <span class="m-nav__link-text">
                                                                            Ver carteirinha
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                                <li class="m-nav__item" v-else>
                                                                    <a :href="this.urlBase + '/associados/carteirinha/emitir-carteirinha/' + associado.associado_id" class="m-nav__link">
                                                                        <i class="m-nav__link-icon flaticon-medical"></i>
                                                                        <span class="m-nav__link-text">
                                                                            Emitir carteirinha
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane active" id="m_user_profile_tab_1">
                                <div class="m-portlet__body">
                                    <div class="form-group m-form__group row">
                                        <div class="col-12 ml-auto texto-descricao-associado">
                                            {{ associado.has_dados_pessoais.nome }}, nascido em {{ associado.has_dados_pessoais.data_nascimento|date }}, {{ associado.has_dados_pessoais.estado_civil }},
                                            residente á rua {{ associado.has_endereco.rua }}, Nº {{ associado.has_endereco.numero_residencia }}, bairro {{ associado.has_endereco.bairro }}, {{ associado.has_endereco.has_cidade.cidade }} - {{ associado.has_endereco.has_cidade.has_estado.uf }},
                                            atuante na área de {{ associado.has_area_atuacao.nome }}
                                        </div>
                                    </div>
                                    <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space-2x"></div>
                                    <div class="form-group m-form__group row">
                                        <div class="col-12">
                                            <h3 class="m-form__section">
                                                Dados pessoais
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="example-text-input" >
                                                CPF
                                            </label>
                                            <input class="form-control" disabled :value="associado.has_dados_pessoais.cpf|cpf" type="text">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="example-text-input">
                                                RG
                                            </label>
                                            <input class="form-control" disabled :value="associado.has_dados_pessoais.rg" type="text">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="example-text-input" >
                                                Data de emissão
                                            </label>
                                            <input class="form-control" disabled :value="associado.has_dados_pessoais.data_emissao_rg|date" type="text">
                                        </div>

                                        <div class="col-md-4 offset-4 form-group">
                                            <label for="example-text-input">
                                                Órgão Emissor
                                            </label>
                                            <div>
                                                <input class="form-control m-input" disabled :value="associado.has_dados_pessoais.orgao_emissor_rg" type="text" value="Keenthemes">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space-2x"></div>
                                    <div class="form-group m-form__group row">
                                        <div class="col-12 ml-auto">
                                            <h3 class="m-form__section">
                                                Dados funcionais
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="example-text-input" class="col-form-label">
                                                Data de admissão
                                            </label>
                                            <input class="form-control m-input" disabled type="text" :value="associado.has_dados_funcionais.data_admissao|date">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="example-text-input" class="col-form-label">
                                                Portaria
                                            </label>
                                            <input class="form-control m-input" disabled type="text" :value="associado.has_dados_funcionais.portaria">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="example-text-input" class="col-form-label">
                                                PIS/PASEP
                                            </label>
                                            <input class="form-control m-input" disabled type="text" :value="associado.has_dados_funcionais.pis_pasep">
                                        </div>
                                    </div>
                                    <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space-2x"></div>
                                    <div class="form-group m-form__group row">
                                        <div class="col-12 ml-auto">
                                            <h3 class="m-form__section">
                                                Contatos
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="col-md-12 row">
                                        <table class="table table-striped- table-bordered table-hover table-checkable">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        Tipo de Contato
                                                    </th>
                                                    <th>
                                                        Contato
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <template v-if="associado.has_contatos.length">
                                                    <tr v-for="(contato, index) in associado.has_contatos">
                                                        <td class="align-middle">
                                                            {{ contato.tipo }}
                                                        </td>
                                                        <td class="align-middle">
                                                            {{ contato.contato }}
                                                        </td>
                                                    </tr>
                                                </template>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space-2x"></div>
                                    <div class="form-group m-form__group row">
                                        <div class="col-12 ml-auto">
                                            <h3 class="m-form__section">
                                                Local de Trabalho
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="col-md-12 row">
                                        <table class="table table-striped- table-bordered table-hover table-checkable">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        Local de trabalho
                                                    </th>
                                                    <th>
                                                        função
                                                    </th>
                                                    <th>
                                                        matricula
                                                    </th>
                                                    <th>
                                                        data de vínculo
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <template v-if="associado.locais_de_trabalho">
                                                    <tr v-for="(local_trabalho, index) in associado.locais_de_trabalho">
                                                        <td v-html="local_trabalho.str_local_trabalho">
                                                        </td>
                                                        <td>
                                                            {{ local_trabalho.funcao }}
                                                        </td>
                                                        <td>
                                                            {{ local_trabalho.matricula }}
                                                        </td>
                                                        <td>
                                                            {{ local_trabalho.data_vinculacao|date }}
                                                        </td>
                                                    </tr>
                                                </template>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space-2x"></div>
                                    <div class="form-group m-form__group row">
                                        <div class="col-12 ml-auto">
                                            <h3 class="m-form__section">
                                                Formações
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="col-md-12 row">
                                        <table class="table table-striped- table-bordered table-hover table-checkable">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        Tipo de Formação
                                                    </th>
                                                    <th>
                                                        Formação
                                                    </th>
                                                    <th>
                                                        Situação da Formação
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <template v-if="associado.has_formacoes.length">
                                                    <tr v-for="(formacao, index) in associado.has_formacoes">
                                                        <td class="align-middle">
                                                            {{ formacao.has_tipo_formacao.nome }}
                                                        </td>
                                                        <td class="align-middle">
                                                            {{ formacao.formacao }}
                                                        </td>
                                                        <td class="align-middle">
                                                            {{ formacao.situacao_formacao }}
                                                        </td>
                                                    </tr>
                                                </template>
                                            </tbody>
                                        </table>
                                        <span class="grau-instrucao">Grau de instrução: {{ associado.has_grau_instrucao.nome }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'perfil-associado',
        props: ['dados'],
        data() {
            return {
                urlBase : urlBase,
                associado: {}
            }
        },
        methods : {
        },
        created () {
            this.associado = JSON.parse(this.dados);
        },
    };
</script>

<style scoped>
    .icone-usuario {
        font-size: 50pt;
    }

    .texto-descricao-associado {
        font-family: inherit;
        font-size: 12pt;
    }

    .container-informacoes-associado {
        padding-left: 0px;
    }

    .grau-instrucao {
        margin-top: -10px;
    }
</style>
