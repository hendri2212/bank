<template>
    <Navbar />
    <main class="container bg-white py-2">
        <span class="fw-bold">Total Your Balance</span>
        <br>
        <span class="h3 text-success">{{ new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(this.saldo) }}</span>
        <!-- <span class="h3 text-success">{{ new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(this.balance) }}</span> -->
    </main>
</template>
<script>
// import axios from "axios"
import Navbar from '../components/Navbar.vue'
import { useCounterStore } from '../stores/counter.js'

export default {
    components: {
        Navbar
    },
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
            if(response.data.balance == null || response.data.balance == undefined){
                this.saldo = 0
            }else{
                this.saldo = response.data.balance
            }
        })
    }
}
</script>