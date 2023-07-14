<script setup>
    import { RouterLink, RouterView } from 'vue-router'
    // import HelloWorld from './components/HelloWorld.vue'
</script>

<template>
    <!-- <header>
        <img alt="Vue logo" class="logo" src="@/assets/logo.svg" width="125" height="125" />

        <div class="wrapper">
        <HelloWorld msg="You did it!" />

        <nav>
            <RouterLink to="/">Home</RouterLink>
            <RouterLink to="/about">About</RouterLink>
        </nav>
        </div>
    </header> -->
    <RouterView />
</template>
<script>
    import { useCounterStore } from './stores/counter.js'
    
    export default {
        created(){
            if (localStorage.token=='undefined' || localStorage.token==null) {
            // if (useCounterStore().token=='undefined' || useCounterStore().token==null) {
                this.$router.push({ name: 'login' });
            }
        }
    }
</script>