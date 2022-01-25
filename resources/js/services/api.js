import axios from "axios";


// Creating axios instance for routes that are api protected
export const http = axios.create({
    baseURL: import.meta.env.VITE_VUE_APP_URL,
    withCredentials: true,
});

/*
    Add a response interceptor to handle errors
*/
http.interceptors.response.use(
    (response) => {
        return response.data;
    },
    function(error) {
        const response = error.response;
        if(
            response &&
            [401, 403, 419, 429].includes(response.status)
        ) {
            alert(response.data.message);
            return Promise.reject({
                message: response.data.message,
                status: response.status,
            });
        }else if(
            response &&
            [422].includes(response.status)
        ) {
            return Promise.reject(response.data?.errors);
        }

        return Promise.reject(error);
    },
);