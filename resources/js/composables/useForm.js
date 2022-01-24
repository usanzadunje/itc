import { reactive } from 'vue';
import { http }     from '@/services/api';

export function useForm(data) {

    let form = reactive({
        errors: {},
        hasErrors: false,
        data() {
            return Object
                .keys(data)
                .reduce((carry, key) => {
                    carry[key] = this[key];
                    return carry;
                }, {});
        },
        submit(method, url, options = {}) {
            const data = this.data();

            http[method](url, data, options)
                .then(response => {
                    console.log(response);
                })
                .catch(errors => {
                    this.hasErrors = true;
                    this.errors = errors;
                });
        },
        get(url, options) {
            this.submit('get', url, options);
        },
        post(url, options) {
            this.submit('post', url, options);
        },
        put(url, options) {
            this.submit('put', url, options);
        },
        patch(url, options) {
            this.submit('patch', url, options);
        },
        delete(url, options) {
            this.submit('delete', url, options);
        },

    });

    return form;
}