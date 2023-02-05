import { createRouter, createWebHistory } from 'vue-router'
import Dashboard from '../components/Dashboard.vue'

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path        : '/',
            name        : 'dashboard',
            component   : Dashboard,
            meta        : {
                name    : 'Dashboard Page'
            }
        },
        // {
        //     path: '/about',
        //     name: 'about',
        //     // route level code-splitting
        //     // this generates a separate chunk (About.[hash].js) for this route
        //     // which is lazy-loaded when the route is visited.
        //     component: () => import('../views/AboutView.vue')
        // },
        {
            path        : '/transaksi',
            name        : 'transaction',
            component   : () => import('../components/Transaction.vue'),
            meta        : {
                name    : "Create Transaction"
            }
        },
        {
            path        : '/history',
            name        : 'history',
            component   : () => import('../components/History.vue'),
            meta        : {
                name    : "History Transaction"
            }
        },
        {
            path        : '/customer',
            name        : 'customer',
            component   : () => import('../components/Customer.vue'),
            meta        : {
                name    : "Data Customers"
            }
        }
    ]
})

export default router
