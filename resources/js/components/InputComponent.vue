<template>
    <div class="form-group mb-4">
        <label v-if="label" class="form-label">{{ label }}</label>

        <div class="input-group">
            <input
                :type="type"
                class="form-control form-control-lg rounded-end"
                :placeholder="placeholder"
                :value="modelValue"
                @input="$emit('update:modelValue', $event.target.value)"
            />
        </div>
    </div>
</template>

<script setup>
    defineProps({
        label: { type: String, default: '' },
        modelValue: { type: [String, Number], default: '' },
        type: { type: String, default: 'text' },
        placeholder: { type: String, default: '' }
    })

    defineEmits(['update:modelValue'])
</script>
