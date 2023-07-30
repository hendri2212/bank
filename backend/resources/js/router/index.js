import { createRouter, createWebHistory } from 'vue-router'
import Dashboard from '../components/Dashboard.vue'
// import { useBankStore } from '../store'

const router = createRouter({
    // base: 'localhost:8000',
    // history: createWebHistory(import.meta.env.BASE_URL),
    history: createWebHistory(''),
    routes: [
        {
            path        : '/',
            name        : 'dashboard',
            component   : Dashboard,
            meta        : {
                name    : 'Dashboard Page'
            }
        },
        {
            path        : '/login',
            name        : 'login',
            component   : () => import('../components/user/Login.vue'),
        },
        {
            path        : '/employee',
            component   : () => import('../views/Employee.vue'),
            children    : [
                {
                    path        : '',
                    name        : 'employee',
                    component   : () => import('../components/user/Data.vue'),
                    meta        : {
                        name    : "Employee Page",
                        role    : "superadmin" || "manager"
                    },
                },
                {
                    path        : 'add',
                    name        : 'new_employee',
                    component   : () => import('../components/user/Add.vue'),
                    meta        : {
                        name    : "Add New Employee",
                        role    : "superadmin" || "manager"
                    }
                },
                {
                    path        : 'edit/:id',
                    name        : 'edit_employee',
                    component   : () => import('../components/user/Edit.vue'),
                    meta        : {
                        name    : "Edit Employee",
                        role    : "superadmin" || "manager"
                    }
                }
            ]
        },
        {
            path        : '/transaction',
            name        : 'transaction',
            component   : () => import('../components/transaction/Transaction.vue'),
            meta        : {
                name    : "Create Transaction"
            }
        },
        {
            path        : '/history',
            component   : () => import('../views/History.vue'),
            children    : [
                {
                    path        : '',
                    component   : () => import('../components/transaction/History.vue'),
                    name        : 'history',
                    meta        : {
                        name    : "History Transaction"
                    }
                },
                {
                    path        : 'detail/:id',
                    name        : 'detail',
                    component   : () => import('../components/transaction/Detail.vue'),
                    meta        : {
                        name    : "Details Transacation"
                    }
                },
                {
                    path        : 'edit/:id',
                    name        : 'edit',
                    component   : () => import('../components/transaction/Edit.vue'),
                    meta        : {
                        name    : "Edit Transaction"
                    }
                }
            ]
        },
        {
            path        : '/customer',
            component   : () => import('../views/Customer.vue'),
            children    : [
                {
                    path        : '',
                    name        : 'customer',
                    component   : () => import('../components/customer/Data.vue'),
                    meta        : {
                        name    : "Data Customer"
                    }
                },
                {
                    path        : 'new_customer',
                    name        : 'new_customer',
                    component   : () => import('../components/customer/New_Customer.vue'),
                    meta        : {
                        name    : "Add New Customers"
                    }
                }
            ]
        }
    ]
})

router.beforeEach((to, from, next) => {
    if(to.matched.some(record => record.meta.role)) {
        // console.log(store.state.role)
        // console.log(useBankStore().token)
        // if(store.state.level=='admin'){
        if(localStorage.role=='superadmin' || localStorage.role=='manager'){
            next()
            return
        }
        router.push({ name: "dashboard" })
        return
    }
    next() 
})

export default router
