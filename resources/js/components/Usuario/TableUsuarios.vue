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
const selecteduser = ref(null)
const showModal = ref(false)

const openModal = (user) => {
  selecteduser.value = { ...user, password: '' }  
  showModal.value = true
  document.body.classList.add('modal-open')
}

const closeModal = () => {
  showModal.value = false
  selecteduser.value = null
  document.body.classList.remove('modal-open')
}


// Crear
const createUser = async () => {
  try {
    const response = await httpRequest({
      url: '/users',
      method: 'POST',
      data: selecteduser.value
    })
    emit('refresh')
    closeModal()
    return response
  } catch (err) {
    console.error(err)
  }
}

// Editar
const updateUser = async () => {
  try {
    const response = await httpRequest({
      url: `/users/${selecteduser.value.id}`,
      method: 'PUT',
      data: selecteduser.value
    })
    emit('refresh')
    closeModal()
    return response
  } catch (err) {
    console.error(err)
  }
}

// Eliminar
const deleteUser = async () => {
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
      url: `/users/${selecteduser.value.id}`,
      method: 'DELETE'
    })
    emit('refresh')
    closeModal()
  } catch (error) {
    console.error(error)
  }
}


const saveUser = async () => {
  if (selecteduser.value.id) {
    await updateUser()
  } else {
    await createUser()
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
        <th scope="col">Email</th>
        <th scope="col">Acciones</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="user in data" :key="user.id">
        <td>{{ user.id }}</td>
        <td>{{ user.name }}</td>
        <td>{{ user.email }}</td>
        <td>
          <button class="btn btn-primary btn-sm" @click="openModal(user)">Editar</button>
        </td>
      </tr>
    </tbody>
  </table>

  <!-- Modal -->
  <div v-if="showModal" class="modal fade show d-block" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{ selecteduser.id ? 'Editar Usuario' : 'Agregar Usuario' }}</h5>
          <button type="button" class="close" @click="closeModal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group mb-3">
              <label>Nombre</label>
              <input v-model="selecteduser.name" type="text" class="form-control" />
            </div>
            <div class="form-group mb-3">
              <label>Email</label>
              <input v-model="selecteduser.email" type="email" class="form-control" />
            </div>
            <div class="form-group mb-3">
              <label>Password</label>
              <input v-model="selecteduser.password" type="password" class="form-control" />
            </div>
          </form>
        </div>
        <div class="modal-footer d-flex justify-content-between">
          <div>
            <button class="btn btn-danger w-auto  " v-if="selecteduser.id" @click="deleteUser">
              Eliminar
            </button>
          </div>
          <div>
            <button class="btn btn-secondary me-2" @click="closeModal">Cancelar</button>
            <button class="btn btn-primary" @click="saveUser">Guardar</button>
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
