<script setup>
    import Navbar from "@/components/Navbar.vue"
</script>
<template>
    <Navbar />
    <div class="px-3">
        <input list="customers" name="browser" id="customer" v-model="user_id" @change="member_selected" class="form-control" placeholder="Type Student Name">
        <datalist id="customers">
            <option v-for="(data, index) in customer" :key="index" :label="data.full_name" :value="data.nisn"></option>
        </datalist>
        <div v-if="member_details!=null">
            <h4 class="mt-4">Data Details Student</h4>
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th scope="row">Full Name</th>
                        <td>{{ member_details.full_name }}</td>
                    </tr>
                    <tr>
                        <th scope="row">NISN</th>
                        <td>{{ member_details.nisn }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Handphone</th>
                        <td>{{ member_details.mobile_phone }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Major</th>
                        <td colspan="2">{{ member_details.major_name }}</td>
                    </tr>
                </tbody>
            </table>
            <button @click="register" class="btn btn-primary">Register</button>
        </div>
    </div>
</template>
<script>
import axios from "axios"
// import { useBankStore } from '../../store'
export default {
    data() {
        return {
            customer        : [],
            url             : window.location.origin,
            user_id         : null,
            member_details  : null
        }
    },
    created() {
        axios
        // .get(`${this.url}/customer`)
        .get(`https://smkn1kotabaru.sch.id/api/data_siswa/bank_not_member`)
        .then(response => {
            this.customer = response.data
        })
        .catch(error => {
            console.log(error);
        })
    },
    methods: {
        member_selected() {
            axios
            .get(`https://smkn1kotabaru.sch.id/api/data_siswa/member_selected/${this.user_id}`)
            .then(response => {
                this.member_details = response.data
            })
            .catch(error => {
                console.log(error);
            });
        },

        register() {
            axios
            .post(`https://smkn1kotabaru.sch.id/api/data_siswa/add_member/${this.user_id}`, {
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            // .then(function (response) {
            .then((response) => {
                if (response.status === 200) {
                    // console.log("Success:", response.data);
                    swal("Berhasil", "Telah Menjadi Member Bank Saijaan", "success");
                    this.$router.push({ name: 'customer' })
                }
            })
            .catch(function (error) {
                console.log("Error:", error);
            });

            var data = {
                nisn : this.member_details.nisn
            }
            axios
            .post(`${this.url}/api/customer`, data, {
                headers:{
                    Authorization: 'Bearer '+localStorage.token
                }
            })
        }
    }
}
</script>
