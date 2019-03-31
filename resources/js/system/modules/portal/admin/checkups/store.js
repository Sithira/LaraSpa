import * as types from "./mutation-types";
import ApiService from "../../../../../services/api.services";

const SUB_BASE_URL = "/api/v1/admin/checkups";

export const state = {
    checkups: [],

    checkup: {},
};

export const getters = {

    checkups: state => {
        return state.checkups;
    },

    checkup: state => {
        return state.checkup;
    }

};

export const mutations = {

    [types.GET_ALL_CHECKUPS] (state, data) {
        state.checkups = data.data;
    },

    [types.GET_A_CHECKUP] (state, data) {
        state.checkup = data.data;
    },

    [types.CREATE_A_CHECKUP] (state, data) {
        state.checkups.push(data.data);
    },

    [types.UPDATE_A_CHECKUP] (state, data) {
        state.checkup = data.data;
    },

    [types.DELETE_A_CHECKUP] (state) {
        state.checkup = null;
    }

};

export const actions = {

    async all({commit}) {
        const response = await ApiService.get(SUB_BASE_URL);

        commit(types.GET_ALL_CHECKUPS, response.data);
    },

    async get({commit}, id) {
        const response = await ApiService.get(SUB_BASE_URL + `/${id}`);

        commit(types.GET_A_CHECKUP, response.data);
    },

    async store({commit}, data) {

        try {
            const response = ApiService.post(SUB_BASE_URL, data);

            commit(types.CREATE_A_CHECKUP, response.data);
        } catch (e) {
            console.log(e)
        }
    },

    async update({commit}, data) {
        try {
            const response = await ApiService.patch(SUB_BASE_URL + `/${data.id}`, data.data);

            commit(types.UPDATE_A_CHECKUP, response.data);
        } catch (e) {
            console.log(e)
        }
    },

    async delete({commit}, data) {
        await ApiService.delete(SUB_BASE_URL + `/${id}`);

        commit(types.DELETE_A_CHECKUP)
    }

};

export const checkups = {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
};
