import { reactive } from "vue";
import { http }     from '@/services/api';

export default function useHttp(data) {
    const form = reactive({
        response: null,
        errors: null,
        submit: async(method, url) => {
            try {
                const response = await http[method](url, data);
                console.log(response);
            }catch(error) {
                console.log(error);
            }
        },
    });

    return form;
}
