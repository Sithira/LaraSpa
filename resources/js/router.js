import Vue from 'vue'
import VueRouter from 'vue-router';

import {TokenService} from "./services/token.service";
import LoginComponent from "./system/views/auth/LoginComponent";
import RegisterComponent from "./system/views/auth/RegisterComponent";

import SystemRoutes from "./system/routes";
import WebRoutes from "./web/routes";

Vue.use(VueRouter);

const baseRoutes = [
    {
        path: '/login',
        name: 'login',
        component: LoginComponent,
    },
    {
        path: '/oauth/callback',
        name: 'socialite-login',
        component: LoginComponent
    },
    {
        path: '/register',
        name: 'register',
        component: RegisterComponent
    }
];

const routes = baseRoutes.concat(SystemRoutes, WebRoutes);

const router = new VueRouter({
    base: 'LaraSpa/public',
    routes,
    mode: 'history'
});

router.beforeEach((to, from, next) => {

    const requiresAuth = to.matched.some(record => record.meta.requiresAuth);

    const currentUser = !!TokenService.getToken();

    if (requiresAuth && !currentUser) {
        next('/login');
    } else if (to.path === '/login' && currentUser) {
        next('/');
    } else {
        next();
    }

});

export default router;
