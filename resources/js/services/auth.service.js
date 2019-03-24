import ApiService from './api.services'
import {TokenService} from './token.service'

import store from './../store';


class AuthenticationError extends Error {
    constructor(errorCode, message) {
        super(message)
        this.name = this.constructor.name
        this.message = message
        this.errorCode = errorCode
    }
}

const AuthService = {

    /**
     * Login the user and store the access token to TokenService.
     *
     * @returns access_token
     * @throws AuthenticationError
     **/
    async login(credentials) {

        const requestData = {
            method: 'post',
            url: "/oauth/token",
            data: {
                grant_type: 'password',
                username: credentials.username,
                password: credentials.password,
                client_id: 2,
                client_secret: 'DYyKJzcPSmDAlBqP0Ijm7F49Ktv5m5bttF2v7xnr'
            }
        };

        try {

            const response = await ApiService.customRequest(requestData);

            TokenService.saveToken(response.data.access_token);

            TokenService.saveRefreshToken(response.data.refresh_token);

            ApiService.setHeader();

            ApiService.mount401Interceptor();

            await AuthService.getLoggedInUser();

            return response.data.access_token;

        } catch (error) {
            throw new AuthenticationError(error.response.status, error.response.data.message)
        }
    },

    async socialiteLogin(data) {

        TokenService.saveToken(data.access_token);

        TokenService.saveRefreshToken(data.refresh_token);

        ApiService.setHeader();

        ApiService.mount401Interceptor();

        await AuthService.getLoggedInUser();

        return data.access_token;
    },

    async register() {

    },

    /**
     * Get the logged in user.
     *
     * @returns {Promise<*>}
     */
    async getLoggedInUser() {

        try {

            const user = await ApiService.get('/api/user');

            TokenService.saveUserObject(user.data);

            store.dispatch('auth/saveUser', user.data);

            return user.data;
        } catch (error) {
            throw new AuthenticationError(error.response.status, error.response.data.message)
        }

    },

    /**
     * Refresh the access token.
     **/
    async refreshToken() {

        const refreshToken = TokenService.getRefreshToken();

        const requestData = {
            method: 'post',
            url: "/oauth/token",
            data: {
                grant_type: 'refresh_token',
                refresh_token: refreshToken,
                client_id: 2,
                client_secret: 'DYyKJzcPSmDAlBqP0Ijm7F49Ktv5m5bttF2v7xnr'
            }
        };

        try {
            const response = await ApiService.customRequest(requestData);

            TokenService.saveToken(response.data.access_token);
            TokenService.saveRefreshToken(response.data.refresh_token);

            // Update the header in ApiService
            ApiService.setHeader();

            return response.data.access_token;

        } catch (error) {
            throw new AuthenticationError(error.response.status, error.response.data.detail)
        }

    },

    /**
     * Logout the current user by removing the token from storage.
     *
     * Will also remove `Authorization Bearer <token>` header from future requests.
     **/
    logout() {
        // Remove the token and remove Authorization header from Api Service as well
        TokenService.removeToken();

        TokenService.removeUserObject();

        TokenService.removeRefreshToken();

        //
        ApiService.removeHeader();

        // NOTE: Again, we'll cover the 401 Interceptor a bit later.
        ApiService.unmount401Interceptor()
    }
};

export { AuthenticationError, AuthService };
