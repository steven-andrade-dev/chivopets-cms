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
  router.push({ name: 'create-tips' })
}

const goToEdit = (tipsId) => {
  router.push({ name: 'edit-tips', params: { id: tipsId } })
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
      <tr v-for="tipsItem in data" :key="tipsItem.id">
        <td>{{ tipsItem.id }}</td>
        <td>{{ tipsItem.author }}</td>
        <td>{{ tipsItem.area }}</td>
        <td>{{ tipsItem.name }}</td>
        <td>{{ tipsItem.id_locale }}</td>
        <td>
          <button class="btn btn-primary btn-sm" @click="goToEdit(tipsItem.id)">
            Editar
          </button>
        </td>
      </tr>
    </tbody>
  </table>
</template>
