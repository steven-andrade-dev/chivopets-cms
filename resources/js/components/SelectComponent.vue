<template>
  <div class="form-group mb-4">
    <label v-if="label" class="form-label">{{ label }}</label>

    <div class="input-group">
      <select
        class="form-select form-select-lg rounded-end"
        :value="modelValue"
        @change="$emit('update:modelValue', $event.target.value)"
        :required="required"
      >
        <option disabled value="">{{ placeholder }}</option>

        <option
          v-for="option in options"
          :key="option[valueKey]"
          :value="option[valueKey]"
        >
          {{ option[labelKey] }}
        </option>
      </select>
    </div>
  </div>
</template>

<script setup>
    defineProps({
        label: { type: String, default: '' },
        icon: { type: String, default: '' },
        modelValue: { type: [String, Number], default: '' },
        placeholder: { type: String, default: 'Seleccione una opción' },
        options: { type: Array, default: () => [] },
        valueKey: { type: String, default: 'id' },
        labelKey: { type: String, default: 'name' },
        required: { type: Boolean, default: false }
    })

    defineEmits(['update:modelValue'])
</script>
