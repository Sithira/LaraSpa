const state = {

    isRequestPending: false

};

const getters = {

    isRequestPending(state) {
        return state.isRequestPending;
    }

};

const mutations = {

    isRequestPending(state, status) {
        state.isRequestPending = status;
    }

};


const actions = {

    setRequestPendingStatus({commit}, status) {
        commit('isRequestPending', status);
    }

};

export const base = {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
};

