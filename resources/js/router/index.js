import { createRouter, createWebHistory } from 'vue-router';

const routes = [
    /* =============================================
                Start authentication routes
    ============================================= */
    {
        path: "/login",
        name: "login",
        component: () => import( "@/views/auth/Login.vue"),
    },
    {
        path: "/register",
        name: "register",
        component: () => import( "@/views/auth/Register.vue"),
    },
    {
        path: "/test",
        name: "test",
        component: () => import( "@/views/Test.vue"),
    },
    /* =============================================
                End authentication routes
    ============================================= */
    /* =============================================
                    Start unprotected
    ============================================= */
    {
        path: "/",
        name: "welcome",
        component: () => import( "@/views/Welcome.vue"),
    },

    {
        /* Responsible for handling routes that do not exist */
        path: "/:catchAll(.*)",
        redirect: { name: 'welcome' },
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});
export default router;