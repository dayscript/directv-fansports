<template>
    <div>
        <div class="row">
            <div class="medium-6 columns">
                <label>Ligas
                    <select name="league" id="league" @change="loadRanking(1)" v-model="league.id" autofocus>
                        <option value="0">Clasificación General</option>
                        <option v-for="lg in leagues" :value="lg.id">{{ lg.name }}</option>
                    </select>
                </label>
            </div>
            <div class="medium-6 columns">
                <label>Fechas
                    <select name="round" id="round" @change="loadRanking(1)" v-model="round.id">
                        <option value="0">Acumulado</option>
                        <option v-for="rnd in rounds" :value="rnd.id">{{ rnd.name }}
                            <small>({{ rnd.start }} - {{ rnd.end }})</small>
                        </option>
                    </select>
                </label>
            </div>
        </div>
        <h4 class="title">Tabla de posiciones</h4>
        <div class="row columns encabezado">
            <div class="small-1 columns text-left">Pos.</div>
            <div class="small-9 columns text-left">Participante</div>
            <div class="small-2 columns text-right">Puntos</div>
        </div>
        <div v-for="(user,index ) in users">
            <div class="row item columns" :class="{'account':userid==user.id}">
                <div class="small-1 columns text-left puntos">{{ parseInt(index) + 1 }}</div>
                <div class="small-9 columns user">
                    <i class="fi-torso" v-if="userid==user.id"></i>
                    <a :href="'/users/'+user.id">{{ user.name + ' ' + user.last }}</a>
                </div>
                <div class="small-2 columns text-right puntos">{{ user.points }}</div>
            </div>
            <hr>
        </div>
        <hr class="light">
        <ul class="pagination text-center" role="navigation" aria-label="Pagination">
            <li class="pagination-previous disabled" v-if="!pagination.prev">Anterior</li>
            <li class="pagination-previous" v-else><a @click.prevent="loadRanking(pagination.prev)" aria-label="Prev page">Anterior</a></li>
            <li v-if="pagination.page==1" class="current"><span class="show-for-sr"></span> 1</li>
            <li v-else><a @click.prevent="loadRanking(1)" aria-label="First Page">1</a></li>
            <li class="ellipsis" v-if="pagination.page>2"></li>
            <li v-if="pagination.page != 1 && pagination.page != pagination.pages" class="current"><span class="show-for-sr"></span> {{ pagination.page }}</li>
            <li class="ellipsis" v-if="pagination.pages-pagination.page>1"></li>
            <li v-if="pagination.pages>2 && pagination.page==pagination.pages" class="current"><span class="show-for-sr"></span> {{ pagination.pages }}</li>
            <li v-else-if="pagination.pages>2"><a @click.prevent="loadRanking(pagination.pages)" aria-label="Last Page">{{ pagination.pages }}</a></li>
            <li class="pagination-next disabled" v-if="!pagination.next">Siguiente</li>
            <li class="pagination-next" v-else><a @click.prevent="loadRanking(pagination.next)" aria-label="Next page">Siguiente</a></li>
        </ul>
    </div>
</template>

<script>
    export default {
        mounted() {
            if(this.l){
                this.league.id = this.l;
            }
            this.loadRanking(1);
        },
        data() {
            return {
                round: {
                    id: 0,
                    name: 'Acumulado'
                },
                league: {
                    id: 0,
                    name: 'Clasificación General'
                },
                users: [],
                pagination: {
                    page: 1,
                    pages: 1,
                    prev: null,
                    next: null,
                    total: 0,
                    items: 10
                }
            }
        },
        props: ['rounds', 'leagues', 'userid','l'],
        methods: {
            loadRanking(page) {
                $('#loadingModal').foundation('open');
                axios.post('/rankingdata/'+page,{'round':this.round.id,'league':this.league.id}).then(
                    ({data}) => {
                        if (data.users) this.users = data.users;
                        if (data.pagination) this.pagination= data.pagination;
                        $('#loadingModal').foundation('close');
                    }
                ).catch(function (error) {
                    $('#loadingModal').foundation('close');
                });

            },
        }
    }
</script>
