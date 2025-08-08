<script setup>
import { ref } from 'vue'
import { httpRequest } from '../../../utils/global-request' 
import Swal from 'sweetalert2'


const props = defineProps({
  data: {
    type: Array,
    required: true
  }
})
const emit = defineEmits(['refresh'])
const selectedrol = ref(null)
const showModal = ref(false)

const openModal = (rol) => {
  selectedrol.value = { ...rol }
  showModal.value = true
  document.body.classList.add('modal-open')
}

const closeModal = () => {
  showModal.value = false
  selectedrol.value = null
  document.body.classList.remove('modal-open')
}


// Crear
const createRol = async () => {
  try {
    const response = await httpRequest({
      url: '/rol',
      method: 'POST',
      data: selectedrol.value
    })
    emit('refresh')
    closeModal()
    return response
  } catch (err) {
    console.error(err)
  }
}

// Editar
const updateRol = async () => {
  try {
    const response = await httpRequest({
      url: `/rol/${selectedrol.value.id}`,
      method: 'PUT',
      data: selectedrol.value
    })
    emit('refresh')
    closeModal()
    return response
  } catch (err) {
    console.error(err)
  }
}

// Eliminar
const deleteRol = async () => {
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
      url: `/rol/${selectedrol.value.id}`,
      method: 'DELETE'
    })
    emit('refresh')
    closeModal()
  } catch (error) {
    console.error(error)
  }
}


const saveRol = async () => {
  if (selectedrol.value.id) {
    await updateRol()
  } else {
    await createRol()
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
        <th scope="col">Acciones</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="rol in data" :key="rol.id">
        <td>{{ rol.id }}</td>
        <td>{{ rol.name }}</td>
        <td>
          <button class="btn btn-primary btn-sm" @click="openModal(rol)">Editar</button>
        </td>
      </tr>
    </tbody>
  </table>

  <!-- Modal -->
  <div v-if="showModal" class="modal fade show d-block" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{ selectedrol.id ? 'Editar Rol' : 'Agregar Rol' }}</h5>
          <button type="button" class="close" @click="closeModal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group mb-4 position-relative">
              <label class="form-label">Nombre</label>
              <div class="input-group">
                <span class="input-group-text bg-dark text-white border-0">
                  <i class="bi bi-person-fill"></i>
                </span>
                <input v-model="selectedrol.name" type="text" class="form-control form-control-lg rounded-end border-0 shadow-sm" placeholder="Nombre del rol" />
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer d-flex justify-content-between align-items-center">
          <div class="flex-shrink-0">
            <button class="btn btn-danger w-auto" v-if="selectedrol.id && selectedrol.can_delete" @click="deleteRol">
            Eliminar
            </button>
          </div>
          <div class="">
            <button class="btn  me-2" @click="closeModal">Cancelar</button>
            <button class="btn btn-primary btn-glow" @click="saveRol">Guardar</button>
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

.btncancel{
  border:#aaa
}

.modal-dialog {
  margin-top: 10%;
}

body.modal-open {
  overflow: hidden;
}

.modal-content {
  background: #ffffff;
  color: #171616;
  border-radius: 1rem;
  border: none;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
}

.modal-header {
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.modal-footer {
  border-top: 1px solid rgba(255, 255, 255, 0.1);
}

input.form-control {
  background-color: #ffffff;
  color: #171616;
}

input::placeholder {
  color: #aaa;
}

</style>
