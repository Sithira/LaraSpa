import ApiService from "./portal/services/api.services";

require('./portal/bootstrap');

import AppAdmin from './portal/AppAdmin.vue'
import Vue from 'vue';
import store from './portal/store'
import router from './portal/router';
import {TokenService} from "./portal/services/token.service";


// check for the token and mount the interceptor.
if (TokenService.getToken()) {
    ApiService.setHeader();
    ApiService.mount401Interceptor();
}

if (window.location.href.indexOf("admin") > -1) {

    require('./portal/plugins/vuetify');

    // initialize the API service
    ApiService.init("http://localhost/laravel-socialite-passport-boilerplate/public");

    const app = new Vue({
        el: '#app',
        store,
        router,
        components: {
            AppAdmin
        }
    });

}
else {
    const app = new Vue({
        el: '#app',
        store,
        router,
        components: {
            AppAdmin
        }
    });
}
