<script setup>
    import { RouterLink, RouterView } from 'vue-router'
    import Sidebars from './components/Sidebar.vue'
</script>

<template>
    <!-- <div class="d-flex flex-nowrap" v-show="$route.name!='Login'"> -->
    <div class="d-flex flex-nowrap" v-if="$route.name!='login'">
        <Sidebars />
        <main class="col" style="margin-left: 280px">
            <router-view></router-view>
        </main>
    </div>
    <div class="d-flex flex-nowrap" v-else>
        <main class="col">
            <router-view></router-view>
        </main>
    </div>
</template>
<script>
    import axios from "axios"
    import { EMPTY_ARR } from '@vue/shared'
    import { mapActions } from 'pinia'
    import { useBankStore } from './store'


    export default {
        data(){
            return {
                url : window.location.origin,
            }
        },
        created(){
            // if (localStorage.token=='undefined' || localStorage.token==null) {
            if (useBankStore().token=='undefined' || useBankStore().token==null) {
                this.$router.push({ name: 'login' });
            }else{
                axios
                .get(`${this.url}/api/me`, {
                    headers:{
                        Authorization: 'Bearer '+localStorage.token
                    }
                })
                .then(response =>{
                    localStorage.user_id        = response.data.id
                    localStorage.profileName    = response.data.name
                    localStorage.role           = response.data.role
                    this.saveProfileName(response.data.name, response.data.role)
                    // useBankStore().dispatch('profileName', response.data.name)
                    // this.$store.dispatch('setLevel', response.data.role)
                    // this.$store.dispatch('setLoading', false)
                })
                // .catch(function (error) {
                //     if (error.response.status==401) {
                //         localStorage.removeItem('token')
                //         // await this.$router.push({ name: 'login' })
                //         // console.log($router)
                //     }
                //     // console.log(error.response.data);
                //     // console.log(error.response.status);
                //     // console.log(error.response.headers);
                // })

                axios.interceptors.response.use(undefined, err => {
                    if (err.response.status === 401 ) {
                        this.$router.push({ name: 'login' })
                    }

                    // You may not want to return this in the 401 case
                    return Promise.reject(err)
                });
            }
        },
        methods:{
            ...mapActions(useBankStore, ['saveProfileName'])
        }
    }
</script>