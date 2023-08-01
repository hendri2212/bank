<script setup>
    import Navbar from "../Navbar.vue"
</script>
<template>
    <Navbar />
    <div class="px-3">
        <router-link :to="{ name: 'new_employee' }" class="btn btn-primary">+ Employee</router-link>
        <table class="table table-striped mt-1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Full Name</th>
                    <th>Role</th>
                    <th>email</th>
                    <!-- <th>status</th> -->
                </tr>
            </thead>
            <tbody>
                <tr v-for="(data, index) in employee" :key="index">
                    <td>{{ index+1 }}</td>
                    <td>{{ data.name }}</td>
                    <td>{{ data.role }}</td>
                    <td>{{ data.email }}</td>
                    <!-- <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked> -->
                            <!-- <label class="form-check-label" for="flexSwitchCheckChecked">Checked switch checkbox input</label> -->
                        <!-- </div>
                    </td> -->
                    <td>
                        <div class="dropdown">
                            <i class="bi bi-three-dots-vertical" data-bs-toggle="dropdown" aria-expanded="false"></i>
                            <ul class="dropdown-menu">
                                <li>
                                    <router-link class="dropdown-item text-secondary" :to="{ name: 'edit_employee', params: { id: data.id } }">
                                    <i class="bi bi-pencil me-1"></i> Edit</router-link>
                                </li>
                                <!-- <li>
                                    <a class="dropdown-item text-secondary" href="#">
                                    <i class="bi bi-trash me-1"></i> Delete</a>
                                </li> -->
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
        data(){
            return {
                employee: [],
                url     : window.location.origin
            }
        },
        created(){
            axios
            .get(`${this.url}/api/user`, {
                headers:{
                    Authorization: 'Bearer '+localStorage.token
                }
            })
            .then(response => {
                this.employee = response.data
            })
        }
    }
</script>