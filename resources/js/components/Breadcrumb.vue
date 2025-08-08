<template>
  <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li
        v-for="(item, index) in items"
        :key="index"
        class="breadcrumb-item"
        :class="{ active: index === items.length - 1 }"
        :aria-current="index === items.length - 1 ? 'page' : null"
      >
        <template v-if="index !== items.length - 1">
            <RouterLink :to="item.href">{{ item.label }}</RouterLink>
        </template>
        <template v-else>
          {{ item.label }}
        </template>
      </li>
    </ol>
  </nav>
</template>

<script setup>
import { defineProps } from "vue";
import { RouterLink } from "vue-router";

const props = defineProps({
  items: {
    type: Array,
    required: true
  }
});
</script>
