<template>
    <div>

        <div class="row">

            <div class="col-sm"></div>

            <div class="col-sm">
                <div class="card">
                    <div class="card-header">
                        Login
                    </div>

                    <div class="card-body">
                        <form @submit.prevent="authenticate">
                            <div class="form-group">
                                <label for="username">Email</label>
                                <input type="text" class="form-control" v-model="credentials.username" id="username"
                                       name="username">
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" v-model="credentials.password" class="form-control" id="password"
                                       name="password">
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-success btn-block" value="Login">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-sm"></div>
        </div>

    </div>
</template>

<script>

    import {mapActions, mapGetters} from 'vuex';

    export default {
        name: "Login",
        data() {
            return {
                credentials: {
                    username: '',
                    password: ''
                }
            }
        },

        computed: {
            ...mapGetters('auth', [
                'authenticating',
                'authenticationError',
                'authenticationErrorCode'
            ])
        },
        methods: {
            ...mapActions('auth', [
                'login'
            ]),
            async authenticate() {

                if (this.credentials.email !== '' && this.credentials.password !== '') {

                    await this.login(this.credentials);

                    this.$router.push({ name: 'dashboard' });

                }

            }
        }
    }
</script>

<style scoped>

</style>
