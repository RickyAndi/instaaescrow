import HttpError from '../exceptions/http-error';
import {
    HttpAuthenticationError,
    HttpAuthorizationError,
    HttpValidationError,
    HttpServerError,
    HttpConnectionError,
    HttpRequestError,
    HttpNotFoundError
} from '../exceptions/index';


export default class HttpService {
    constructor(axios, options) {
        this.axios = axios;
        this.options = options;

        this.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        this.axios.defaults.headers.common['X-CSRF-TOKEN'] = this.options['csrfToken'];
    }
    
    async get(url, options) {
        try {
            return await this.axios.get(url, options);
        } catch (error) {
            this._parseError(error);
        }
    }

    async post(url, data, options) {
        try {
            return await this.axios.post(url, data, options);
        } catch (error) {
            this._parseError(error);
        }
    }

    _parseError(error) {
        if (error.response) {
            const response = error.response;

            if (response.status >= 400 && response.status < 500) {
                if (response.status === 401) {
                    throw new HttpAuthenticationError('not authenticated');
                }
                
                if (response.status === 403) {
                    throw new HttpAuthorizationError(JSON.stringify(response.data));
                }

                if (response.status === 404) {
                    throw new HttpNotFoundError(JSON.stringify(response.data));
                }

                if (response.status === 422) {
                    throw new HttpValidationError(JSON.stringify(response.data));
                }
                
                throw new HttpRequestError(JSON.stringify(response.data));
            }

            if (response.status >= 500) {
                throw new HttpServerError(JSON.stringify(response.data));
            }

            throw new HttpError(JSON.stringify(response.data));
        } else {
            throw new HttpConnectionError('Connection error')
        }
    }
}