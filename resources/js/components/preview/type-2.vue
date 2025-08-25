<script setup lang="ts">
    import StaticCaruselCard from './StaticCaruselCard.vue'

    const props = defineProps({
        content: {
            type: Object,
            required: true
        }
    })
</script>

<template>
  <section class="position-relative overflow-hidden">
    <div class="container py-2">
        <div class="row align-items-center m-2">

            <!-- Texto -->
            <div class="col-md-12 contenido-externo">
                <span v-html="content.bloque_principal"></span>
            </div>

            <!-- Imagen -->
            <div class="col-md-12 position-relative text-center">
                <StaticCaruselCard :carusel="content.carruselItems" />
            </div>
        </div>
    </div>

  </section>
</template>

<style>
.custom-shape-divider-bottom-1755806890 {
    position: relative;
    bottom: 0;
    left: 0;
    width: 100%;
    overflow: hidden;
    line-height: 0;
}

.custom-shape-divider-bottom-1755806890 .shape-fill {
    fill: #FFFFFF;
}
.contenido-externo {
    all: initial;         /* rompe herencia incluso de body */
    font: revert;         /* restaura fuentes nativas */
    color: revert;        /* restaura color nativo */
}

.contenido-externo * {
    all: unset;
    display: revert;
    font: revert;
    color: revert;
}
</style>
