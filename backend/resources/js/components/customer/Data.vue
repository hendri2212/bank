<script setup>
    import Navbar from "@/components/Navbar.vue"
</script>
<template>
    <Navbar />
    <div class="px-3">
        <router-link :to="{ name: 'new_customer' }" class="btn btn-primary">+ Member</router-link>
        <table class="table table-striped mt-1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Full Name</th>
                    <th>NISN</th>
                    <th>Handphone</th>
                    <th>Major</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(data, index) in member" :key="index">
                    <td scope="row">{{ index+1 }}</td>
                    <td>{{ data.full_name }}</td>
                    <td>{{ data.nisn }}</td>
                    <td>{{ data.mobile_phone }}</td>
                    <td>{{ data.major_name }}</td>
                    <td>
                        <div class="dropdown">
                            <i class="bi bi-three-dots-vertical" data-bs-toggle="dropdown" aria-expanded="false"></i>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item text-secondary" href="#">
                                    <i class="bi bi-stars me-1"></i> Reset</a>
                                </li>
                                <li>
                                    <a class="dropdown-item text-secondary" href="#">
                                    <i class="bi bi-pause me-1"></i> Suspend</a>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
import axios from "axios"
export default {
    data() {
        return {
            member          : []
        }
    },
    created() {
        axios
        .get(`https://smkn1kotabaru.sch.id/api/data_siswa/bank_member`)
        .then(response => {
            this.member = response.data
        })
    }
}
</script>
