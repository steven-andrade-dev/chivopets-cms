<script setup lang="ts">
    import type1 from './type-1.vue'
    import type2 from './type-2.vue'
    const props = defineProps({
        content: {
            type: Object,
            required: true
        },
        type: {
            type: Number,
            required: true
        }
    })
</script>

<template>
    <type1 v-if="content.type_preview == 1" :content="content"></type1>
    <type2 v-if="content.type_preview == 2" :content="content"></type2>
</template>

<style>
.home {
    background-color: #1F2146;
}
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
</style>
