<template>
    <div class="row item liga column">
        <div class="medium-6 columns text-center item-liga">{{ league.name }}</div>
        <div class="small-6 medium-2 columns text-center item-liga"> <strong class="show-for-small-only">Usuarios: </strong> {{ league.users_count }}</div>
        <div class="small-6 medium-2 columns text-right item-liga"><strong class="show-for-small-only">Puntos: </strong>{{ league.users_points }}</div>
        <div class="medium-2 columns text-center close "><i class="fi-x-circle"></i> <strong class="show-for-small-only">Abandonar</strong></div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        props:['league']
    }
</script>
