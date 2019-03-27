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

                        <a href="javascript:void(0)" @click="socialiteAuthentication('google')" class="btn btn-primary">Google</a>

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
                'authenticationErrorCode',
                'currentUser'
            ])
        },
        methods: {
            ...mapActions('auth', [
                'login',
                'socialiteLogin'
            ]),

            async authenticate() {

                if (this.credentials.email !== '' && this.credentials.password !== '') {

                    await this.login(this.credentials);

                    this.$router.push({ name: 'dashboard' });

                }

            },

            socialiteAuthentication(provider) {

                axios.get(`login/${provider}`).then((response) => {

                    window.location = response.data.data.url;

                })

            }
        },

        beforeMount() {

            const currentPath = this.$route.path;

            if (currentPath === "/oauth/callback") {

                const auth_data = JSON.parse(this.$route.query.data);

                this.socialiteLogin(auth_data).then(function() {

                    this.$router.push({name: 'dashboard'});

                }.bind(this));

            }

        }
    }
</script>

<style scoped>

</style>
