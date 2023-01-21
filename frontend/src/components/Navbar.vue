<template>
    <div class="container d-flex align-items-center bg-success text-white py-2 mb-2" style="height: 54px">
        <router-link to="/" class="text-decoration-none text-reset">
            <i class="bi bi-arrow-left fs-2" style="padding-right: 15px;"></i>
        </router-link>
        <p class="m-0 fw-bold text-uppercase">{{ this.$route.meta.name }}</p>
    </div>
</template>