<script setup>
    import Navbar from '../components/Navbar.vue'
</script>
<template>
    <Navbar />
    <main class="container bg-white py-2">
        <span class="fw-bold">Total Your Balance</span>
        <br>
        <!-- <span class="h3 text-success">Rp 0,00</span> -->
        <span class="h3 text-success" v-if="this.saldo==undefined">Rp 0,00</span>
        <span class="h3 text-success" v-else>{{ new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(this.saldo) }}</span>
        <!-- <span class="h3 text-success">{{ new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(this.balance) }}</span> -->
    </main>
</template>
<script>
// import axios from "axios"
import { useCounterStore } from '../stores/counter.js'

export default {
    data(){
        return {
            saldo : null
        }
    },
    created(){
        axios
        .get(`${useCounterStore().url}/api/balance/${localStorage.nisn}`, {
            headers:{
                Authorization: 'Bearer '+localStorage.token
            }
        })
        .then(response => {
            this.saldo = response.data.balance
            // console.log(response.data.balance)
        })
    }
}
</script>