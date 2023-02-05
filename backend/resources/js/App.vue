<script setup>
    import { RouterLink, RouterView } from 'vue-router'
    import Sidebars from './components/Sidebar.vue'
</script>

<template>
    <div class="d-flex flex-nowrap">
        <Sidebars />
        <main class="col">
            <router-view></router-view>
        </main>
    </div>
</template>