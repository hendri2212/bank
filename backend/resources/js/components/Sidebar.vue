<template>
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="bootstrap" viewBox="0 0 118 94">
            <title>Bootstrap</title>
            <path fill-rule="evenodd" clip-rule="evenodd" d="M24.509 0c-6.733 0-11.715 5.893-11.492 12.284.214 6.14-.064 14.092-2.066 20.577C8.943 39.365 5.547 43.485 0 44.014v5.972c5.547.529 8.943 4.649 10.951 11.153 2.002 6.485 2.28 14.437 2.066 20.577C12.794 88.106 17.776 94 24.51 94H93.5c6.733 0 11.714-5.893 11.491-12.284-.214-6.14.064-14.092 2.066-20.577 2.009-6.504 5.396-10.624 10.943-11.153v-5.972c-5.547-.529-8.934-4.649-10.943-11.153-2.002-6.484-2.28-14.437-2.066-20.577C105.214 5.894 100.233 0 93.5 0H24.508zM80 57.863C80 66.663 73.436 72 62.543 72H44a2 2 0 01-2-2V24a2 2 0 012-2h18.437c9.083 0 15.044 4.92 15.044 12.474 0 5.302-4.01 10.049-9.119 10.88v.277C75.317 46.394 80 51.21 80 57.863zM60.521 28.34H49.948v14.934h8.905c6.884 0 10.68-2.772 10.68-7.727 0-4.643-3.264-7.207-9.012-7.207zM49.948 49.2v16.458H60.91c7.167 0 10.964-2.876 10.964-8.281 0-5.406-3.903-8.178-11.425-8.178H49.948z"></path>
        </symbol>
    </svg>
    <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 280px; height: 100%; position: fixed;">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <svg class="bi pe-none me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
            <span class="fs-4">Bank Skawan</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <!-- <li class="nav-item">
                <a href="#" class="nav-link active" aria-current="page">
                    <i class="bi bi-house-door me-2" width="16" height="16"></i>
                    Home
                </a>
            </li> -->
            <li>
                <router-link to="/" class="nav-link text-white">
                    <i class="bi bi-speedometer2 me-2" width="16" height="16"></i>
                    Dashboard
                </router-link>
            </li>
            <li>
                <router-link :to="{ name: 'transaction' }" class="nav-link text-white">
                    <i class="bi bi-arrow-down-up me-2" width="16" height="16"></i>
                    Transaction
                </router-link>
            </li>
            <li>
                <router-link :to="{ name: 'history' }" class="nav-link text-white">
                    <i class="bi bi-clock-history me-2" width="16" height="16"></i>
                    Data History
                </router-link>
            </li>
            <li>
                <router-link :to="{ name: 'customer' }" class="nav-link text-white">
                    <i class="bi bi-people me-2" width="16" height="16"></i>
                    Customers
                </router-link>
            </li>
            <li v-if="role=='superadmin' || role=='manager'">
            <!-- <li> -->
                <router-link :to="{ name: 'employee' }" class="nav-link text-white">
                    <i class="bi bi-cup-hot me-2" width="16" height="16"></i>
                    Employee
                </router-link>
            </li>
        </ul>
        <hr>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                <strong>{{ this.profileName }}</strong>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                <li><a class="dropdown-item" href="#">New project...</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#" @click="logout">Sign out</a></li>
            </ul>
        </div>
    </div>
    <!-- <div class="b-example-divider b-example-vr"></div> -->
</template>
<script>
    import axios from "axios"
    import { mapState } from "pinia"
    import { useBankStore } from '../store'
    
    export default{
        data(){
            return{
                // role        : localStorage.role,
                url         : window.location.origin,
            }
        },
        computed: {
            ...mapState(useBankStore, ['profileName', 'role'])
        },
        methods:{
            logout(){
                axios
                .delete(`${this.url}/api/user/${localStorage.user_id}`,{
                    headers:{
                        Authorization: 'Bearer '+localStorage.token
                    }
                })
                .then(response => {
                    // this.member = response.data
                    // localStorage.clear()
                    this.$router.push({ name: 'login' })
                })
            }
        }
    }
</script>