/**
 * Global store for user data
 */
import { reactive, computed } from "vue";
import { useRouter }          from 'vue-router';

import useHttp from '@/composables/useHttp';

// Global State
const state = reactive({
    user: null,
});

export default function useUser() {
    const router = useRouter();

    // Mutations
    const setUser = (user) => {
        state.user = user;
    };

    // Actions
    const getAuthUser = async() => {
        const response = await useHttp().get('/api/auth/user');

        setUser(response);
    };
    const logout = async() => {
        await useHttp().post('/logout');

        setUser(null);

        await router.replace({ name: 'login' });
    };

    // Getters
    const authUser = computed(() => state.user);
    const loggedIn = computed(() => !!state.user);

    return {
        // Mutations
        setUser,

        // Action
        getAuthUser,
        logout,

        // Getters
        authUser,
        loggedIn,
    };
}