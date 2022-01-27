import axios  from "axios";
import router from '@/router';

// Creating axios instance
export const http = axios.create({
    baseURL: import.meta.env.VITE_VUE_APP_URL,
    withCredentials: true,
});

/*
    Add a response interceptors
*/
// Interceptor which will activate if request was successful 2xx codes
const onFulfilled = async(response) => {
    const responseData = response.data;

    // Checking if backend tried to redirect user
    // then redirect user to that route on frontend
    if(responseData.redirect) {
        await router.push({ name: responseData.redirect });
    }
    return responseData;
};
// Interceptor which will activate if request was not successful !2xx codes
const onRejected = async(error) => {
    const response = error.response;

    // If there is error response handle it according to which error server responded with.
    if(response) {
        renderErrorPage(response);
        await cleanValidationErrors(response);
        await regenerateCSRF(response);
    }

    return Promise.reject(error);
};

/**
 * Unauthenticated | Forbidden (Unauthorized) | Too many attempts
 * just throw alert with status code and message
 * Refactor to navigate to error page.
 */
const renderErrorPage = (response) => {
    if([401, 403, 429].includes(response.status)) {
        // '/api/auth/user' route is for fetching authenticated user so we do not want to
        // show any errors for this route because it is just checking whether there is an user
        // and it triggers on every page load (App.vue setup hook)
        if(response.config.url === '/api/auth/user') {
            return;
        }

        alert(`${response.status} | ${response.data.message}`);
        return;
    }
};
/**
 * Validation errors
 * Return only key (field name) => value (error message) pairs
 * clearing response from axios
 */
const cleanValidationErrors = (response) => {
    if(response.status == 422) {

        return Promise.reject(response.data?.errors);
    }
};
/**
 * CSRF token mismatch
 */
const regenerateCSRF = async(response) => {
    if(response.status == 419) {
        // Regenerate csrf token
        await http.get('/sanctum/csrf-cookie');

        // Do same request again
        return http(response.config);
    }
};

http.interceptors.response.use(onFulfilled, onRejected);

