<template>
    <div class="row rows-col-1 rows-col-md-3 ">
        <div class="col d-flex justify-content-center" v-for="img, index in imgs" :key="index">
            <img :src="img" class="img-thumbnail">
        </div>
    </div>
</template>

<script>
export default {
    props: {
        imgs: {
            required: true,
            type: Array
        }
    }
}
</script>

<style>
</style>