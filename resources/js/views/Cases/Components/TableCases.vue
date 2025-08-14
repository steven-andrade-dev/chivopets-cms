<script setup>
import { useRouter } from 'vue-router'

const props = defineProps({
  data: {
    type: Array,
    required: true
  }
})

const router = useRouter()

const goToCreate = () => {
  router.push({ name: 'create-case' })
}

const goToEdit = (caseId) => {
  router.push({ name: 'edit-case', params: { id: caseId } })
}
</script>

<template>
  <div class="mb-3">
    <button class="btn btn-success" @click="goToCreate">
      <i class="bi bi-plus"></i> Agregar
    </button>
  </div>

  <table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>Autor</th>
        <th>Área</th>
        <th>Nombre</th>
        <th>Idioma</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="caseItem in data" :key="caseItem.id">
        <td>{{ caseItem.id }}</td>
        <td>{{ caseItem.author }}</td>
        <td>{{ caseItem.area }}</td>
        <td>{{ caseItem.name }}</td>
        <td>{{ caseItem.id_locale }}</td>
        <td>
          <button class="btn btn-primary btn-sm" @click="goToEdit(caseItem.id)">
            Editar
          </button>
        </td>
      </tr>
    </tbody>
  </table>
</template>
