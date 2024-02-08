<script setup>
    import Navbar from '../components/Navbar.vue'
    import { useCounterStore } from '../stores/counter.js'
    import { ref, onMounted } from 'vue'

    const saldo = ref(null)
    onMounted(() => {
        axios
        .get(`${useCounterStore().url}/api/balance/${localStorage.nisn}`, {
            headers:{
                Authorization: 'Bearer '+localStorage.token
            }
        })
        .then(response => {
            if(response.data.balance == null || response.data.balance == undefined){
                saldo.value = 0
            }else{
                saldo.value = response.data.balance
            }
        })
    })
</script>
<template>
    <Navbar />
    <main class="container bg-white py-2">
        <span class="fw-bold">Total Your Balance</span>
        <br>
        <span class="h3 text-success">{{ new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(saldo) }}</span>
    </main>
</template>