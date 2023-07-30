<script setup>
    import Navbar from "@/components/Navbar.vue"
</script>
<template>
    <Navbar />
    <div class="px-3">
        <form @submit.prevent="update" v-if="history!=null">
            <div class="row mb-3">
                <label for="staticEmail" class="col-sm-2 col-form-label">Teller</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" :value="history.user.name">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail3" v-model="history.description">
                </div>
            </div>
            <div class="row mb-3">
                <label for="amount" class="col-sm-2 col-form-label">Total</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="amount" v-model="history.amount">
                </div>
            </div>
            <fieldset class="row mb-3">
                <legend class="col-form-label col-sm-2 pt-0">Type</legend>
                <div class="col-sm-10">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="type" id="credit" value="Credit" :checked="history.type == 'Credit'">
                        <label class="form-check-label" for="credit">
                            Credit
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="type" id="debet" value="Debet" :checked="history.type == 'Debet'">
                        <label class="form-check-label" for="debet">
                            Debet
                        </label>
                    </div>
                </div>
            </fieldset>
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-warning" @click="$router.go(-1)">Cancel</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</template>
<script>
import axios from "axios"

export default {
    data(){
        return{
            url     : window.location.origin,
            history : null
        }
    },
    created(){
        axios
        .get(`${this.url}/api/edit/${this.$route.params.id}`, {
            headers:{
                Authorization: 'Bearer '+localStorage.token
            }
        })
        .then(response => {
            this.history = response.data
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