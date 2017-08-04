<template>
    <div class="row">
        <div class="medium-6 columns">
            <h5>¡Unirse es muy fácil!</h5>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla sagittis
                ultricies lectus at posuere. Nulla quis justo magna. Etiam placerat
                velit at arcu semper, ac fringilla quam cursus.
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
        methods: {
            joinLeague() {
                $('#loadingModal').foundation('open');
                axios.post('/leagues/join',{code:this.code}).then(
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
                        if(data.status == 'success')
                            document.location.href = '/ligas';
                    }
                ).catch(function (error) {
                    $('#loadingModal').foundation('close');
                });
            }
        }
    }
</script>
