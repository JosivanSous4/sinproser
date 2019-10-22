<template>
    <div id="alert">
        <div style="margin-bottom: 0px">
            <template v-for="tipoAlerta in tipos">
                <div v-if="tipo == tipoAlerta" :class="'alert alert-' + tipoAlerta" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                    {{ mensagem }}
                </div>
            </template>
                
        </div>
    </div>
</template>

<script>
    export default {
        props: ['tipo', 'mensagem'],
        name: 'alert',
        data() {
            return {
                tipos: ['default','success','info','warning','danger','brand', 'primary']
            }
        },
        methods : {
        },
        created () {
        },
    };
</script>

<style scoped>
    .alert {
        margin-bottom: 0px
    }

    .close {
        margin-top: -10px;
    }
</style>