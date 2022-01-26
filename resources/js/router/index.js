import { createRouter, createWebHistory } from 'vue-router';

import useUser                 from '@/composables/useUser';

/* Middlewares */
import middlewarePipeline      from "./middlewarePipeline";
import redirectIfAuthenticated from '@/middlewares/redirectIfAuthenticated';
import auth                    from '@/middlewares/auth';

/* Layouts */
import Layout                  from '@/components/Layout.vue';

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
    /* =============================================
                End unprotected
    ============================================= */

    /* =============================================
                Start authentication routes
    ============================================= */
    {
        path: "/login",
        name: "login",
        meta: {
            middleware: [redirectIfAuthenticated],
        },
        component: () => import( "@/views/auth/Login.vue"),
    },
    {
        path: "/register",
        name: "register",
        meta: {
            middleware: [redirectIfAuthenticated],
        },
        component: () => import( "@/views/auth/Register.vue"),
    },
    /* =============================================
                End authentication routes
    ============================================= */
    /* =============================================
                Start protected routes
    ============================================= */
    {
        path: "/test",
        name: "test",
        meta: {
            middleware: [auth],
        },
        component: () => import( "@/views/Test.vue"),
    },
    {
        path: '/project',
        component: Layout,
        meta: { middleware: [auth] },
        children: [
            {
                path: "",
                name: "project.index",
                component: () => import( "@/views/project/Index.vue"),
            },
            {
                path: "create",
                name: "project.create",
                component: () => import( "@/views/project/Create.vue"),
            },
            {
                path: ":project",
                name: "project.show",
                component: () => import( "@/views/project/Show.vue"),
            },
        ],
    },

    /* =============================================
                End protected routes
    ============================================= */
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

// Navigation guard responsible for calling middlewares before each route gets resolved
router.beforeEach((to, from, next) => {
    let middleware = to.meta?.middleware;

    const { loggedIn } = useUser();

    if(to.matched?.length > 1) {
        middleware = [
            ...middleware,
            ...to.matched[0]?.meta?.middleware,
        ];
    }

    // Context sent to middlewares and pipline
    const context = { to, from, next, loggedIn: loggedIn.value, router };

    // If no middlewares just proceed to the route
    if(!middleware) {
        return next();
    }

    // Call 1st middleware and provide make next pipeline call
    middleware[0]({
        ...context,
        next: middlewarePipeline(context, middleware, 1),
    });
});

export default router;