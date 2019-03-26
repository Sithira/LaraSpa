<template>
    <v-layout row wrap>

        <v-flex md4></v-flex>

        <v-flex md4>

            <v-toolbar dark>
                <v-toolbar-title >Login</v-toolbar-title>
            </v-toolbar>

            <v-card class="pa-3">

                <v-form @submit.prevent="authenticate">
                    <v-text-field
                            label="Email"
                            data-vv-name="username"
                            v-model="credentials.username"
                    >
                    </v-text-field>

                    <v-text-field
                            label="Password"
                            data-vv-name="password"
                            v-model="credentials.password"
                            type="password"
                    >
                    </v-text-field>

                    <v-btn
                            color="success"
                            type="submit"
                            block
                    >
                        Login
                    </v-btn>

                    <p class="text-md-center">OR</p>

                    <v-btn color="primary" @click="socialiteAuthentication('google')">Google</v-btn>

                </v-form>
            </v-card>

        </v-flex>

        <v-flex md4></v-flex>
    </v-layout>
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
