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
                    <select name="round" id="round">
                        <option v-for="round in rounds" :value="round.id">{{ round.name }} <small>({{ round.start }} - {{ round.end }})</small></option>
                    </select>
                </label>
            </div>
            <div class="medium-4 columns text-center">
                <h2 class="fecha-title">{{ selected_round }}</h2>
            </div>
            <div class="medium-4 columns">
                <div class="row">
                    <div class="medium-7 column comodin">
                        <label>Comodín <img src="/img/logos/servientrega.png" alt="Comodin Servientrega" class="comodin-img">
                            <div class="input-group">
                                <input class="input-group-field" type="text" placeholder="Ingrese su código">
                                <div class="input-group-button">
                                    <input type="submit" class="button" value="Enviar">
                                </div>
                            </div>
                        </label>
                    </div>
                    <div class="medium-5 column">
                        <p class="nota">Ingrese su código Servientrega y duplique el valor de sus aciertos para las fechas de
                            esta semana.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Game Component mounted.')
        },
        props:['rounds', 'selected_round']
    }
</script>
