<template>
    <main class="container bg-white py-2 text-center">
        <img src="https://smkn1kotabaru.sch.id/media_library/images/c6ab60e235b679b8b7f9ac1743593c59.png" alt="Logo Bank Saijaan" class="my-4">
        <h2 class="text-center mb-0">BANK SKAWAN</h2>
        <h4 class="text-center mb-5">SMK Negeri 1 Kotabaru</h4>
        <form class="my-5" @submit.prevent="login">
            <input type="text" v-model="nisn" placeholder="Your email or username" class="form-control form-control-lg rounded-0">
            <input type="password" v-model="password" placeholder="Your password" class="form-control form-control-lg rounded-0">
            <div class="d-grid gap-2">
                <input type="submit" value="Login" class="btn btn-success btn-lg rounded-0">
            </div>
        </form>
    </main>
</template>
<script>
    import { useCounterStore } from '../../stores/counter.js'
    
    export default {
        data(){
            return {
                nisn    : '',
                password: ''
            }
        },
        methods: {
            login(){
                var data = {
                    nisn        : this.nisn,
                    password    : this.password
                }
                axios
                .post(`${useCounterStore().url}/api/masuk`, data)
                // .post(`${useCounterStore().url}/masuk`, data)
                .then(response => {
                    localStorage.token  = response.data
                    localStorage.nisn   = this.nisn
                //     // this.$store.dispatch('profileName', response.data.role)
                //     // this.$router.push({ name: 'dashboard' })
                    this.$router
                        .push({ name: 'dashboard' })
                        .then(() => { this.$router.go() })
                }).catch(() => {
                    swal("Failed", "NISN atau Password Tidak Sesuai", "error");
                })
            }
        }
    }
</script>