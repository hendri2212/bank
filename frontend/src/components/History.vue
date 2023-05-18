<script setup>
    import Navbar from '../components/Navbar.vue'
</script>
<template>
    <Navbar />
    <main class="container bg-white py-2">
        <table class="table table-striped">
            <thead>
                <th>Description</th>
                <th class="text-center">Type</th>
                <th class="text-end">Total</th>
                <th class="text-end">Last Balance</th>
            </thead>
            <tbody>
                <tr>
                    <td>Menabung</td>
                    <td class="text-center">K</td>
                    <td class="text-end">1000</td>
                    <td class="text-end">3000</td>
                </tr>
                <tr>
                    <td>Menabung</td>
                    <td class="text-center">K</td>
                    <td class="text-end">1000</td>
                    <td class="text-end">2000</td>
                </tr>
                <tr>
                    <td>Menabung {{ this.data }}</td>
                    <td class="text-center">K</td>
                    <td class="text-end">1000</td>
                    <td class="text-end">1000</td>
                </tr>
            </tbody>
        </table>
    </main>
</template>
<script>
    export default {
        data() {
            return {
                data: '100'
            }
        },
        created(){
            axios
            .get('https://smkn1kotabaru.sch.id/api/data_siswa')
            .then(function (response){
                console.log(response.data)
            })
        }
    }
</script>