import ApiService from "./services/api.services";

require('./bootstrap');

import App from './App.vue'
import Vue from 'vue';
import store from './store'
import router from './router';
import {TokenService} from "./services/token.service";

require('./plugins/vuetify');


// initialize the API service
ApiService.init("http://localhost/laravel-socialite-passport-boilerplate/public");

// check for the token and mount the interceptor.
if (TokenService.getToken()) {
    ApiService.setHeader();
    ApiService.mount401Interceptor();
}

const app = new Vue({
    el: '#app',
    store,
    router,
    components: {
        App
    }
});
