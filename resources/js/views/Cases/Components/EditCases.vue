<script setup>
import { ref, onMounted } from 'vue'
import { useRoute } from 'vue-router'
import Sidebar from '../../../components/Sidebar.vue'
import Navbar from '../../../components/Navbar.vue'
import Breadcrumb from '@/components/Breadcrumb.vue'
import draggable from 'vuedraggable'
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css'
import { httpRequest } from '../../../utils/global-request'
import InputComponent from '@/components/InputComponent.vue'
import ModalComponent from '@/components/ModalComponent.vue'
import Swal from 'sweetalert2'

const route = useRoute()
const caseId = Number(route.params.id)

const data = ref({})
const descriptionList = ref([])
const showDescModal = ref(false)
const editingIndex = ref(-1)
const form = ref({ description: '', id_locale: '', id_case: caseId })

const breadcrumbItems = ref([
  { label: 'Casos', href: '/cases' },
  { label: 'Editar Caso', href: `/edit-case/${caseId}` }
])

const normalizeOrders = () => {
  descriptionList.value.sort((a, b) => (a.order - b.order) || (a.id - b.id))
  for (let i = 0; i < descriptionList.value.length; i++) {
    descriptionList.value[i].order = i
  }
}


const persistOrder = async () => {
  try {
    await httpRequest({
      url: '/description-cases/reorder',
      method: 'POST',
      data: { orders: descriptionList.value.map(d => ({ id: d.id, order: d.order })) }
    })
  } catch (e) {
    console.error('Error actualizando orden:', e)
    Swal.fire('Error', 'No se pudo actualizar el orden', 'error')
  }
}

const computeNextOrder = () => {
  let max = -1
  for (let i = 0; i < descriptionList.value.length; i++) {
    const v = descriptionList.value[i].order
    if (typeof v === 'number' && v > max) max = v
  }
  return max + 1
}

/* ===== Cargar caso (sin ?. ni ??) ===== */
const getCase = async () => {
  try {
    const res = await httpRequest({ url: '/cases/' + caseId, method: 'GET' })
    const payload = res.data && typeof res.data === 'object' && 'data' in res.data ? res.data.data : res.data
    data.value = payload
    const arr = payload && payload.description_cases ? payload.description_cases : []
    descriptionList.value = arr.map(d => ({
      id: d.id,
      description: d.description,
      order: typeof d.order === 'number' ? d.order : 0,
      id_locale: d.id_locale,
      id_case: d.id_case ? d.id_case : caseId
    }))
    normalizeOrders()
  } catch (e) {
    console.error('Error cargando caso:', e)
    Swal.fire('Error', 'No se pudo cargar el caso', 'error')
  }
}

const saveCase = async () => {
  try {
    await httpRequest({
      url: '/cases/' + caseId,
      method: 'PUT',
      data: {
        image: data.value.image,
        image_author: data.value.image_author,
        author: data.value.author,
        area: data.value.area,
        name: data.value.name,
        introduction: data.value.introduction,
        text_button: data.value.text_button,
        id_locale: data.value.id_locale
      }
    })
    Swal.fire({ icon: 'success', title: 'Guardado', text: 'Caso actualizado correctamente', timer: 1600, showConfirmButton: false })
  } catch (e) {
    console.error('Error actualizando caso:', e)
    Swal.fire('Error', 'No se pudo actualizar el caso', 'error')
  }
}

const deleteCase = async () => {
  const r = await Swal.fire({
    title: '¿Eliminar este caso?',
    text: 'Esta acción no se puede deshacer.',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Eliminar',
    cancelButtonText: 'Cancelar'
  })
  if (!r.isConfirmed) return
  try {
    await httpRequest({ url: '/cases/' + caseId, method: 'DELETE' })
    Swal.fire({ icon: 'success', title: 'Eliminado', text: 'Caso eliminado correctamente', timer: 1500, showConfirmButton: false })
  } catch (e) {
    console.error('Error eliminando caso:', e)
    Swal.fire('Error', 'No se pudo eliminar el caso', 'error')
  }
}

/* ===== Modal descripción (sin defaults) ===== */
const openDesc = (index = -1) => {
  editingIndex.value = index
  if (index === -1) {
    form.value = {
      description: '',
      id_locale: String(data.value.id_locale),
      id_case: caseId
    }
  } else {
    const d = descriptionList.value[index]
    form.value = {
      description: d.description,
      id_locale: String(d.id_locale),
      id_case: caseId
    }
  }
  showDescModal.value = true
  document.body.classList.add('modal-open')
}


const closeDesc = () => {
  showDescModal.value = false
  document.body.classList.remove('modal-open')
}

/* ===== Crear/Actualizar descripción (pocas vars) ===== */
const saveDesc = async () => {
  try {
    if (editingIndex.value === -1) {
      const res = await httpRequest({
        url: '/description-cases',
        method: 'POST',
        data: {
          id_case: form.value.id_case,
          description: form.value.description,
          order: descriptionList.value.length, 
          id_locale: form.value.id_locale
        }
      })
      const created = (res.data && res.data.data) ? res.data.data : res.data
      descriptionList.value.push({
        id: created.id,
        description: created.description,
        order: created.order,
        id_locale: created.id_locale,
        id_case: created.id_case
      })
      Swal.fire({ icon: 'success', title: 'Agregado', text: 'Descripción creada', timer: 1200, showConfirmButton: false })
    } else {
      // EDITAR
      const target = descriptionList.value[editingIndex.value]
      await httpRequest({
        url: '/description-cases/' + target.id,
        method: 'PUT',
        data: {
          description: form.value.description,
          id_locale: form.value.id_locale
        }
      })
      target.description = form.value.description
      target.id_locale = form.value.id_locale
      Swal.fire({ icon: 'success', title: 'Actualizado', text: 'Descripción actualizada', timer: 1200, showConfirmButton: false })
    }
    closeDesc()
  } catch (e) {
    console.error('Error guardando descripción:', e)
    Swal.fire('Error', 'No se pudo guardar la descripción', 'error')
  }
}

/* ===== Eliminar descripción ===== */
const deleteDescription = async (id) => {
  const r = await Swal.fire({
    title: '¿Eliminar esta descripción?',
    text: 'Esta acción no se puede deshacer.',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Eliminar',
    cancelButtonText: 'Cancelar'
  })
  if (!r.isConfirmed) return

  try {
    await httpRequest({ url: '/description-cases/' + id, method: 'DELETE' })
    descriptionList.value = descriptionList.value.filter(d => d.id !== id)
    normalizeOrders()
    await persistOrder()
    Swal.fire({ icon: 'success', title: 'Eliminado', text: 'Descripción eliminada', timer: 1200, showConfirmButton: false })
  } catch (e) {
    console.error('Error al eliminar descripción:', e)
    Swal.fire('Error', 'No se pudo eliminar la descripción', 'error')
  }
}

/* ===== Drag & drop ===== */
const onDragEnd = async () => {
  for (let i = 0; i < descriptionList.value.length; i++) descriptionList.value[i].order = i
  await persistOrder()
}

onMounted(getCase)
</script>

<template>
  <div id="wrapper">
    <Sidebar />
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <Navbar />

        <div class="container-fluid">
          <Breadcrumb :items="breadcrumbItems" />

          <div class="container">
            <div class="card m-3">
              <div class="card-header">
                <h3 class="card-title mb-0">Editar Caso</h3>
              </div>

              <div class="card-body">
                <form @submit.prevent>
                  <InputComponent label="Título" v-model="data.name" placeholder="Ingrese el título" />
                  <InputComponent label="Imagen principal" v-model="data.image" placeholder="URL de la imagen" />
                  <InputComponent label="Imagen del autor" v-model="data.image_author" placeholder="URL de la imagen del autor" />
                  <InputComponent label="Nombre del autor" v-model="data.author" placeholder="Ingrese el autor" />
                  <InputComponent label="Área" v-model="data.area" placeholder="Ingrese el área" />
                  <InputComponent label="Introducción" v-model="data.introduction" placeholder="Escriba la introducción" />

                  <!-- DESCRIPCIONES -->
                  <div class="form-group mt-3">
                    <div class="d-flex justify-content-between align-items-center mb-2 sticky-header">
                      <label class="form-label m-0">Bloques de descripciones</label>
                      <div class="d-flex gap-2">
                        <button type="button" class="btn btn-success btn-sm" @click="openDesc(-1)">
                          Agregar descripción
                        </button>
                      </div>
                    </div>

                    <div class="desc-scroll">
                      <draggable
                        v-model="descriptionList"
                        item-key="id"
                        class="list-group"
                        @end="onDragEnd"
                        handle=".drag-handle"
                        :animation="180"
                        ghost-class="drag-ghost"
                      >
                        <template #item="{ element, index }">
                          <div class="list-group-item" @dblclick="openDesc(index)">
                            <div class="d-flex w-100 justify-content-between align-items-center">
                              <span class="drag-handle" title="Arrastrar" aria-label="Arrastrar">☰</span>
                              <div class="flex-grow-1 ms-2 me-auto text-truncate">
                                <small class="text-muted">Descripción #{{ index + 1 }}</small>
                              </div>
                              <div class="d-flex gap-2">
                                <button type="button" class="btn btn-outline-primary btn-sm" @click="openDesc(index)">
                                  Editar
                                </button>
                                <button type="button" class="btn btn-outline-danger btn-sm" @click="deleteDescription(element.id)">
                                  Eliminar
                                </button>
                              </div>
                            </div>
                            <div class="mt-2 text-muted small preview" v-html="element.description"></div>
                          </div>
                        </template>
                      </draggable>
                    </div>
                  </div>

                  <hr />

                  <div class="actions mt-3">
                    <button type="button" class="btn btn-danger" @click="deleteCase">Eliminar</button>
                    <button type="button" class="btn btn-primary" @click="saveCase">Guardar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <!-- MODAL -->
          <ModalComponent :show="showDescModal" @close="closeDesc">
           <template #title>
            {{ editingIndex !== -1 ? 'Editar descripción' : 'Agregar descripción' }}
          </template>


            <template #body>
              <div class="mb-3">
                <label class="form-label">Contenido</label>
                <div class="modal-editor-scroll">
                  <QuillEditor
                    v-model:content="form.description"
                    content-type="html"
                    theme="snow"
                    class="editor-box"
                  />
                </div>
              </div>
            </template>

            <template #footer>
              <button class="btn btn-secondary me-2" type="button" @click="closeDesc">Cancelar</button>
              <button class="btn btn-primary" type="button" @click="saveDesc">Guardar</button>
            </template>
          </ModalComponent>
          <!-- /MODAL -->
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

<style scoped>
.card { border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,.05); }
.card-header { background: #f8f9fa; border-bottom: 1px solid #e5e7eb; padding: 1rem; }
.actions { display: flex; justify-content: flex-end; gap: 10px; }
.list-group { border: 1px solid #ccc; padding: 10px; border-radius: 8px; }
.list-group-item { padding: 10px; background: #f9fafb; margin-bottom: 8px; border-radius: 8px; cursor: default; }
.drag-handle { cursor: grab; user-select: none; font-weight: 600; opacity: .6; }
.drag-ghost { opacity: .5; }
.desc-scroll { max-height: 420px; overflow-y: auto; padding-right: 6px; }
.preview { max-height: 72px; overflow: hidden; }
.sticky-header { position: sticky; top: 0; background: #fff; z-index: 1; padding: 6px 0; }
.modal-editor-scroll { max-height: 55vh; overflow-y: auto; }
.editor-box { background: #fff; }
</style>
