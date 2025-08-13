<script setup lang="ts">
import Navbar from "../../components/Navbar.vue"
import Sidebar from "../../components/Sidebar.vue"
import { useRoute} from "vue-router"
import { ref, onMounted , computed} from "vue"
import { httpRequest } from "../../utils/global-request"
import Swal from "sweetalert2"
import Breadcrumb from "@/components/Breadcrumb.vue"

const breadcrumbItems = ref([
  { label: "Menú", href: "/menu" },
  { label: "Submenús", href: "/edit-submenu" }
])

const route = useRoute()
const menuId = route.params.id

const data = ref([])
const locales = ref([])
const selectedSubmenu = ref<any | null>(null)
const showModal = ref(false)


const modalTitle = computed(() => {
  return selectedSubmenu.value && selectedSubmenu.value.id
    ? 'Editar Submenú'
    : 'Agregar Submenú'
})

const getSubmenus = async () => {
  try {
    const response = await httpRequest({
      url: `/submenu/${menuId}`,
      method: "GET"
    })
    data.value = response.data.data ?? response.data
  } catch (error) {
    console.error("Error cargando submenús:", error)
  }
}

// Cargar idiomas
const getLocales = async () => {
  try {
    const response = await httpRequest({
      url: "/locales",
      method: "GET"
    })
    locales.value = response.data.data ?? response.data
  } catch (error) {
    console.error("Error cargando idiomas:", error)
  }
}

const openModal = (submenu: any) => {
  selectedSubmenu.value = {
    ...submenu,
    id_menu: menuId
  }
  showModal.value = true
  document.body.classList.add("modal-open")
}

const closeModal = () => {
  selectedSubmenu.value = null
  showModal.value = false
  document.body.classList.remove("modal-open")
}

const saveSubmenu = async () => {
  try {
    if (selectedSubmenu.value.id) {
      await httpRequest({
        url: `/submenu/${selectedSubmenu.value.id}`,
        method: "PUT",
        data: selectedSubmenu.value
      })
    } else {
      await httpRequest({
        url: "/submenu",
        method: "POST",
        data: selectedSubmenu.value
      })
    }
    await getSubmenus()
    closeModal()
  } catch (error) {
    console.error("Error al guardar submenu:", error)
  }
}

const deleteSubmenu = async () => {
  const result = await Swal.fire({
    title: "¿Estás seguro?",
    text: "Esta acción no se puede deshacer.",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Eliminar",
    cancelButtonText: "Cancelar"
  })

  if (!result.isConfirmed) return

  try {
    await httpRequest({
      url: `/submenu/${selectedSubmenu.value.id}`,
      method: "DELETE"
    })
    await getSubmenus()
    closeModal()
  } catch (error) {
    console.error("Error al eliminar submenu:", error)
  }
}

onMounted(() => {
  getLocales()
  getSubmenus()
})
</script>

<template>
  <div id="wrapper">
    <Sidebar />
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <Navbar />
        <div class="container-fluid">
            <Breadcrumb :items="breadcrumbItems" />
          <h1>Submenús del menú #{{ menuId }}</h1>

          <div class="mb-3">
            <button class="btn btn-success" @click="openModal({ id: null, name: '', url: '', id_locale: '' })">
              <i class="bi bi-plus"></i> Agregar
            </button>
          </div>

          <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>URL</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="submenu in data" :key="submenu.id">
                    <td>{{ submenu.id }}</td>
                    <td>{{ submenu.name }}</td>
                    <td>{{ submenu.url }}</td>
                    <td>
                      <button class="btn btn-primary btn-sm" @click="openModal(submenu)">Editar</button>
                    </td>
                  </tr>
                </tbody>
              </table>
          </div>
        </div>
      </div>

      <!-- Modal -->
      <div v-if="showModal" class="modal fade show d-block" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ modalTitle }}</h5>
              <button type="button" class="close" @click="closeModal">
                <span>&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form>
                <div class="form-group mb-4">
                  <label>Nombre</label>
                  <input v-model="selectedSubmenu.name" type="text" class="form-control" />
                </div>
                <div class="form-group mb-4">
                  <label>URL</label>
                  <input v-model="selectedSubmenu.url" type="text" class="form-control" />
                </div>
                <div class="form-group mb-4">
                  <label>Idioma</label>
                  <select v-model="selectedSubmenu.id_locale" class="form-select">
                    <option disabled value="">🌐 Selecciona un idioma</option>
                    <option v-for="locale in locales" :key="locale.id" :value="locale.id">
                      {{ locale.name }}
                    </option>
                  </select>
                </div>
              </form>
            </div>
            <div class="modal-footer d-flex justify-content-between">
              <button v-if="selectedSubmenu?.id" class="btn btn-danger" @click="deleteSubmenu">Eliminar</button>
              <div>
                <button class="btn btn-secondary me-2" @click="closeModal">Cancelar</button>
                <button class="btn btn-primary" @click="saveSubmenu">Guardar</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Chivo Pets</span>
          </div>
        </div>
      </footer>
    </div>
  </div>
</template>

