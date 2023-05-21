<script setup>
    import Navbar from "../Navbar.vue"
</script>
<template>
    <navbar />
    <div class="px-3">
        <form @submit.prevent="update" v-if="edit!=null">
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="name" v-model="edit.name">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" v-model="edit.email">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" v-model="edit.password">
                <div id="emailHelp" class="form-text">Kosongkan jika password tidak diubah</div>
            </div>
            <div class="mb-3" v-if="status=='superadmin' || status=='manager'">
                <label class="form-label">Role</label>
                <select v-model="edit.role" class="form-control">
                    <option value="manager" v-if="status=='superadmin'">Manager</option>
                    <option value="teller">Teller</option>
                    <option value="service">Service</option>
                </select>
            </div>
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="submit" class="btn btn-primary">Update</button>
                <button type="button" class="btn btn-warning" @click="$router.go(-1)">Cancel</button>
            </div>
        </form>
    </div>
</template>
<script>
    import axios from "axios"

    export default {
        data(){
            return {
                status  : localStorage.role,
                url     : window.location.origin,
                edit    : null
            }
        },
        created(){
            axios
            .get(`${this.url}/api/user/${this.$route.params.id}/edit`, {
                headers:{
                    Authorization: 'Bearer '+localStorage.token
                }
            })
            .then(response => {
                this.edit = response.data
            })
        },
        methods: {
            update() {
                var data = {
                    name    : this.edit.name,
                    email   : this.edit.email,
                    password: this.edit.password,
                    role    : this.edit.role
                }
                axios
                .put(`${this.url}/api/user/${this.$route.params.id}`, data, {
                    headers:{
                        Authorization: 'Bearer '+localStorage.token
                    }
                })
                .then(response => {
                    swal("Berhasil", "Telah Berhasil Update", "success");
                    this.$router.push({ name: 'employee' })
                })
            },
        }
    }
</script>