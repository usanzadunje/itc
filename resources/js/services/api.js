import axios from "axios";

// Creating axios instance for routes that are api protected
export const http = axios.create({
    baseURL: "localhost:3000",
});

/*
    Add a response interceptor to handle errors
*/
http.interceptors.response.use(
    (response) => {
        return response;
    },
    function(error) {
        return Promise.reject(error);
    },
);