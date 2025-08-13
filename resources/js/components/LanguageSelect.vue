<template>
  <div class="row">
    <div class="col-md-4 mb-3">
      <select
        class="form-select"
        :id="id"
        v-model="selectedValue"
        @change="onChange"
      >
        <option
          v-for="option in languages"
          :key="option.value"
          :value="option.value"
        >
          {{ option.label }}
        </option>
      </select>
    </div>
  </div>
</template>

<script setup>
import { ref, watch } from 'vue'

const languages = [
  { value: 1, label: 'Español' },
  { value: 2, label: 'Inglés' }
]

const props = defineProps({
  modelValue: {
    type: [String, Number],
    default: ''
  },
  id: {
    type: String,
    default: 'dynamicSelect'
  }
})

const emit = defineEmits(['update:modelValue', 'change'])

const selectedValue = ref(props.modelValue)

watch(() => props.modelValue, (newVal) => {
  selectedValue.value = newVal
})

function onChange() {
  emit('update:modelValue', selectedValue.value)
  emit('change', selectedValue.value)
}
</script>
