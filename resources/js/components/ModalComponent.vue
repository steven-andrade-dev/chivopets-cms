<template>
  <div v-if="show" class="modal fade show d-block" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

        <!-- HEADER -->
        <div class="modal-header">
          <h5 class="modal-title">
            <slot name="title"></slot>
          </h5>
          <button type="button" class="close" @click="$emit('close')">
            <span>&times;</span>
          </button>
        </div>

        <!-- BODY -->
        <div class="modal-body">
          <slot name="body"></slot>
        </div>

        <!-- FOOTER -->
        <div class="modal-footer d-flex justify-content-between align-items-center">
          <slot name="footer"></slot>
        </div>

      </div>
    </div>
  </div>
</template>

<script setup>
    defineProps({
    show: { type: Boolean, default: false }
    })

    defineEmits(['close'])
</script>
