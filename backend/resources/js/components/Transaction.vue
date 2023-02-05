<script setup>
    import Navbar from "../components/Navbar.vue"
</script>
<template>
    <Navbar />
    <div class="px-3">
        <div class="d-flex justify-content-between gap-3">
            <div class="col">
                <div class="card border-success">
                    <div class="card-header text-bg-success">
                        Credit
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="credit">
                            <div class="mb-3">
                                <label for="customer">Customer Name</label>
                                <select v-model="customer_credit" id="customer" class="form-control">
                                    <option v-for="(data, index) in customer" :key="index" :value="data.id">{{ data.id }}</option>
                                </select>
                                <!-- <input list="customers" name="browser" id="customer" v-model="user_id" class="form-control">
                                <datalist id="customers">
                                    <option v-for="(data, index) in customer" :key="index" label="Hendri Arifin" :value="data.id"></option>
                                    <option label="Hendri Arifin" value="001"></option>
                                    <option label="Moh. Alifan" value="002"></option>
                                    <option label="M. Fajrin Nur" value="003"></option>
                                    <option label="Maria Fransisca" value="004"></option>
                                    <option label="Fatimah" value="005"></option>
                                </datalist> -->
                            </div>
                            <div class="mb-3">
                                <label for="credit">Amount</label>
                                <input type="number" v-model="amount_credit" id="credit" class="form-control fs-1 fw-bold">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card border-warning">
                    <div class="card-header text-bg-warning">
                        Debet
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="debet">
                            <div class="mb-3">
                                <label for="user">Customer Name</label>
                                <select v-model="customer_debet" id="customer" class="form-control">
                                    <option v-for="(data, index) in customer" :key="index" :value="data.id">{{ data.id }}</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="debet">Amount</label>
                                <input type="number" v-model="amount_debet" id="debet" class="form-control fs-1 fw-bold">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from "axios"
// import { useBankStore } from '../store'
export default {
    data() {
        return {
            customer    : [],
            url         : window.location.origin,

            customer_credit : null,
            customer_debet  : null,
            amount_credit   : null,
            amount_debet    : null
        }
    },
    created(){
        axios
        .get(`${this.url}/customer`)
        .then(response => {
            this.customer = response.data
        })
    },
    methods: {
        credit() {
            var data={
                description : 'Deposit Saldo',
                type        : 'Credit',
                amount      : this.amount_credit,
                customer_id : this.customer_credit,
            }
            axios
            .post(`${this.url}/transaction`, data)
            .then(response => {
                this.$router.push({ name: 'history' })
            })
        },
        debet() {
            var data={
                description : 'Debet Saldo',
                type        : 'Debet',
                amount      : this.amount_debet,
                customer_id : this.customer_debet,
            }
            axios
            .post(`${this.url}/transaction`, data)
            .then(response => {
                this.$router.push({ name: 'history' })
            })
        },
    }
}
</script>
