import ApiService from "./services/api.services";

require('./bootstrap');

import App from "./App.vue"
import Vue from 'vue';
import store from './system/store'

import router from './router';
import {TokenService} from "./services/token.service";
import System from "./system/System";
import Web from "./web/Web";

// initialize the API service
ApiService.init("http://localhost/LaraSpa/public");

// check for the token and mount the interceptor.
if (TokenService.getToken()) {
    ApiService.setHeader();
    ApiService.mount401Interceptor();
}

// load the base components into the system, to identify by the users
Vue.component("System", System);
Vue.component("Web", Web);

// setup the routers
const app = new Vue({
    el: '#app',
    store,
    router,
    components: {
        App
    }
});
