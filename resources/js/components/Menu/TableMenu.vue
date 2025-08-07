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
const selectedmenu = ref(null)
const showModal = ref(false)

const openModal = (menu) => {  
  selectedmenu.value = {
    ...menu,
    id_locale: menu.id_locale ?? "", 
  }

  showModal.value = true
  document.body.classList.add('modal-open')
}


const closeModal = () => {
  showModal.value = false
  selectedmenu.value = null
  document.body.classList.remove('modal-open')
}


// Crear
const createMenu = async () => {
  try {
    const response = await httpRequest({
      url: '/menu',
      method: 'POST',
      data: selectedmenu.value
    })
    emit('refresh')
    closeModal()
    return response
  } catch (err) {
    console.error(err)
  }
}

// Editar
const updateMenu = async () => {
  try {
    const response = await httpRequest({
      url: `/menu/${selectedmenu.value.id}`,
      method: 'PUT',
      data: selectedmenu.value
    })
    emit('refresh')
    closeModal()
    return response
  } catch (err) {
    console.error(err)
  }
}

// Eliminar
const deleteMenu = async () => {
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
      url: `/menu/${selectedmenu.value.id}`,
      method: 'DELETE'
    })
    emit('refresh')
    closeModal()
  } catch (error) {
    console.error(error)
  }
}


const saveMenu = async () => {
  if (selectedmenu.value.id) {
    await updateMenu()
  } else {
    await createMenu()
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
      <tr v-for="menu in data" :key="menu.id">
        <td>{{ menu.id }}</td>
        <td>{{ menu.name }}</td>
        <td>{{ menu.url }}</td>
        <td>
          <button class="btn btn-primary btn-sm" @click="openModal(menu)">Editar</button>
        </td>
        <td>
          <button class="btn btn-secondary btn-sm" @click="openSubmenuModal(menu)">Submenus</button>
        </td>
      </tr>
    </tbody>
  </table>

  <!-- Modal -->
  <div v-if="showModal" class="modal fade show d-block" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{ selectedmenu.id ? 'Editar Menu' : 'Agregar Menu' }}</h5>
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
                <input v-model="selectedmenu.name" type="text" class="form-control form-control-lg rounded-end border-0 shadow-sm" placeholder="" />
              </div>
            </div>

            <div class="form-group mb-4 position-relative">
              <label class="form-label">url</label>
              <div class="input-group">
                <span class="input-group-text bg-dark text-white border-0">
                  <i class="bi bi-code-slash"></i>
                </span>
                <input v-model="selectedmenu.url" type="text" class="form-control form-control-lg rounded-end border-0 shadow-sm" placeholder="" />
              </div>
            </div>
            <div class="form-group mb-4 position-relative">
                <label class="form-label">Idioma</label>
                <div class="input-group">
                    <span class="input-group-text bg-dark text-white border-0">
                    <i class="bi bi-translate"></i>
                    </span>
                     <select
                        v-model="selectedmenu.id_locale"
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
            <button class="btn btn-danger w-auto" v-if="selectedmenu.id && selectedmenu.can_delete" @click="deleteMenu">
            Eliminar
            </button>
          </div>
          <div class="">
             <button class="btn  me-2" @click="closeModal">Cancelar</button>
            <button class="btn btn-primary btn-glow" @click="saveMenu">Guardar</button>
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
