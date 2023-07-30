<script setup>
    import Navbar from '../../components/Navbar.vue'
</script>
<template>
    <Navbar />
    <main class="container bg-white py-2">
        <span class="fw-bold">Data Personal</span>
        <table class="table table-striped">
            <tbody>
                <tr class="placeholder-glow">
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
        <a href='change-password'>Change Password</a>
        <br><br>
        <button class="btn btn-sm btn-danger" @click="logout">Log Out</button>
    </main>
</template>
<script>
import { useCounterStore } from '../../stores/counter.js'
    export default {
        data(){
            return {
                member_details: []
            }
        },
        created(){
            axios
            .get(`https://smkn1kotabaru.sch.id/api/data_siswa/member_selected/${localStorage.nisn}`)
            .then(response => {
                this.member_details = response.data
            })
            .catch(error => {
                console.log(error);
            });
        },
        methods:{
            logout(){
                axios
                .delete(`${useCounterStore().url}/api/customer/${localStorage.nisn}`,{
                    headers:{
                        Authorization: 'Bearer '+localStorage.token
                    }
                })
                .then(response => {
                    // this.member = response.data
                    localStorage.clear()
                    this.$router.push({ name: 'login' })
                })
            }
        }
    }
</script>