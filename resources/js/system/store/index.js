import Vue from 'vue';
import Vuex from 'vuex';

import {auth} from './modules/auth.store'
import {users} from '../modules/portal/admin/users/store'
import {checkups} from '../modules/portal/admin/checkups/store'
import {base} from './modules/base.store'

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        base,
        auth,
        users,
        checkups
    }
});

