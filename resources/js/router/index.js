import { createRouter, createWebHistory } from 'vue-router';

const routes = [
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