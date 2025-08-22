<script setup lang="ts">
const props = defineProps({
    carusel : {
        type: Array,
        required: true
    }
})

</script>

<template>
    <div class="row">
        <div class="col-md-3" v-for="item in props.carusel">
            <div class="card bg-green-chivo">
                <img class="img-chivo" src="https://chivopets.sv/imagenes/atencionenemergencias.webp" :alt="item.id">
                <div class="card-body">
                    <h5 class="card-title text-white text-bold">{{ item.title }} <br> {{ item.subtitle }}</h5>
                    <p class="card-text"></p>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
    .bg-green-chivo {
        background-color: #65BEAA !important;
        border-radius: 22px !important;
        height: 150px !important;
    }

    .img-chivo {
        position: absolute;
        right: 0;
        width: auto;
        height: -webkit-fill-available;
        margin: auto;
    }

    .card-body {
        z-index: 2;
    }
</style>
