import { createRouter, createWebHistory } from 'vue-router'
import User from '../views/User.vue'

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/about',
            name: 'about',
            // route level code-splitting
            // this generates a separate chunk (About.[hash].js) for this route
            // which is lazy-loaded when the route is visited.
            component: () => import('../views/AboutView.vue')
        },
        {
            path      : '/',
            name      : 'dashboard',
            component : () => import('../views/Dashboard.vue')
        },
        {
            path      : '/history',
            name      : 'history',
            component : () => import('../components/History.vue'),
            meta      : {
                name  : "History Transaction"
            }
        },
        {
            path      : '/balance',
            name      : 'balance',
            component : () => import('../components/Balance.vue'),
            meta      : {
                name  : "Your Balance"
            }
        },
        {
            path      : '/login',
            name      : 'login',
            component : () => import('../components/user/Login.vue'),
            meta      : {
                name  : "Login Page"
            }
        },
        {
            path      : '/profile',
            component : User,
            children  : [
                {
                    path : '',
                    name : 'profile',
                    component : () => import('../components/user/Profile.vue'),
                    meta      : {
                        name  : "Profile Page"
                    }
                },
                {
                    path : 'change-password',
                    name : 'change-password',
                    component : () => import('../components/user/Password.vue'),
                    meta      : {
                        name  : "Change Password"
                    }
                }
            ]
        }
    ]
})

export default router
