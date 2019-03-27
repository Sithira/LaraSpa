import axios from 'axios';
import swal from 'sweetalert';
import router from '../router';
import store from '../system/store';
import {TokenService} from "../services/token.service";


/*=================================
 * Response Interceptors
 *=================================
 */

axios.interceptors.response.use(response => {

    store.dispatch('base/setRequestPendingStatus', false);

    return response;
}, error => {

    store.dispatch('base/setRequestPendingStatus', false);

    const {status, data: {message}} = error.response;

    if (status >= 400) {

        swal({
            icon: 'error',
            title: `${status}`,
            text: message || 'An error response occurred while requesting data from server.'
        }).then(() => {

            //router.go(-1);
        });

        return Promise.reject(error);
    }

});

/*=================================
 *  Request interceptors
 *=================================
 */
axios.interceptors.request.use(function (request) {

    store.dispatch('base/setRequestPendingStatus', true);

    const token = TokenService.getToken();

    if (token !== null) {
        request.headers.Authorization = `Bearer ${token}`;
    }

    return request;
}, function (err) {
    return Promise.reject(err);
});

