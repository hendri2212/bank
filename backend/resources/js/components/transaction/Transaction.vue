<script setup>
    import Navbar from "../Navbar.vue"
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
                                <!-- <select v-model="customer_credit" id="customer" class="form-control">
                                    <option v-for="(data, index) in member" :key="index" :value="data.nisn">{{ data.full_name }}</option>
                                </select> -->
                                <input list="customers" name="customer" id="customer" v-model="customer_credit" class="form-control">
                                <datalist id="customers">
                                    <option v-for="(data, index) in member" :key="index" :label="data.full_name" :value="data.nisn" />
                                </datalist>
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
                                    <option v-for="(data, index) in member" :key="index" :value="data.nisn">{{ data.full_name }}</option>
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
            member          : [],
            url             : window.location.origin,

            customer_credit : null,
            customer_debet  : null,
            amount_credit   : null,
            amount_debet    : null
        }
    },
    created(){
        axios
        // .get(`${this.url}/api/customer`)
        .get(`https://smkn1kotabaru.sch.id/api/data_siswa/bank_member`)
        // .get(`https://smkn1kotabaru.sch.id/api/data_siswa`, {
        //     headers: {
        //         'Access-Control-Allow-Origin': '*'
        //     }
        // })
        .then(response => {
            this.member = response.data
        })
        .catch(error => {
            console.log(error);
        });
    },
    methods: {
        credit(){
            var data = {
                description : 'Deposit Saldo',
                type        : 'Credit',
                amount      : this.amount_credit,
                customer_id : this.customer_credit,
                user_id     : localStorage.user_id
            }
            axios
            .post(`${this.url}/api/transaction`,data, {
                headers:{
                    Authorization: 'Bearer '+localStorage.token
                }
            })
            .then(response => {
                swal("Berhasil", "Telah Berhasil Deposit Saldo", "success");
                this.$router.push({ name: 'history' })
            })
            .catch(function (error){
                if (error.request.status==500){
                    swal("Gagal", "Hubungi administrator", "error");
                }
            })
        },
        debet(){
            var data = {
                description : 'Debet Saldo',
                type        : 'Debet',
                amount      : this.amount_debet,
                customer_id : this.customer_debet,
                user_id     : localStorage.user_id
            }
            axios
            .post(`${this.url}/api/transaction`, data, {
                headers:{
                    Authorization: 'Bearer '+localStorage.token
                }
            })
            .then(response => {
                swal("Berhasil", "Telah Berhasil Debet Saldo", "success");
                this.$router.push({ name: 'history' })
            })
            .catch(function (error){
                if (error.request.status==500){
                    // swal("Gagal", "Hubungi administrator", "error");
                    swal("Gagal", "Anda belum pernah menabung", "error");
                } else if (error.request.status==404){
                    swal("Gagal", "Tabungan anda tidak cukup", "error");
                }
            })
        },
    }
}
</script>
