import {AuthenticationError, AuthService} from '../../services/auth.service'
import {TokenService} from '../../services/token.service'

const state = {
    authenticating: false,
    accessToken: TokenService.getToken(),
    refreshToken: TokenService.getRefreshToken(),
    currentUser: TokenService.getUserObject(),
    authenticationErrorCode: 0,
    authenticationError: '',
    refreshTokenPromise: null
};

const getters = {

    loggedIn: (state) => {
        return !!state.accessToken
    },

    authenticationErrorCode: (state) => {
        return state.authenticationErrorCode
    },

    authenticationError: (state) => {
        return state.authenticationError
    },

    authenticating: (state) => {
        return state.authenticating
    },

    currentUser: state => {
        return state.currentUser;
    }
};

const mutations = {
    loginRequest(state) {
        state.authenticating = true;
        state.authenticationError = '';
        state.authenticationErrorCode = 0
    },

    loginSuccess(state, accessToken) {
        state.accessToken = accessToken;
        state.authenticating = false;
    },

    loginError(state, {errorCode, errorMessage}) {
        state.authenticating = false;
        state.authenticationErrorCode = errorCode;
        state.authenticationError = errorMessage
    },

    logoutSuccess(state) {
        state.accessToken = null;
        state.refreshToken = null;
        state.currentUser = null;
        state.refreshTokenPromise = null;
    },

    refreshTokenPromise(state, promise) {
        state.refreshTokenPromise = promise
    },

    saveUser(state, o) {
        state.currentUser = o;
    }
};

const actions = {

    async login({commit}, credentials) {

        commit('loginRequest');

        try {

            const token = await AuthService.login(credentials);

            commit('loginSuccess', token);
            return true;
        } catch (e) {
            if (e instanceof AuthenticationError) {
                commit('loginError', {errorCode: e.errorCode, errorMessage: e.message})
            }

            return false
        }
    },

    async socialiteLogin({commit}, data) {

        const token = await AuthService.socialiteLogin(data);

        commit('loginSuccess', token);
    },

    saveUser({commit}, o) {
        commit('saveUser',o);
    },

    logout({commit}) {

        AuthService.logout();

        commit('logoutSuccess');
    },

    async refreshToken({commit, state}) {

        console.log('RefreshToken', 'CALLED !');

        // If this is the first time the refreshToken has been called, make a request
        // otherwise return the same promise to the caller
        if (!state.refreshTokenPromise) {

            const token = AuthService.refreshToken();

            commit('refreshTokenPromise', token);

            // Wait for the UserService.refreshToken() to resolve. On success set the token and clear promise
            // Clear the promise on error as well.
            token.then(response => {
                    commit('refreshTokenPromise', null)
                    commit('loginSuccess', response)
                },
                error => {
                    commit('refreshTokenPromise', null)
                }
            )
        }

        return state.refreshTokenPromise
    }
};

export const auth = {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};
