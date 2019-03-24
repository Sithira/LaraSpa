import Vue from 'vue'
import VueRouter from 'vue-router';

import {TokenService} from "./services/token.service";
import WelcomeComponent from "./components/pages/WelcomeComponent";
import LoginComponent from "./components/pages/Auth/LoginComponent";
import RegisterComponent from "./components/pages/Auth/RegisterComponent";
import UsersComponent from "./components/pages/users/UsersComponent";
import UserComponent from "./components/pages/users/UserComponent";
import UserIndexComponent from "./components/pages/users/UserIndexComponent";
import DashboardComponent from "./components/pages/DashboardComponent";

Vue.use(VueRouter);

const routes = [
    {
        path: '/',
        name: 'welcome',
        component: WelcomeComponent
    },
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
    },
    {
        path: '/dashboard',
        name: 'dashboard',
        component: DashboardComponent,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/users',
        component: UserIndexComponent,
        children: [
            {
                path: '',
                name: 'users',
                component: UsersComponent
            },
            {
                path: ':id',
                name: 'user',
                component: UserComponent
            }
        ],
        meta: {
            requiresAuth: true
        }
    }
];


const router = new VueRouter({
    base: 'laravel-socialite-passport-boilerplate/public',
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
