<template>
  <div class="list-group-item" @dblclick="$emit('edit', index)">
    <div class="d-flex w-100 justify-content-between align-items-center">
      <span class="drag-handle" title="Arrastrar">☰</span>
      <div class="flex-grow-1 ms-2 me-auto text-truncate">
        <small class="text-muted">Descripción #{{ index + 1 }}</small>
      </div>

      <div class="d-flex gap-2">
        <button
          type="button"
          class="btn btn-outline-primary btn-sm"
          @click="$emit('edit', index)"
        >
          Editar
        </button>
        <button
          type="button"
          class="btn btn-outline-danger btn-sm"
          @click="$emit('delete', element.id)"
        >
          Eliminar
        </button>
      </div>
    </div>

    <div class="mt-2 text-muted small preview" v-html="element.description"></div>
  </div>
</template>

<style>
.drag-handle {
  cursor: grab;   
}
.drag-handle:active {
  cursor: grabbing; 
}
</style>


<script setup>
defineProps({
  element: { type: Object, required: true },
  index: { type: Number, required: true }
})

defineEmits(['edit', 'delete'])
</script>
