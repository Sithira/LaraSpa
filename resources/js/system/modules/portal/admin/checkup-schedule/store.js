import ApiService from "../../../../../services/api.services";
import * as types from "./mutation-types";

const SUB_BASE_URL = "/api/v1/admin/schedules";

const state = {
  schedules: [],
  schedule: {}
};

const getters = {
    schedules: state => {
        return state.schedules;
    },

    schedule: state => {
        return state.schedule;
    }
};

const mutations = {

    [types.GET_ALL_CHECKUP_SCHEDULES] (state, data) {
        state.schedules = data.data;
    },

    [types.GET_A_CHECKUP_SCHEDULE] (state, data) {
        state.schedule = data.data;
    },

    [types.CREATE_CHECKUP_SCHEDULE] (state, data) {
        state.schedules.push(data.data);
    },

    [types.UPDATE_A_CHECKUP_SCHEDULE] (state, data) {
        state.schedule = data.data;
    },

    [types.DELETE_A_CHECKUP_SCHEDULE] (state) {
        state.schedule = {};
    },

};

const actions = {

    async all({commit}) {
        try {
            const response = await ApiService.get(SUB_BASE_URL);

            commit(types.GET_ALL_CHECKUP_SCHEDULES, response.data);
        } catch (e) {
            console.log(e)
        }
    },

    async get({commit}, id) {
        try {
            const response = await ApiService.get(SUB_BASE_URL + `/${id}`);

            commit(types.GET_A_CHECKUP_SCHEDULE, response.data);
        } catch (e) {
            console.log(e);
        }
    },

    async create({commit}, data) {
        try {
            const response = await ApiService.post(SUB_BASE_URL, data.data);

            commit(types.UPDATE_A_CHECKUP_SCHEDULE, response.data);
        } catch (e) {
            console.log(e);
        }
    },


    async update({commit}, data) {
        try {
            const response = await ApiService.patch(SUB_BASE_URL + `/${data.id}`, data.data);

            commit(types.UPDATE_A_CHECKUP_SCHEDULE, response.data);
        } catch (e) {
            console.log(e);
        }
    },

    async delete({commit}, id) {
        try {
            const response = await ApiService.delete(SUB_BASE_URL + `/${id}`);

            commit(types.UPDATE_A_CHECKUP_SCHEDULE, response.data);
        } catch (e) {
            console.log(e);
        }
    }

};

export const checkupschedules = {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
};
