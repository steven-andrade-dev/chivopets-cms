<script setup>
import { ref } from 'vue'
import { httpRequest } from '../../utils/global-request' 
import Swal from 'sweetalert2'


const props = defineProps({
  data: {
    type: Array,
    required: true
  },
    locales: {
        type: Array,
        required: true
    }
})
const emit = defineEmits(['refresh'])
const selectedmain = ref(null)
const showModal = ref(false)

const openModal = (main) => {
  selectedmain.value = { ...main }
  showModal.value = true
  document.body.classList.add('modal-open')
}

const closeModal = () => {
  showModal.value = false
  selectedmain.value = null
  document.body.classList.remove('modal-open')
}


// Crear
const createMain = async () => {
  try {
    const response = await httpRequest({
      url: '/main',
      method: 'POST',
      data: selectedmain.value
    })
    emit('refresh')
    closeModal()
    return response
  } catch (err) {
    console.error(err)
  }
}

// Editar
const updateMain = async () => {
  try {
    const response = await httpRequest({
      url: `/main/${selectedmain.value.id}`,
      method: 'PUT',
      data: selectedmain.value
    })
    emit('refresh')
    closeModal()
    return response
  } catch (err) {
    console.error(err)
  }
}

// Eliminar
const deleteMain = async () => {
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
      url: `/main/${selectedmain.value.id}`,
      method: 'DELETE'
    })
    emit('refresh')
    closeModal()
  } catch (error) {
    console.error(error)
  }
}


const saveMain = async () => {
  if (selectedmain.value.id) {
    await updateMain()
  } else {
    await createMain()
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
        <th scope="col">URL</th>
        <th scope="col">Acciones</th>
        <th scope="col">Submenus</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="main in data" :key="main.id">
        <td>{{ main.id }}</td>
        <td>{{ main.name }}</td>
        <td>{{ main.url }}</td>
        <td>
          <button class="btn btn-primary btn-sm" @click="openModal(main)">Editar</button>
        </td>
        <td>
          <button class="btn btn-secondary btn-sm" @click="openSubmenuModal(main)">Submenus</button>
        </td>
      </tr>
    </tbody>
  </table>

  <!-- Modal -->
  <div v-if="showModal" class="modal fade show d-block" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{ selectedmain.id ? 'Editar Main' : 'Agregar Main' }}</h5>
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
                <input v-model="selectedmain.name" type="text" class="form-control form-control-lg rounded-end border-0 shadow-sm" placeholder="Nombre del main" />
              </div>
            </div>

            <div class="form-group mb-4 position-relative">
              <label class="form-label">url</label>
              <div class="input-group">
                <span class="input-group-text bg-dark text-white border-0">
                  <i class="bi bi-code-slash"></i>
                </span>
                <input v-model="selectedmain.url" type="text" class="form-control form-control-lg rounded-end border-0 shadow-sm" placeholder="Ej: ES, EN" />
              </div>
            </div>
            <div class="form-group mb-4 position-relative">
                <label class="form-label">Idioma</label>
                <div class="input-group">
                    <span class="input-group-text bg-dark text-white border-0">
                    <i class="bi bi-translate"></i>
                    </span>
                     <select
                        v-model="selectedmain.id_locale"
                        class="form-select form-select-lg rounded-end border-0 shadow-sm"
                        required
                        >
                        <option disabled value="">🌐 Selecciona un idioma</option>
                        <option v-for="locale in locales" :key="locale.id" :value="locale.id">
                            {{ locale.name }}
                        </option>
                        </select>
                </div>
            </div>
          </form>
        </div>
        <div class="modal-footer d-flex justify-content-between align-items-center">
          <div class="flex-shrink-0">
            <button class="btn btn-danger w-auto" v-if="selectedmain.id && selectedmain.can_delete" @click="deleteMain">
            Eliminar
            </button>
          </div>
          <div class="">
             <button class="btn  me-2" @click="closeModal">Cancelar</button>
            <button class="btn btn-primary btn-glow" @click="saveMain">Guardar</button>
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
