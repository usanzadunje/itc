/**
 * Global store for user data
 */
import { reactive, computed } from "vue";

// Global State
const state = reactive({
    user: null,
});

export default function useUser() {
    // Mutations
    const setUser = (user) => {
        state.user = user;
    };

    // Actions
    //
    
    // Getters
    const authUser = computed(() => state.user);
    const loggedIn = computed(() => !!state.user);

    return {
        // Mutations
        setUser,

        // Getters
        authUser,
        loggedIn,
    };
}