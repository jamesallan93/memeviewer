<template>
    <div class="row rows-col-1 rows-cols-md-2">
        <div class="col" v-for="(plan, index) in plans" :key="index">
            <div class="card">
                <div class="card-header">
                    <h5>{{ plan.name }}</h5>

                    <p class="m-0 p-0 fw-bold">{{ moneyFormat(plan.price, plan.currency) }}</p>
                </div>
                <div class="card-body ">
                    <p>{{ plan.description }}</p>
                    <p>Signup fee: {{ moneyFormat(plan.signup_fee, plan.currency) }}</p>
                    <p>Payment per {{ plan.invoice_interval }}</p>
                    <a class="btn btn-info w-100" :href="`/subscribe/${plan.id}`">Select</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: {
        plans: {
            required: true,
        },
    },
    methods: {
        moneyFormat(val, currency = "BRL") {
            return new Intl.NumberFormat("pt-BR", {
                style: "currency",
                currency
            }).format(val);
        },
    },


};
</script>

<style lang="scss">
.card-header {
    padding: 0.8em;
    display: flex;
    justify-content: space-between;
}

h5 {
    margin: unset;
}
</style>