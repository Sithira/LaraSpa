<template >

        <v-toolbar app dark>
            <!--<v-toolbar-side-icon></v-toolbar-side-icon>-->
            <router-link style="text-decoration: none" tag="a" class="text--white" :to="{ name: 'welcome' }">
                <v-toolbar-title class="white--text">
                    LaraSpa
                </v-toolbar-title>
            </router-link>

            <v-spacer></v-spacer>

            <v-toolbar-items>
                <template v-if="currentUser">
                    <v-btn flat :to="{ name: 'dashboard' }">Dashboard</v-btn>
                    <v-btn flat>Link Two</v-btn>
                    <v-btn flat>Link Three</v-btn>

                    <v-menu offset-y>
                        <template v-slot:activator="{ on }">
                            <v-btn flat dark v-on="on">
                                Hi, {{ currentUser.name }}
                            </v-btn>
                        </template>
                        <v-list>
                            <v-list-tile>
                                <v-list-tile-title style="cursor: pointer" @click="doLogOut">Logout</v-list-tile-title>
                            </v-list-tile>
                        </v-list>
                    </v-menu>


                </template>

                <template v-else>
                    <v-btn flat :to="{path: 'login'}">Login</v-btn>
                </template>
            </v-toolbar-items>

        </v-toolbar>
    <!--<header>-->
        <!--<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">-->
            <!--<a class="navbar-brand" href="#">LaraSpa</a>-->
            <!--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">-->
                <!--<span class="navbar-toggler-icon"></span>-->
            <!--</button>-->
            <!--<div class="collapse navbar-collapse" id="navbarCollapse">-->
                <!--<ul class="navbar-nav mr-auto">-->
                    <!--<li class="nav-item">-->
                        <!--<router-link tag="a" class="nav-link" active-class="active" to="/">Home</router-link>-->
                    <!--</li>-->

                    <!--<template v-if="currentUser">-->
                        <!--<li class="nav-item active">-->
                            <!--<router-link tag="a" class="nav-link" active-class="active" to="/dashboard">Dashboard</router-link>-->
                        <!--</li>-->
                    <!--</template>-->


                <!--</ul>-->

                <!--<ul class="navbar-nav ml-auto">-->
                    <!--<li class="nav-item dropdown" v-if="currentUser">-->
                        <!--<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
                            <!--{{ currentUser.name }}-->
                        <!--</a>-->
                        <!--<div class="dropdown-menu" aria-labelledby="navbarDropdown">-->
                            <!--<a class="dropdown-item" @click="doLogOut" href="javascript:void(0)">Logout</a>-->
                        <!--</div>-->
                    <!--</li>-->
                    <!--<li v-else>-->
                        <!--<router-link to="/login" tag="a" class="nav-link">Login</router-link>-->
                    <!--</li>-->
                <!--</ul>-->

            <!--</div>-->
        <!--</nav>-->

        <!--<div style="margin-bottom: 80px !important;"></div>-->

    <!--</header>-->

</template>

<script>

    import {mapActions, mapGetters} from "vuex";

    export default {

        name: "Header",

        computed: {
            ...mapGetters('auth', [
                'currentUser',
                'loggedIn'
            ])
        },

        methods: {
            ...mapActions('auth', [
                'logout'
            ]),
            doLogOut() {

                this.logout();

                this.$router.push({ name: 'login' });
            }
        }
    }
</script>

<style scoped>

</style>
