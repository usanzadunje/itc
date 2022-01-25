/**
 * Wrapper class for http requests.
 */

import { reactive } from "vue";
import { http }     from '@/services/api';

export default function useHttp(payloadData = {}) {
    // If payloadData is provided it will be automatically included in POST | PATCH request

    let httpClient = reactive({
        response: {},
        errors: {},
        data() {
            // Returns fresh data that could change since they were passed in function parameter payloadData
            // this reactive object will hold this new data if it has changed since then.
            return Object
                .keys(payloadData)
                .reduce((carry, key) => {
                    carry[key] = this[key];
                    return carry;
                }, {});
        },
        // Calls axios method depending on which one is provided.
        async request(method, url) {
            const payload = this.data();

            try {
                httpClient.response = await http[method](url, payload);
            }catch(errors) {
                httpClient.errors = errors;
            }
        },
        async get(url) {
            await this.request('get', url);
        },
        async post(url) {
            await this.request('post', url);
        },
        async patch(url) {
            await this.request('patch', url);
        },
        async delete(url) {
            await this.request('delete', url);
        },
        clearError(key) {
            delete this.errors[key];
        },
        clearErrors() {
            this.errors = {};
        },
    });

    return httpClient;
}
