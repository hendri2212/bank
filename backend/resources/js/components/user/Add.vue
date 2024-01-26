<script setup>
    import Navbar from "../Navbar.vue"
</script>
<template>
    <navbar />
    <div class="px-3">
        <form @submit.prevent="save">
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="name" v-model="name">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" v-model="email">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" v-model="password">
            </div>
            <div class="mb-3" v-if="status=='superadmin' || status=='manager'">
                <label class="form-label">Role</label>
                <select v-model="role" class="form-control">
                    <option value="manager" v-if="status=='superadmin'">Manager</option>
                    <option value="teller">Teller</option>
                    <option value="service">Service</option>
                </select>
            </div>
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="submit" class="btn btn-primary">Save</button>
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
                name    : null,
                email   : null,
                password: null,
                role    : null
            }
        },
        methods: {
            save() {
                var data = {
                    name    : this.name,
                    email   : this.email,
                    password: this.password,
                    role    : this.role
                }
                axios
                .post(`${this.url}/api/user`, data, {
                    headers:{
                        Authorization: 'Bearer '+localStorage.token
                    }
                })
                .then(response => {
                    swal("Berhasil", "Telah Berhasil Register", "success");
                    this.$router.push({ name: 'employee' })
                })
            },
        }
    }
</script>