import { reactive } from "vue";
import { http }     from '@/services/api';

export default function useHttp(payloadData = {}) {
    let httpClient = reactive({
        response: {},
        errors: {},
        data() {
            return Object
                .keys(payloadData)
                .reduce((carry, key) => {
                    carry[key] = this[key];
                    return carry;
                }, {});
        },
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
    });

    return httpClient;
}
