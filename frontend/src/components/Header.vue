<template>
    <div class="container bg-success mb-2">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h3 class="text-uppercase fw-bold text-white mb-0">Bank Skawan</h3>
                <p class="fw-bold text-warning text-uppercase mb-0">SMKN 1 Kotabaru</p>
            </div>
            <router-link :to="{ name: 'profile' }">
                <i class="bi bi-person-circle fs-2 text-warning"></i>
            </router-link>
        </div>
    </div>
</template>