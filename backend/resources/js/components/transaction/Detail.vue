<script setup>
    import Navbar from "@/components/Navbar.vue"
</script>
<template>
    <Navbar />
    <div class="px-3">
        <div v-if="member_details!=null">
            <!-- <h4 class="mt-4">Data Details Student</h4> -->
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
        </div>
        <table class="table table-striped" id="myTable">
            <thead>
                <tr>
                    <th>Created</th>
                    <th>Teller</th>
                    <th>Description</th>
                    <th class="text-center">Type</th>
                    <th class="text-end">Total</th>
                    <th class="text-end">Last Balance</th>
                    <th v-if="role=='superadmin' && role!=null"></th>
                </tr>
            </thead>
            <tbody>
                <!-- <tr v-if="history==''">
                    <td colspan="7" class="fw-bold text-center">Loading</td>
                </tr> -->
                <!-- <tr v-else v-for="(data, index) in history" :key="index"> -->
                <tr v-for="(data, index) in history" :key="index">
                    <td>{{ new Intl.DateTimeFormat('id-ID',{
                            weekday: "long",
                            year: "numeric",
                            month: "long",
                            day: "numeric",
                        }).format(new Date(data.created_at)) }}
                    </td>
                    <td>{{ data.user.name }}</td>   
                    <td>{{ data.description }}</td>
                    <td class="text-center">{{ data.type }}</td>
                    <td class="text-end">{{ new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(data.amount) }}</td>
                    <td class="text-end">{{ new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(data.balance) }}</td>
                    <td v-if="role=='superadmin'">
                        <router-link :to="{ name: 'edit', params: { id: data.id } }">
                            <i class="bi bi-pencil-square"></i>
                        </router-link>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
import axios from "axios"

export default {
    data(){
        return {
            role            : localStorage.role,
            member_details  : null,
            history         : [],
            url             : window.location.origin
        }
    },
    created(){
        axios
        .get(`https://smkn1kotabaru.sch.id/api/data_siswa/member_selected/${this.$route.params.id}`)
        .then(response => {
            this.member_details = response.data
        })
        .catch(error => {
            console.log(error);
        });

        axios
        .get(`${this.url}/api/transaction/${this.$route.params.id}`, {
            headers:{
                Authorization: 'Bearer '+localStorage.token
            }
        })
        .then(response => {
            this.history = response.data
        })
    },
    beforeUpdate: function() {
        let table = new DataTable('#myTable')
        if (table) {
            table.destroy()
        }
    },
    updated: function() {
        new DataTable('#myTable',{
            "responsive": true,
            "ordering": false,
            "searching": false,
            dom: 'Bfrtip',
            buttons: [],
        });
    }
}
</script>