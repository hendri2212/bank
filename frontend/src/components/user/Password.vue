<script setup>
    import Navbar from '../../components/Navbar.vue'
</script>
<template>
    <Navbar />
    <main class="container bg-white py-2">
        <span class="fw-bold">Change Your Password</span>
        <form @submit.prevent="save" class="pt-2">
            <div class="mb-3">
                <label for="password" class="form-label">New Password</label>
                <input type="text" class="form-control" id="password" v-model="password">
            </div>
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-warning" @click="$router.go(-1)">Cancel</button>
            </div>
        </form>
    </main>
</template>
<script>
import { useCounterStore } from '../../stores/counter.js'

export default {
    data(){
        return {
            password: '',
            url     : window.location.origin,
        }
    },
    methods: {
        save() {
            var data = {
                password: this.password
            }
            axios
            // .put(`${useCounterStore().url}/api/customer/${this.$route.params.id}`, data, {
            .put(`${useCounterStore().url}/api/customer/${localStorage.nisn}`, data, {
                headers:{
                    Authorization: 'Bearer '+localStorage.token
                }
            })
            .then(response => {
                // swal("Berhasil", "Berhasil Update Password", "success");
                this.$router.push({ name: 'profile' })
            })
        },
    }
}
</script>