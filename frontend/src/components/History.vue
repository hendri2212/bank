<script setup>
import Navbar from '../components/Navbar.vue'
import { useCounterStore } from '../stores/counter.js'
</script>
<template>
    <Navbar />
    <main class="container bg-white py-2">
        <div class="table-responsive">
            <table class="table table-striped text-nowrap">
                <thead>
                    <th>Date</th>
                    <th>Description</th>
                    <th class="text-center">Type</th>
                    <th class="text-end">Total</th>
                    <th class="text-end">Balance</th>
                </thead>
                <tbody>
                    <tr v-if="history==''">
                        <td colspan="5" class="fw-bold text-center">Loading</td>
                    </tr>
                    <tr v-else v-for="(data, index) in history" :key="index">
                        <td>{{ new Intl.DateTimeFormat('id-ID',{
                                weekday: "long",
                                year: "numeric",
                                month: "long",
                                day: "numeric",
                            }).format(new Date(data.created_at)) }}
                        </td>
                        <td>Menabung</td>
                        <td class="text-center">{{ data.type }}</td>
                        <td class="text-end">{{ new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(data.amount) }}</td>
                        <td class="text-end">{{ new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(data.balance) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
</template>
<script>
export default {
    data() {
        return {
            history : []
        }
    },
    created(){
        axios
        .get(`${useCounterStore().url}/api/transaction/${localStorage.nisn}`, {
            headers:{
                Authorization: 'Bearer '+localStorage.token
            }
        })
        .then(response => {
            this.history = response.data
        })
    }
}
</script>