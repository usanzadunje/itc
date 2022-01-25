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
        return response;
    },
    function(error) {
        if(
            error.response &&
            [401, 419].includes(error.response.status)
        ) {
            console.log('Session expired. Login.');
        }

        return Promise.reject(error);
    },
);