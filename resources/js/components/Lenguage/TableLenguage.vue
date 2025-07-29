<script setup>
import { ref } from 'vue'
import { httpRequest } from '../../utils/global-request' 
import Swal from 'sweetalert2'


const props = defineProps({
  data: {
    type: Array,
    required: true
  }
})
const emit = defineEmits(['refresh'])
const selectedLocale = ref(null)
const showModal = ref(false)

const openModal = (locale) => {
  selectedLocale.value = { ...locale }
  showModal.value = true
  document.body.classList.add('modal-open')
}

const closeModal = () => {
  showModal.value = false
  selectedLocale.value = null
  document.body.classList.remove('modal-open')
}


// Crear
const createLocale = async () => {
  try {
    const response = await httpRequest({
      url: '/locales',
      method: 'POST',
      data: selectedLocale.value
    })
    emit('refresh')
    closeModal()
    return response
  } catch (err) {
    console.error(err)
  }
}

// Editar
const updateLocale = async () => {
  try {
    const response = await httpRequest({
      url: `/locales/${selectedLocale.value.id}`,
      method: 'PUT',
      data: selectedLocale.value
    })
    emit('refresh')
    closeModal()
    return response
  } catch (err) {
    console.error(err)
  }
}

// Eliminar
const deleteLocale = async () => {
  const result = await Swal.fire({
    title: '¿Estás seguro?',
    text: 'Esta acción no se puede deshacer.',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Eliminar',
    cancelButtonText: 'Cancelar'
  })
  if (!result.isConfirmed) return

  try {
    await httpRequest({
      url: `/locales/${selectedLocale.value.id}`,
      method: 'DELETE'
    })
    emit('refresh')
    closeModal()
  } catch (error) {
    console.error(error)
  }
}


const saveLocale = async () => {
  if (selectedLocale.value.id) {
    await updateLocale()
  } else {
    await createLocale()
  }
}


</script>

<template>
  <div class="mb-3">
    <button class="btn btn-success" @click="openModal({ id: null, name: '', code: '' })">
      <i class="bi bi-plus"></i> Agregar
    </button>
  </div>

  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nombre</th>
        <th scope="col">Código</th>
        <th scope="col">Acciones</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="locale in data" :key="locale.id">
        <td>{{ locale.id }}</td>
        <td>{{ locale.name }}</td>
        <td>{{ locale.code }}</td>
        <td>
          <button class="btn btn-primary btn-sm" @click="openModal(locale)">Editar</button>
        </td>
      </tr>
    </tbody>
  </table>

  <!-- Modal -->
  <div v-if="showModal" class="modal fade show d-block" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{ selectedLocale.id ? 'Editar Idioma' : 'Agregar Idioma' }}</h5>
          <button type="button" class="close" @click="closeModal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group mb-3">
              <label>Nombre</label>
              <input v-model="selectedLocale.name" type="text" class="form-control" />
            </div>
            <div class="form-group mb-3">
              <label>Código</label>
              <input v-model="selectedLocale.code" type="text" class="form-control" />
            </div>
          </form>
        </div>
        <div class="modal-footer d-flex justify-content-between">
          <button class="btn btn-danger" v-if="selectedLocale.id" @click="deleteLocale">
            Eliminar
          </button>
          <div class="">
             <button class="btn btn-secondary me-2" @click="closeModal">Cancelar</button>
            <button class="btn btn-primary" @click="saveLocale">Guardar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.modal {
  display: block;
  background-color: rgba(0, 0, 0, 0.5);
  overflow-y: auto;
}

.modal-dialog {
  margin-top: 10%;
}

body.modal-open {
  overflow: hidden;
}
</style>
