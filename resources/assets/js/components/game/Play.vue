<template>
    <div>
        <div class="section-title">
            <div class="row columns">
                <h1>Mis pronósticos</h1>
            </div>
        </div>
        <div class="row">
            <div class="medium-4 columns">
                <label>Cambiar de fecha
                    <select name="round" id="round" @change="loadRound()" v-model="round.id" autofocus>
                        <option v-for="rnd in rounds" :value="rnd.id">{{ rnd.name }}
                            <small>({{ rnd.start }} - {{ rnd.end }})</small>
                        </option>
                    </select>
                </label>
            </div>
            <div class="medium-4 columns text-center">
                <h2 class="fecha-title" v-if="round">{{ round.name }}</h2>
            </div>
            <div class="medium-4 columns">
                <div class="row" v-if="round.special">
                    <div class="medium-12 column">
                        <img src="/img/logos/semana-servientrega.png" height="104" width="448"/>
                    </div>
                    <!--<div class="medi
                    v-if="!round.code && round.editable">-->
                        <!--<label>Comodín <img src="/img/logos/servientrega.png" alt="Comodín Servientrega" class="comodin-img">-->
                            <!--<div class="input-group">-->
                                <!--<input class="input-group-field" type="text" placeholder="Ingrese su código" v-model="code" v-on:keyup="resetErrors('code')" :class="{ 'is-invalid-input' : errors.code }">-->
                                <!--<div class="input-group-button">-->
                                    <!--<input type="button" class="button" value="Enviar" @click="applyCode"></div>-->
                            <!--</div>-->
                        <!--</label>-->
                    <!--</div>-->
                    <!--<div class="medium-7 column comodin" v-else>-->
                        <!--<label>Comodín <img src="/img/logos/servientrega.png" alt="Comodín Servientrega" class="comodin-img">-->
                            <!--<div class="input-group">-->
                                <!--<input disabled class="input-group-field" type="text" placeholder="Ingrese su código" v-model="code">-->
                                <!--<div class="input-group-button">-->
                                    <!--<input disabled type="button" class="button" value="Enviar" @click="applyCode"></div>-->
                            <!--</div>-->
                        <!--</label>-->
                    <!--</div>-->
                    <!--<div class="medium-5 column">-->
                        <!--<p class="nota">-->
                            <!--Ingrese su código Servientrega y duplique el valor de sus aciertos para las fechas de esta semana.</p>-->
                    <!--</div>-->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="medium-12 columns">
                <hr>
                <div class="row columns encabezado hide-for-small-only">
                    <div class="medium-1 columns text-left">Fecha</div>
                    <div class="medium-1 columns text-center">Estado</div>
                    <div class="medium-2 columns text-right">Local</div>
                    <div class="medium-3 columns text-center">Pronóstico</div>
                    <div class="medium-2 columns text-left">Visitante</div>
                    <div class="medium-1 columns text-center">Marcador</div>
                    <div class="medium-1 columns text-center">Puntos</div>
                    <div class="medium-1 columns text-right"></div>
                </div>
                <div v-if="matches.length == 0" class="row item column gutter-small partido">
                    <div class=" columns text-center status" style="min-height:300px;padding-top: 100px;">
                        No hay partidos disponibles para esta fecha.
                    </div>
                </div>
                <div class="row item column gutter-small partido" v-for="(match,index) in matches">
                    <div class="medium-1 columns fecha text-left">{{ match.when }}</div>
                    <div class="medium-1 columns text-center status">
                        <i class="fi-lock" v-if="!match.editable || match.status=='finished'"></i>
                        <i class="fi-play" v-else-if="match.status=='playing'"></i>
                        <i class="fi-clock" v-else></i>
                    </div>
                    <div class="small-5 medium-2 columns text-right home">
                        {{ match.local_id.name }}
                    </div>
                    <div class="small-2 columns text-center show-for-small-only versus">VS</div>
                    <div class="small-5 medium-2 medium-push-3 columns text-left away">
                        {{ match.visit_id.name }}
                    </div>
                    <div class="small-12 medium-3 medium-pull-2 columns text-center">
                        <div class="row text-center">
                            <fieldset class="text-center pronostico">
                                <input :disabled="!match.editable" @change="updatePrediction('local',match.id, index)" type="radio" :name="'prediction'+index" value="local" :id="'local'+index" v-model="matches[index].prediction"><label :for="'local'+index">Gana</label>
                                <input :disabled="!match.editable" @change="updatePrediction('draw',match.id, index)" type="radio" :name="'prediction'+index" value="draw" :id="'draw'+index" v-model="matches[index].prediction"><label :for="'draw'+index">Empate</label>
                                <input :disabled="!match.editable" @change="updatePrediction('visit',match.id, index)" type="radio" :name="'prediction'+index" value="visit" :id="'visit'+index" v-model="matches[index].prediction"><label :for="'visit'+index">Gana</label>
                            </fieldset>
                        </div>
                    </div>
                    <div class="small-6 medium-1 columns text-center marcador"><strong class="show-for-small-only">Marcador: </strong>
                        {{ match.local_score }} - {{ match.visit_score }}
                    </div>
                    <div class="small-6 medium-1 columns text-center puntaje"><strong class="show-for-small-only">Puntos: </strong>{{ match.points }}</div>
                    <div class="small-12 medium-1 columns canal text-center">
                        <img class="logo" :src="'/img/channels/'+ match.channel +'.png'" alt="DirecTV"><strong>{{ match.channel }}</strong>
                    </div>
                </div>
                <hr>
                <hr>
                <div class="row columns gutter-small">
                    <div class="text-center suma"> Puntaje total <span v-if="round.special" style="color:#009F33;font-weight: bold;">X3</span> de fecha: <strong>{{ totalPoints }} Puntos</strong>
                    </div>
                </div>
                <hr>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            if (this.selected_round) {
                this.loadRound();
            }
        },
        data() {
            return {
                round: {
                    id: null,
                    name: ''
                },
                matches: [],
                errors: [
                    code => '',
                ],
                code: ''
            }
        },
        props: ['rounds', 'selected_round'],
        methods: {
            loadRound() {
                var round_id = null;
                if (this.round && this.round.id) round_id = this.round.id;
                else if (this.selected_round) round_id = this.selected_round;
                if (round_id) {
                    $('#loadingModal').foundation('open');
                    axios.get('/roundmatches/' + round_id).then(
                        ({data}) => {
                            if (data.round) this.round = data.round;
                            if(data.round.code)this.code =data.round.code;
                            else this.code = '';
                            if (data.matches) this.matches = data.matches;
                            $('#loadingModal').foundation('close');
                            if (data.message) {
                                new PNotify({
                                    text: data.message,
                                    type: data.status,
                                    animation: 'fade',
                                    delay: 2000
                                });
                            }
                        }
                    ).catch(function (error) {
                        $('#loadingModal').foundation('close');
                    });
                }
            },
            updatePrediction(value, match_id, index) {
                $('#loadingModal').foundation('open');
                axios.post('/predictions/' + match_id + '/update', {'value': value}).then(
                    ({data}) => {
                        $('#loadingModal').foundation('close');
                        if (data.match) Vue.set(this.matches, index, data.match);
                        if (data.message) {
                            new PNotify({
                                text: data.message,
                                type: data.status,
                                animation: 'fade',
                                delay: 2000
                            });
                        }
                    }
                ).catch(function (error) {
                    $('#loadingModal').foundation('close');
                });
            },
            applyCode() {
                axios.post('/codes/apply', {'code': this.code, 'round':this.round.id}).then(
                    ({data}) => {
                        if(data.status=='success'){
                            this.round.code = this.code;
                            this.loadRound();
                        }
                        if (data.message) {
                            new PNotify({
                                text: data.message,
                                type: data.status,
                                animation: 'fade',
                                delay: 2000
                            });
                        }
                        if(data.error){
                            this.errors.code = data.code;
                            this.errors.code.forEach(function (val) {
                                new PNotify({
                                    text: val,
                                    type: 'error',
                                    animation: 'fade',
                                    delay: 2000
                                });
                            });
                        }
                    }
                ).catch(function (error) {
                    if (error.response) {
                        if (error.response.status == 422) {
                            var data = error.response.data;
                            this.errors = data;
                            this.errors.code.forEach(function (val) {
                                new PNotify({
                                    text: val,
                                    type: 'error',
                                    animation: 'fade',
                                    delay: 2000
                                });
                            });
                        } else {
                            console.log(error.response.status);
                        }
                    } else {
                        console.log('Error', error.message);
                    }
                }.bind(this));
            },
            resetErrors(field) {
                Vue.delete(this.errors, field);
            },
        },
        computed: {
            totalPoints() {
                var total = 0;
                this.matches.forEach(function (val) {
                    total += val.points;
                });
                return total;
            }
        }
    }
</script>
