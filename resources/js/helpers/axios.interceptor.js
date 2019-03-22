import axios from 'axios';
import swal from 'sweetalert';
import router from './../router'
import {TokenService} from "../services/token.service";


/*=================================
 * Response Interceptors
 *=================================
 */

axios.interceptors.response.use(response => response, error => {

    const {status, data: {message}} = error.response;

    if (status >= 400) {

        swal({
            icon: 'error',
            title: `${status}`,
            text: message || 'An error response occurred while requesting data from server.'
        }).then(() => {

            router.go(-1);
        });

        return Promise.reject(error);
    }

});

/*=================================
 *  Request interceptors
 *=================================
 */
axios.interceptors.request.use(function (request) {

    const token = TokenService.getToken();

    if (token !== null) {
        request.headers.Authorization = `Bearer ${token}`;
    }

    return request;
}, function (err) {
    return Promise.reject(err);
});

