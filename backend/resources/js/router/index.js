import { createRouter, createWebHistory } from 'vue-router'
import Dashboard from '../components/Dashboard.vue'

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/',
            name: 'home',
            component: Dashboard
        },
        // {
        //     path: '/about',
        //     name: 'about',
        //     // route level code-splitting
        //     // this generates a separate chunk (About.[hash].js) for this route
        //     // which is lazy-loaded when the route is visited.
        //     component: () => import('../views/AboutView.vue')
        // },
        // {
        //     path      : '/',
        //     name      : 'dashboard',
        //     component : () => import('../views/Dashboard.vue')
        // },
        {
            path      : '/history',
            name      : 'history',
            component : () => import('../components/History.vue'),
            meta      : {
                name  : "History Transaction"
            }
        },
        // {
        //     path      : '/balance',
        //     name      : 'balance',
        //     component : () => import('../components/Balance.vue'),
        //     meta      : {
        //         name  : "Your Balance"
        //     }
        // }
    ]
})

export default router
