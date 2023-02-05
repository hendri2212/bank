<script setup>
    import Navbar from '../components/Navbar.vue'
</script>
<template>
    <Navbar />
    <div class="px-3">
        <input list="browsers" name="browser" id="browser" class="form-control">
        <datalist id="browsers">
            <option value="Edge" @click="change(id='1', index)"></option>
            <option value="Firefox"></option>
            <option value="Chrome"></option>
            <option value="Opera"></option>
            <option value="Safari"></option>
        </datalist>
    </div>
    <div class="container bg-white py-2">
        <table class="table table-striped">
            <thead>
                <th>Description</th>
                <th class="text-center">Type</th>
                <th class="text-end">Total</th>
                <th class="text-end">Last Balance</th>
            </thead>
            <tbody>
                <tr v-if="history==''">
                    <td colspan="4" class="fw-bold text-center">Loading</td>
                </tr>
                <tr v-else v-for="(data, index) in history" :key="index">
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
export default{
    data(){
        return{
            history: [],
            // url: useBankStore().url/transaction`
            // url: `${window.location.origin}/transaction`,
            url: window.location.origin
        }
    },
    created(){
        axios
        // .get(`${this.url}`)
        // .get(`${this.url}/transaction/1`)
        .get(`${this.url}/transaction`)
        .then(response => {
            // console.log(response.data[0].amount)
            this.history = response.data
        })
    }
}
</script>