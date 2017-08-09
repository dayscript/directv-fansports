<template>
    <div class="row item liga column">
        <div class="medium-6 columns text-left item-liga">{{ league.name }}</div>
        <div class="small-6 medium-2 columns text-center item-liga"><strong
                class="show-for-small-only">Usuarios: </strong> {{ league.users_count }}
        </div>
        <div class="small-6 medium-2 columns text-center item-liga"><strong
                class="show-for-small-only">Puntos: </strong>{{ league.users_points }}
        </div>
        <div class="medium-2 columns text-center close ">
            <a v-if="editable" :href="'/ligas?edit='+league.id" class="button small">Editar</a>
            <a v-if="!editable" @click="leaveLeague" class="button alert small">Abandonar</a>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        props: ['league', 'editable'],
        methods: {
            leaveLeague() {
                $('#loadingModal').foundation('open');
                axios.post('/leagues/' + this.league.id + '/leave').then(
                    ({data}) => {
                        $('#loadingModal').foundation('close');
                        if (data.message) {
                            new PNotify({
                                text: data.message,
                                type: data.status,
                                animation: 'fade',
                                delay: 2000
                            });
                        }
                        document.location.href = '/ligas';
                    }
                ).catch(function (error) {
                    $('#loadingModal').foundation('close');
                });
            }
        }
    }
</script>
