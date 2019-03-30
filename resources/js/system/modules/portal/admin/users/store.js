import ApiService from "../../../../../services/api.services";

import * as types from "./mutation-types";

const SUB_BASE_URL = "/api/v1/admin/users";

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

    [types.GET_ALL_USERS] (state, data) {
        state.response = state.users = [];
        state.response = data;
        state.users = data.data;
    },

    [types.GET_A_USER] (state, data) {
        state.user = data.data;
    },

    [types.UPDATE_USER] (state, data) {
        state.user = data.data;
    }

};

const actions = {

    async all({commit}) {

        try {
            const response = await ApiService.get(SUB_BASE_URL);

            commit(types.GET_ALL_USERS, response.data);
        } catch (e) {
            console.error(e);
        }

    },

    async get({commit}, id) {
        try {
            const response = await ApiService.get(SUB_BASE_URL + `/${id}`);

            commit(types.GET_A_USER, response.data)
        } catch (e) {
            console.error(e)
        }
    },

    async update({commit}, data) {

        try {
            const response = await ApiService.patch(SUB_BASE_URL + `/${data.id}`, data);

            commit(types.UPDATE_USER, response.data);
        } catch (e) {
            console.error(e);
        }
    },

    async delete({commit}, data) {
        // to do:
    }

};

export const users = {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
};
