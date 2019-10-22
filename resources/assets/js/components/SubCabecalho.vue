<template>
    <div id="sub-cabecalho">
        <div class="m-subheader ">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator" v-if="titulo">
                        {{ titulo }}
                    </h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">
                            <a :href="urlBase" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>
                        <template v-for="(item, index) in lista">
                            <li class="m-nav__item">
                                <a :href="item.link" class="m-nav__link">
                                    <span class="m-nav__link-text">
                                        {{ item.nome }}
                                    </span>
                                </a>
                            </li>
                            <li class="m-nav__separator" v-if="index < ( lista.length - 1)">
                                /&nbsp;
                            </li>
                        </template>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'sub-cabecalho',
        props: ['lista'],
        data() {
            return {
            }
        },
        methods : {
        },
    };
</script>

<style scoped>

</style>