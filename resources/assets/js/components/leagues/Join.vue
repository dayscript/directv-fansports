<template>
    <div class="row">
        <div class="medium-6 columns">
            <h5>¡Unirse es muy fácil!</h5>
            <p>
                ingresa el código de la liga a la que quieres unirte. Los códigos son generados por la persona que crea la liga.
            </p>
        </div>
        <div class="medium-6 columns">
            <label>Código de invitación
                <input type="text" v-model="code" name="code" id="code" autofocus>
            </label>
            <a @click="joinLeague" class="button expanded">Unirse</a>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            if (this.initialcode) this.code = this.initialcode;
        },
        props: ['initialcode'],
        data() {
            return {
                code: null
            }
        },
        methods: {
            joinLeague() {
                if (this.code) {
                    $('#loadingModal').foundation('open');
                    axios.post('/leagues/join', {code: this.code}).then(
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
                            if (data.status == 'success')
                                document.location.href = '/ligas';
                        }
                    ).catch(function (error) {
                        $('#loadingModal').foundation('close');
                    });
                }
            }
        }
    }
</script>
