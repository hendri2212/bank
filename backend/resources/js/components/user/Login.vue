<template>
    <div class="text-center">
        <form class="form-signin" @submit.prevent="login">
            <img class="mb-4" src="https://smkn1kotabaru.sch.id/media_library/images/c6ab60e235b679b8b7f9ac1743593c59.png">
            
            <h2 class="font-weight-bold">Bank Saijaan</h2>
            <h6 class="font-weight-bold text-dark mb-4">SMK CERDAS (CERMAT TERAMPIL DISIPLIN IKHLAS)</h6>
            
            <label for="user_name" class="visually-hidden">Email Address</label>
            <input autofocus autocomplete="off" type="text" id="user_name" v-model="email" placeholder="Username..." class="form-control form-control-lg rounded-0 border border-secondary border-bottom-0">
            
            <label for="user_password" class="visually-hidden">Password</label>
            <input type="password" id="user_password" v-model="password" placeholder="Password..." class="form-control form-control-lg rounded-0 border border-secondary">
            
            <div class="d-grid">
                <!-- <button onclick="login(); return false;" class="btn btn-lg btn-primary btn-block rounded-0" id="submit">Sign in</button> -->
                <button type="submit" class="btn btn-lg btn-primary rounded-0">Sign in</button>
            </div>
            
            <!-- <p class="pt-3 text-muted">
                <a href="https://smkn1kotabaru.sch.id/lost-password">Lost Password ?</a> | Back to <a href="https://smkn1kotabaru.sch.id/">SMKN 1 Kotabaru</a>
            </p> -->
        </form>
    </div>
</template>
<style>
    .form-signin {
        max-width: 550px;
        margin: auto;
        padding-top: 10%;
    }
</style>
<script>
    import axios from "axios"

    export default {
        data(){
            return {
                url         : window.location.origin,
                email       : '',
                password    : ''
            }  
        },
        methods: {
            login() {
                var data = {
                    email       : this.email,
                    password    : this.password
                }
                axios
                .post(`${this.url}/api/login`, data)
                .then(response => {
                    localStorage.token = response.data
                    // this.$store.dispatch('profileName', response.data.role)
                    // this.$router.push({ name: 'dashboard' })
                    this.$router
                        .push({ name: 'dashboard' })
                        .then(() => { this.$router.go() })
                }).catch(() => {
                    swal("Failed", "Username Dan Password Tidak Sesuai", "error");
                })
            }
        }
    }
</script>