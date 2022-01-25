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
        // For Unauthenticated | Forbidden (Unauthorized) | CSRF (Session) Expired | Too many attempts
        // just throw alert with status code and message
        // Refactor to navigate to error page.
        if(
            response &&
            [401, 403, 419, 429].includes(response.status)
        ) {
            // '/api/auth/user' route is for fetching authenticated user so we do not want to
            // show any errors for this route because it is just checking whether there is an user
            // and it triggers on every page load (App.vue setup hook)
            if(error.response.config.url === '/api/auth/user') {
                return;
            }

            alert(`${response.status} | ${response.data.message}`);
            return;
        }else if(
            response &&
            [422].includes(response.status)
        ) {
            // Validation errors
            // Return only key (field name) => value (error message) pairs
            // clearing response from axios
            return Promise.reject(response.data?.errors);
        }

        return Promise.reject(error);
    },
);