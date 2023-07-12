<script setup>
    import Navbar from '../Navbar.vue'
</script>
<template>
    <Navbar />
    <div class="px-3">
        <input list="browsers" name="browser" id="browser" class="form-control">
        <datalist id="browsers">
            <option :value="data.nisn" v-for="(data, index) in member" :key="index" :label="data.full_name"></option>
            <!-- <option value="Edge" @click="change(id='1', index)"></option> -->
        </datalist>
    </div>
    <div class="container bg-white py-2">
        <table class="table table-striped">
            <thead>
                <th>Created</th>
                <th>Teller</th>
                <th>Customer</th>
                <th>Description</th>
                <th class="text-center">Type</th>
                <th class="text-end">Total</th>
                <th class="text-end">Last Balance</th>
            </thead>
            <tbody>
                <tr v-if="history==''">
                    <td colspan="7" class="fw-bold text-center">Loading</td>
                </tr>
                <tr v-else v-for="(data, index) in history" :key="index">
                    <td>{{ new Intl.DateTimeFormat('id-ID',{
                            weekday: "long",
                            year: "numeric",
                            month: "long",
                            day: "numeric",
                        }).format(new Date(data.created_at)) }}
                    </td>
                    <!-- <td>{{ data.created_at }}</td> -->
                    <td>{{ data.user.name }}</td>
                    <td>
                        <router-link :to="{ name: 'detail', params: { id: data.customer_id } }">
                            {{ data.customer_id }}
                        </router-link>
                    </td>
                    <td>{{ data.description }}</td>
                    <td class="text-center">{{ data.type }}</td>
                    <td class="text-end">{{ new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(data.amount) }}</td>
                    <td class="text-end">{{ new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(data.balance) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
import axios from "axios"
// import { useBankStore } from '../store'
export default {
    data(){
        return{
            history: [],
            // url: useBankStore().url/transaction`
            // url: `${window.location.origin}/transaction`,
            member: [],
            url: window.location.origin
        }
    },
    created(){
        axios
        // .get(`${this.url}`)
        // .get(`${this.url}/transaction/1`)
        .get(`${this.url}/api/transaction`, {
            headers:{
                Authorization: 'Bearer '+localStorage.token
            }
        })
        .then(response => {
            // console.log(response.data[0].amount)
            this.history = response.data
        })

        axios
        .get(`https://smkn1kotabaru.sch.id/api/data_siswa/bank_member`)
        .then(response => {
            this.member = response.data
        })
    }
}
</script>