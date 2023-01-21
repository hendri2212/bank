<template>
    <div class="container bg-white">
        <div class="row text-center my-3">
            <div class="col-3">
                <router-link :to="{ name: 'balance'}" class="d-flex flex-column shadow rounded-3 my-3 text-decoration-none text-reset">
                    <i class="bi bi-cash-coin fs-2 text-success"></i>
                    <label for="history" class="fw-bold">Balance</label>
                </router-link>
            </div>
            <div class="col-3">
                <router-link :to="{ name: 'history' }" class="d-flex flex-column shadow rounded-3 my-3 text-decoration-none text-reset">
                    <i class="bi bi-list-check fs-2 text-danger"></i>
                    <label for="history" class="fw-bold">History</label>
                </router-link>
            </div>
            <div class="col-3">
                <div class="d-flex flex-column shadow rounded-3 my-3">
                    <i class="bi bi-send fs-2 text-warning"></i>
                    <label for="history" class="fw-bold">Send</label>
                </div>
            </div>
            <div class="col-3">
                <div class="d-flex flex-column shadow rounded-3 my-3">
                    <i class="bi bi-bag fs-2 text-info"></i>
                    <label for="history" class="fw-bold">Shoping</label>
                </div>
            </div>
            <div class="col-3">
                <div class="d-flex flex-column shadow rounded-3 my-3">
                    <i class="bi bi-credit-card fs-2 text-primary"></i>
                    <label for="history" class="fw-bold">Payment</label>
                </div>
            </div>
            <div class="col-3">
                <div class="d-flex flex-column shadow rounded-3 my-3">
                    <i class="bi bi-graph-up-arrow fs-2 text-success"></i>
                    <label for="history" class="fw-bold">Invest</label>
                </div>
            </div>
        </div>
    </div>
</template>