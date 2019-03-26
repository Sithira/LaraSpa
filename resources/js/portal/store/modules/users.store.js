import ApiService from "../../services/api.services";

const state = {
    response: [],
    users: [],
    user: {},
};

const getters = {

    users: state => {
        return state.users;
    },

    user: state => {
        return state.user;
    }

};

const mutations = {

    all(state, data) {
        state.response = state.users = [];
        state.response = data;
        state.users = data.data;
    },

    get(state, data) {
        state.user = data.data;
    },

    update(state, data) {
        state.user = data.data;
    }

};

const actions = {

    async all({commit}) {

        try {
            const response = await ApiService.get('/api/v1/users');

            commit('all', response.data);
        } catch (e) {
            console.error(e);
        }

    },

    async get({commit}, id) {
        try {
            const response = await ApiService.get(`/api/v1/users/${id}`);

            commit('get', response.data)
        } catch (e) {
            console.error(e)
        }
    },

    async update({commit}, data) {

        try {
            const response = await ApiService.patch(`/api/v1/users/${data.id}`, data);

            commit('update', response.data);
        } catch (e) {
            console.error(e);
        }
    }

};

export const users = {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
};
