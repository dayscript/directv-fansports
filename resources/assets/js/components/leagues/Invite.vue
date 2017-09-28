<template>
    <div class="row">
        <div class="medium-12 columns">
            <h5 class="title">2. Invita a tus amigos</h5>
        </div>
        <div class="medium-6 columns">
            <p>
                Puedes invitar a tus amigos a unirte a esta liga. Para hacerlo, ingresa a continuación las direcciones de correo electrónico y les enviaremos una invitación. <br>
                Puedes escribir las direcciones separadas por espacios, comas, o en líneas separadas, de cualquier forma funciona.
            </p>
            <textarea placeholder="Tu lista de amigos" name="list" id="list" v-model="list"></textarea>
            <a @click="sendInvites" class="button expanded">Invitar</a>
        </div>
        <div class="medium-6 columns">
            <p>
            </p>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {

        },
        props: ['id'],
        data() {
            return {
                list: ''
            }
        },
        methods: {
            sendInvites() {
                $('#loadingModal').foundation('open');
                axios.post('/leagues/'+this.id + '/invite', {list: this.list}).then(
                    ({data}) => {
                        if (data.message) {
                            new PNotify({
                                text: data.message,
                                type: data.status,
                                animation: 'fade',
                                delay: 2000
                            });
                            this.list = '';
                        }
                        $('#loadingModal').foundation('close');
                    }
                ).catch(function (error) {
                    $('#loadingModal').foundation('close');
                });
            },
        }
    }
</script>
