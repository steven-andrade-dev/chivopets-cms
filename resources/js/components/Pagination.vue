<template>
  <nav aria-label="Page navigation">
    <ul class="pagination">
      <li
        v-for="(link, index) in pagination.links"
        :key="index"
        class="page-item"
        :class="{ active: link.active, disabled: !link.url }"
      >
        <a
          class="page-link"
          href="#"
          v-html="link.label"
          @click.prevent="goToPage(link.url)"
        ></a>
      </li>
    </ul>
  </nav>
</template>

<script setup>
    import { defineProps, defineEmits } from "vue";

    const props = defineProps({
        pagination: {
            type: Object,
            required: true
        }
    });

    const emit = defineEmits(["page-change"]);

    function goToPage(url) {
        if (!url) return; // Si el enlace está deshabilitado
        const page = new URL(url).searchParams.get("page");
        emit("page-change", Number(page));
    }
</script>
