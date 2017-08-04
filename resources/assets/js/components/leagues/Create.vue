<template>
    <div>
        <div class="row">
            <div class="medium-12 columns">
                <h5 class="title">1. Datos de la liga</h5>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus ut libero et tellus
                    sollicitudin aliquam in eget mauris. Proin quis efficitur urna. Nulla ultricies vitae enim
                    vitae consectetur. Etiam interdum massa urna. Curabitur ut vulputate nulla, at bibendum
                    nisl. Duis vulputate semper nunc vel commodo.
                </p>
            </div>
            <div class="medium-6 columns">
                <label>Nombre de la liga
                    <input type="text" v-model="name" name="name" id="name" autofocus v-on:keyup="resetErrors('name')"
                           :class="{ 'is-invalid-input' : errors.name }">
                    <span v-if="errors.name" class="form-error is-visible">{{ errors.name[0] }}</span>
                </label>
            </div>
            <div class="medium-6 columns">
                <label>Código de invitación
                    <input type="text" name="code" id="code" v-model="code" v-on:keyup="resetErrors('code')"
                           :class="{ 'is-invalid-input' : errors.code }">
                    <span v-if="errors.code" class="form-error is-visible">{{ errors.code[0] }}</span>
                </label>
            </div>
            <div class="medium-12 columns">
                <label>Descripción
                    <input type="text" v-model="description" name="description" id="description"
                           v-on:keyup="resetErrors('description')" :class="{ 'is-invalid-input' : errors.description }">
                    <span v-if="errors.description" class="form-error is-visible">{{ errors.description[0] }}</span>
                </label>
            </div>
            <div class="medium-6 columns">
                <a v-if="id" class="button expanded" @click="updateLeague">Actualizar</a>
                <a v-else class="button expanded" @click="createLeague">Crear</a>
            </div>
            <div class="medium-6 columns">
                <a v-if="id" class="button alert expanded" @click="deleteLeague">Eliminar</a>
            </div>
        </div>
        <div v-if="id">
            <league-invite :id="id"></league-invite>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            if (this.league) {
                this.id = this.league.id;
                this.name = this.league.name;
                this.description = this.league.description;
                this.code = this.league.code;
            }
        },
        props: ['league'],
        data() {
            return {
                id: null,
                name: '',
                description: '',
                code: '',
                errors: [
                    name => null,
                    description => null,
                    code => null,
                ]
            }
        },
        methods: {
            createLeague() {
                $('#loadingModal').foundation('open');
                axios.post('/leagues', {name: this.name, description: this.description, code: this.code}).then(
                    ({data}) => {
                        if (data.id) this.id = data.id;
                        if (data.message) {
                            new PNotify({
                                text: data.message,
                                type: data.status,
                                animation: 'fade',
                                delay: 2000
                            });
                        }
                        $('#loadingModal').foundation('close');
                    }
                ).catch(function (error) {
                    $('#loadingModal').foundation('close');
                    if (error.response) {
                        if (error.response.status == 422) {
                            var data = error.response.data;
                            this.errors = data;
                        } else {
                            console.log(error.response.status);
                        }
                    } else {
                        console.log('Error', error.message);
                    }
                }.bind(this));
            },
            deleteLeague() {
                if (confirm('¿Estás segur@ que quieres eliminar esta liga?')) {
                    $('#loadingModal').foundation('open');
                    axios.delete('/leagues/' + this.id).then(
                        ({data}) => {
                            if (data.message) {
                                if (data.status == 'success') {
                                    this.id = null;
                                    this.name = '';
                                    this.description = '';
                                    this.code = '';
                                }
                                new PNotify({
                                    text: data.message,
                                    type: data.status,
                                    animation: 'fade',
                                    delay: 2000
                                });
                            }
                            $('#loadingModal').foundation('close');
                        }
                    ).catch(function (error) {
                        $('#loadingModal').foundation('close');
                        if (error.response) {
                            if (error.response.status == 403) {
                                new PNotify({
                                    text: 'No estas autorizad@ a realizar esta acción.',
                                    type: 'error',
                                    animation: 'fade',
                                    delay: 2000
                                });
                            } else {
                                console.log(error.response.status);
                            }
                        } else {
                            console.log('Error', error.message);
                        }
                    });
                }
            },
            resetErrors(field) {
                Vue.delete(this.errors, field);
            },
        }
    }
</script>
