<script setup>
import { ref } from 'vue'
import { httpRequest } from '../../../utils/global-request' 
import Swal from 'sweetalert2'


const props = defineProps({
  data: {
    type: Array,
    required: true
  },
  roles: {
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
    <button class="btn btn-success" @click="openModal({ id: null, name: '', email: '', password: '', id_rol: '' })">
      <i class="bi bi-plus"></i> Agregar
    </button>
  </div>

  <table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>Nombre</th>
        <th>Email</th>
        <th>Rol</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="user in data" :key="user.id">
        <td>{{ user.id }}</td>
        <td>{{ user.name }}</td>
        <td>{{ user.email }}</td>
        <td>{{ user.rol.name }}</td>
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
            <div class="form-group mb-4 position-relative">
              <label class="form-label">Nombre</label>
              <div class="input-group">
                <span class="input-group-text bg-dark text-white border-0">
                  <i class="bi bi-person-fill"></i>
                </span>
                <input v-model="selecteduser.name" type="text" class="form-control form-control-lg rounded-end border-0 shadow-sm" placeholder="Nombre completo" />
              </div>
            </div>

            <div class="form-group mb-4 position-relative">
              <label class="form-label">Email</label>
              <div class="input-group">
                <span class="input-group-text bg-dark text-white border-0">
                  <i class="bi bi-envelope-fill"></i>
                </span>
                <input v-model="selecteduser.email" type="email" class="form-control form-control-lg rounded-end border-0 shadow-sm" placeholder="Correo electrónico" />
              </div>
            </div>

            <div class="form-group mb-4 position-relative">
              <label class="form-label">Password</label>
              <div class="input-group">
                <span class="input-group-text bg-dark text-white border-0">
                  <i class="bi bi-lock-fill"></i>
                </span>
                <input v-model="selecteduser.password" type="password" class="form-control form-control-lg rounded-end border-0 shadow-sm" placeholder="Contraseña" />
              </div>
            </div>

            <div class="form-group mb-4 position-relative">
              <label class="form-label">Rol</label>
              <div class="input-group">
                <span class="input-group-text bg-dark text-white border-0">
                  <i class="bi bi-person-badge-fill"></i>
                </span>
                <select v-model="selecteduser.id_rol" class="form-select form-select-lg rounded-end border-0 shadow-sm" required>
                  <option disabled value="">🔒 Selecciona un rol</option>
                  <option v-for="rol in roles" :key="rol.id" :value="rol.id">{{ rol.name }}</option>
                </select>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer d-flex justify-content-between align-items-center">
          <div>
            <button class="btn btn-danger w-auto" v-if="selecteduser.id" @click="deleteUser">
              Eliminar
            </button>
          </div>
          <div>
            <button class="btn btn-secondary me-2" @click="closeModal">Cancelar</button>
            <button class="btn btn-primary btn-glow" @click="saveUser">Guardar</button>
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

.modal-content {
  background: #ffffff;
  color: #171616;
  border-radius: 1rem;
  border: none;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
}

.modal-header,
.modal-footer {
  border-color: rgba(255, 255, 255, 0.1);
}

input.form-control {
  background-color: #ffffff;
  color: #171616;
}

input::placeholder {
  color: #aaa;
}
</style>
