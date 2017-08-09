<template>
    <div>
        <div class="section">Cambiar contraseña</div>
        <label>Nueva contraseña
            <input type="password" name="password" id="password" v-model="password" v-on:keyup="resetErrors('password')" :class="{ 'is-invalid-input' : errors.password }">
            <span v-if="errors.password" class="form-error is-visible">{{ errors.password[0] }}</span>
        </label>
        <label>Confirmar contraseña
            <input id="password-confirm" type="password" :class="{ 'is-invalid-input' : errors.password_confirmation }" name="password_confirmation" required v-model="password_confirmation" v-on:keyup="resetErrors('password_confirmation')">
            <span v-if="errors.password_confirmation" class="form-error is-visible">{{ errors.password_confirmation[0]
                }}</span>
        </label>
        <a @click="changePassword" class="button expanded">Modificar contraseña</a>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                password: '',
                password_confirmation: '',
                errors: [
                    password => '',
                    password_confirmation => '',
                ]
            }
        },
        methods: {
            changePassword() {
                $('#loadingModal').foundation('open');
                axios.post('users/updatepassword',{'password':this.password, 'password_confirmation':this.password_confirmation}).then(
                    ({data}) => {
                        $('#loadingModal').foundation('close');
                        this.password = this.password_confirmation = '';
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
                    this.password = this.password_confirmation = '';
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
            resetErrors(field) {
                Vue.delete(this.errors, field);
            },
        }
    }
</script>
